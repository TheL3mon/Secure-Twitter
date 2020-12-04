<?php
    // error_reporting (E_All^E_Notice);
    session_start();
    $user_id = isset($_SESSION['user_id']);

    if (empty($_SESSION['key']))
        $_SESSION['key'] = bin2hex(random_bytes(32));

    $csrf = hash_hmac('sha256','some string: register.php', $_SESSION['key']);
?>
<!DOCTYPE html>
<html>
<head>
    <!-- reusable: meta, bootstrap, favicons, theme color -->
    <?php include("head.html"); ?>

    <title>🔒 Twitter</title>
</head>
<body class="bg-light" style="margin:1rem calc((100vw - 300px)/2);width:300px;">
<h3 class="mb-5 text-center">
    <svg viewBox="0 0 24 24" style="height: 30px; margin: -5px 10px 0 0;"><g><path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z" fill="rgb(29, 161, 242)"></path></g></svg>Secure Twitter
</h3>
<form action="register.php" method="POST" role="form" style="width:300px;">
    <?php
        if (isset($_POST['btn']) == "submit-register-form") {
             if(hash_equals($csrf, $_POST['csrf'])){
                
             }else{
                echo 'Something went wrong';  
                session_destroy();
                exit;
            }
            if ($_POST['username'] != "" && $_POST['password'] != "" && $_POST['confirm-password'] != "") {
                if ($_POST['password'] == $_POST['confirm-password']) {
                    include 'connect.php';
                    $username = htmlentities(strtolower($_POST['username']));
                    
                    $stmt=$pdo->prepare("SELECT username FROM users WHERE username=:userName");
                    $stmt->bindParam(':userName', $username);
                    $stmt->execute();
                    $stmt->fetch();
                    $nrows1 = $stmt->rowCount();
                    
                    if (!($nrows1 >= 1)) {
                        $password = htmlentities(hash('sha256', $_POST['password']));
                        include 'connect.php';
                        $sth = $pdo->prepare("INSERT INTO users(username, password) VALUES (:userName, :passw)");
                        $sth->bindParam(':userName', $username);
                        $sth->bindParam(':passw', $password);
                        $sth->execute();
                        echo "<div class='alert alert-success'>Your account has been created!</div>";
                        echo "<a href='.' style='width:300px;' class='btn btn-info'>Go Home</a>";
                        echo "</form>";
                        echo "<br>";
                        echo "</body>";
                        echo "</html>";
                        exit;

                    } else {
                        $error_msg = "Username already exists. Try using a different one!";
                    }
                } else {
                    $error_msg = "Passwords did not match.";
                }
            } else {
                $error_msg = "All fields must be filled!";
            }
        }
    ?>
    <h4>Create your account</h4>
    <input type="hidden" name="csrf" value="<?php echo $csrf ?>" />
    <div class="input-group mb-2" style="margin-bottom:10px;">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username"
               aria-describedby="basic-addon1"
               name="username" value="">
    </div>
    <input type="password" class="form-control mb-2" placeholder="Password" name="password">
    <input type="password" class="form-control mb-2" placeholder="Confirm Password"
           name="confirm-password">
    <?php
        if (isset($error_msg)) {
            echo "<div class='alert alert-danger'>" . $error_msg . "</div>";
        }
    ?>
    <div class="btn-group mt-3">
        <button type="submit" style="width:180px;" class="btn btn-primary" name="btn" value="submit-register-form">
            Register
        </button>
        <a href="." style="width:120px;" class="btn btn-secondary">Log in</a>
    </div>
</form>
</body>
</html>
