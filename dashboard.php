<?php

function getTime($t_time){
	$pt = time() - $t_time;
	if ($pt>=86400)
		$p = date("F j, Y",$t_time);
	elseif ($pt>=3600)
		$p = (floor($pt/3600))."h";
	elseif ($pt>=60)
		$p = (floor($pt/60))."m";
	else
		$p = $pt."s";
	return $p;
}
	if($_SESSION['user_id']){
		include "connect.php";

		$sth=$pdo->prepare("SELECT username, followers, following, tweets, roleId
                              FROM users
                              WHERE id=:userId");

		$sth->bindParam(':userId', $_SESSION['user_id']);
		$sth->execute();
		$appUser = $sth->fetch();
		
		if(!$appUser){
			$pdo = null;
			echo "Error";
			return;
		}

		$username = htmlentities($appUser['username']);
		$tweets = htmlentities($appUser['tweets']);
		$followers = htmlentities($appUser['followers']);
		$following = htmlentities($appUser['following']);

		if(isset($_POST['tweet']) && !empty($_POST['tweet']) || isset($_POST['tweet']) && isset($_POST['images'])){
			if(hash_equals($csrf, $_POST['csrf'])){
				include("tweet.php");
			} else{
				echo 'Something went wrong';  
				session_destroy();
				exit;
			}
		}
		

		$_SESSION['key'] = bin2hex(random_bytes(32));
		$csrf = hash_hmac('sha256','some string: index.php', $_SESSION['key']);
		echo "
		<h6><a href='logout.php' style='float:right;'>Logout</a></h6>
		<table>
			<tr>
				<td>
					<img src='./default.jpg' style='width:49px; border-radius: 25px;'alt='display picture'/>
				</td>
				<td valign='top' style='padding-left:8px;'>
					<h6><a>@$username</a></h6>
					<h6 font=2 style='margin-top:-10px;'>Tweets: <a href='#'>$tweets</a> | Followers: <a href='#'>$followers</a> | Following: <a href='#'>$following</a></h6>
				</td>
			</tr>
		</table>
		<form action='index.php' method='POST' enctype='multipart/form-data'>
			<textarea class='form-control' placeholder='What`s happening?' name='tweet'></textarea>
			<input type='file' name='images'>
			<input type='hidden' name='csrf' value='$csrf' />
			<button type='submit' style='float:right;' class='btn btn-primary btn-sm float-right mt-1'>Tweet</button>
		</form>
		<br>
		<br>
		";
		include "connect.php";
		

		$sth=$pdo->prepare("SELECT id,username, tweet, images, timestamp, user_id
						FROM tweets
						ORDER BY timestamp DESC
						LIMIT 0, 10
						");

		$sth->bindParam(':userId', $_SESSION['user_id']);
		$sth->execute();
		$tweets = $sth->fetchAll();

		if(!$tweets){
			echo "<p>No Tweets Yet!</p>";
		}

		foreach ($tweets as &$tweetArr) {
			$tweet = (object) $tweetArr;
			echo "<div class='well well-sm mt-2 p-1 overflow-hidden border border-white rounded'>";
			if($tweet->user_id == $_SESSION['user_id'] || $appUser["roleId"] == 2){
				echo "<div style='font-size:10px;float:right;'>".htmlentities(getTime($tweet->timestamp))."
				<form action='deleteTweet.php' method='POST'><button type='submit'>X</button>
				<input type='hidden' value='$tweet->id' name='tweetId' /></form>
				<input type='hidden' name='csrf' value='$csrf' /> 
				</div>";
			}else{
				echo "<div style='font-size:10px;float:right;'>".htmlentities(getTime($tweet->timestamp))."</div>";
			}
			echo "<table>";
			echo "<tr>";
			echo "<td valign=top style='padding-top:4px;'>";
			echo "<img src='./default.jpg' style='width:49px; border-radius: 25px;'alt='display picture'/>";
			echo "</td>";
			echo "<td style='padding-left:5px;word-wrap: break-word;' valign=top>";
			echo "<a class='card-link' href='./".htmlentities($tweet->username)."'>@".htmlentities($tweet->username)."</a>";
			$new_tweet = preg_replace('/@(\\w+)/','<a href=./$1>$0</a>',htmlentities($tweet->tweet));
			$new_tweet = preg_replace('/#(\\w+)/','<a href=./hashtag/$1>$0</a>',htmlentities($new_tweet));
			echo "<div class='font-weight-normal'>".htmlentities($new_tweet)."</div>";
			if(isset($tweet->images)) {
				echo '<img src="data:image/jpeg;base64,'. ($tweet->images).'" width="175" height="200"/>';
			} else echo "";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
			echo "</div>";
		}
	}
?>
