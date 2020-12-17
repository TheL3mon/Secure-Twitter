<?php
session_start();
$user_id = $_SESSION['user_id'];
?>
<?php
if($user_id){
        include 'connect.php';
        $sth=$pdo->prepare("SELECT username, followers, following, tweets, roleId
                              FROM users
                              WHERE id=:userId");

		$sth->bindParam(':userId', $user_id);
		$sth->execute();
		$appUser = $sth->fetch();

        $sth=$pdo->prepare("SELECT * FROM tweets WHERE id = :tweetId");
        $sth->bindParam(':tweetId', $_POST['tweetId']);
		$sth->execute();
        $tweet = $sth->fetch();

        if($tweet['user_id'] == $user_id || $appUser["roleId"] == 2){
            include 'connect.php';
            
            $sth=$pdo->prepare("DELETE FROM tweets WHERE id = :tweetId");
            $sth->bindParam(':tweetId', $_POST['tweetId']);
            $sth->execute();
            header("Location: .");
        }
        else{
            echo "Error";
            die;
        }

}
?>
