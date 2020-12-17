<?php 
$user_id = $_SESSION['user_id'];
?>
<?php
if($user_id){
	if(isset($_POST['tweet']) && !empty($_POST['tweet']) || isset($_POST['tweet']) && isset($_POST['images'])){
		$tweet = htmlentities($_POST['tweet']);
		$image = htmlentities($_FILES['images']['name']);
		$allowd_file_ext = array("jpg", "jpeg", "png");
		$imageExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
		$timestamp = time();
		include 'connect.php';
		$sth=$pdo->prepare("SELECT username
					 		  FROM users 
				     		  WHERE id = :userId
				    		");

		$sth->bindParam(':userId', $_SESSION['user_id']);
		$sth->execute();
		$user = $sth->fetch();
		$username = $user['username'];

		if(!empty($_FILES['images']['tmp_name']) 
     	&& !file_exists($_FILES['images']['tmp_name'])) {
			$resMessage = array(
				"status" => "alert-danger",
				"message" => "Select image to upload."
			);
		} else if (!in_array($imageExt, $allowd_file_ext)){
			$resMessage = array(
                "status" => "alert-danger",
                "message" => "Allowed file formats .jpg, .jpeg and .png."
            );   
		} else if ($_FILES["images"]["size"] > 2097152) {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "File is too large. File size should be less than 2 megabytes."
            );
		} else {
			$images = base64_encode(file_get_contents($_FILES['images']['tmp_name']) );
		}
		       
		$sth=$pdo->prepare("INSERT INTO tweets(username, user_id, tweet, images, timestamp) 
				     VALUES (:username, :userId, :tweet, :images, :timestampNow)
					");

		$sth->bindParam(':username', $username);
		$sth->bindParam(':userId', $_SESSION['user_id']);
		$sth->bindParam(':tweet', $_POST['tweet']);
		$sth->bindParam(':images', $images);
		$sth->bindParam(':timestampNow', $timestamp);
		$sth->execute();

		$sth=$pdo->prepare("UPDATE users SET tweets = tweets + 1 WHERE id=:userId");

		$sth->bindParam(':userId', $_SESSION['user_id']);
		$sth->execute();
		header("Location: .");
	}

}
?>
