<?php session_start();

require_once "./functions/sqli.inc.php";
$msg = false;

if (isset($_POST["submit"])) {
  $auth = getProduct("SELECT password FROM user WHERE username = '{$_POST["username"]}';");
  
  if (empty($auth)) {
    $msg = true;
    echo
    <<<JS
      <script id="temp">
      window.alert("Password or Username does not match");
      document.getElementById("temp").remove();
      </script>
    JS;
  } else {
    $user = (object)$_POST;
    $_SESSION["login"] = "1 $user->username";
    header("Location: ./");
    exit();
  }
}

function getPasswordHash(String $username)
{
  $hash = getProduct("SELECT password FROM user WHERE username = '$username';")[0]["password"];
  return password_verify($_POST["password"], $hash);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product manager | Login</title>
  <style>
    <?php require_once "./styles/global.css" ?>
    <?php require_once "./styles/login-style.css" ?>
    <?php require_once "./lib/bootstrap/css/bootstrap.css" ?>
  </style>
</head>

<body>
  <div class="wrapper">
    <h1>Login</h1>
    <form method="POST">
      <div class="input-wrapper">
        <label for="username">Username</label>
        <input name="username" required type="text" id="username" class="form-control">
        <?php
        if ($msg) echo "<small class=\"err-msg\">*Use the correct password or username</small>";
        ?>
      </div>
      <div class="input-wrapper">
        <label for="password">Password</label>
        <input name="password" required type="text" id="password" class="form-control">
        <small data-show="0" id="show-password-btn" class="show-btn">Show password</small>
      </div>
      <button name="submit" id="submit-btn" class="submit-btn">Login</button>
    </form>
  </div>

  <span class="m-auto h5 mt-3 mb-1">Created by <a href="https://kraken-afk.github.io">Kraken-afk</a></span>
  <script src="./js/_login.js"></script>
</body>

</html>