<?php 
$user_id = $_SESSION['user_id'];
?>
<?php
if($user_id){
	if(isset($_POST['tweet']) && !empty($_POST['tweet'])){
		$tweet = htmlentities($_POST['tweet']);
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

		$sth=$pdo->prepare("INSERT INTO tweets(username, user_id, tweet, timestamp) 
				     VALUES (:username, :userId, :tweet, :timestampNow)
					");
		
		$sth->bindParam(':username', $username);
		$sth->bindParam(':userId', $_SESSION['user_id']);
		$sth->bindParam(':tweet', $_POST['tweet']);
		$sth->bindParam(':timestampNow', $timestamp);
		$sth->execute();

		$sth=$pdo->prepare("UPDATE users SET tweets = tweets + 1 WHERE id=:userId");

		$sth->bindParam(':userId', $_SESSION['user_id']);
		$sth->execute();
		header("Location: .");
	}
}
?>
