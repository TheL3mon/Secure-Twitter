<?php
    // session_start();
    // $user_id = $_SESSION['user_id'];
?>
<!-- <!DOCTYPE html>
<html>
<head> -->
    <!-- reusable: meta, bootstrap, favicons, theme color -->
    <? 
    // include("head.html"); 
    ?>

    <!-- <title>🔒 Twitter</title>
</head>
<body style="margin-left:20px;width:300px;zoom:125%;">
<h3>Secure Twitter</h3>
<a href='..'>Go Home</a> -->
<?php
    // function getTime($t_time)
    // {
    //     $pt = time() - $t_time;
    //     if ($pt >= 86400)
    //         $p = date("F j, Y", $t_time);
    //     elseif ($pt >= 3600)
    //         $p = (floor($pt / 3600)) . "h";
    //     elseif ($pt >= 60)
    //         $p = (floor($pt / 60)) . "m";
    //     else
    //         $p = $pt . "s";
    //     return $p;
    // }

    // if (!$user_id) {
    //     echo "<a href='../register.php' class='btn btn-info btn-xs' style='float:right;'>Signup</a>";
    // }
    // if ($_GET['hashtag'] != "") {
    //     $hashtag = $_GET['hashtag'];
    //     echo "<div style='font-size:20px;'>Tweets with <a>#" . $hashtag . "</a></div>";
    //     include "connect.php";
    //     $tweets = mysqli_query($conn, "SELECT username, tweet, timestamp
	// 	FROM tweets
	// 	WHERE tweet REGEXP '^#$hashtag' OR tweet REGEXP ' #$hashtag'
	// 	ORDER BY timestamp DESC
	// 	LIMIT 0, 10
	// 	");
    //     if (mysqli_num_rows($tweets) > 0) {
    //         while ($tweet = mysqli_fetch_array($tweets)) {
    //             echo "<div class='well well-sm' style='padding-top:4px;padding-bottom:8px; margin-bottom:8px; overflow:hidden;'>";
    //             echo "<div style='font-size:10px;float:right;'>" . getTime($tweet['timestamp']) . "</div>";
    //             echo "<table>";
    //             echo "<tr>";
    //             echo "<td valign=top style='padding-top:4px;'>";
    //             echo "<img src='../default.jpg' style='width:35px;'alt='display picture'/>";
    //             echo "</td>";
    //             echo "<td style='padding-left:5px;word-wrap: break-word;' valign=top>";
    //             echo "<a style='font-size:12px;' href='../" . $tweet['username'] . "'>@" . $tweet['username'] . "</a>";
    //             $new_tweet = preg_replace('/@(\\w+)/', '<a href=../$1>$0</a>', $tweet['tweet']);
    //             $new_tweet = preg_replace('/#(\\w+)/', '<a href=./$1>$0</a>', $new_tweet);
    //             echo "<div style='font-size:10px; margin-top:-3px;'>" . $new_tweet . "</div>";
    //             echo "</td>";
    //             echo "</tr>";
    //             echo "</table>";
    //             echo "</div>";
    //         }
    //     } else {
    //         echo "<h5><i>No tweets found.</i><br> Be the first one to use <a href='..'>#$hashtag</a></h5>";
    //     }
    //     mysqli_close($conn);
    // } else {
    //     echo "<div class='alert alert-danger'>Sorry, invalid hashtag.</div>";
    //     echo "<a href='.' style='width:300px;' class='btn btn-info'>Go Home</a>";
    // }
?>
<!-- </body>
</html> -->
