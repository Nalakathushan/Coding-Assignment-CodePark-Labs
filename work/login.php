<?php
include "config.php";

// Start the session
/*session_start();
if (isset($_SESSION['email'])) {
  header("Location:home.php");
} else {
}*/

if (isset($_POST['submit'])) {

  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  if ($email != "" && $password != "") {

    $sql_query = "select count(*) as registration from registration where email='" . $email . "' and password='" . $password . "'";
    $result = mysqli_query($con, $sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['registration'];

    if ($count > 0) {
      echo "username and password";
      $_SESSION['email'] = $email;
      header('Location: home.php');
    } else {
      echo "Invalid username and password";
    }
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
  <style>


  </style>
</head>

<body>

  <form method="POST" action="#">
    <label>
      <p class="label-txt">ENTER YOUR EMAIL</p>
      <input type="text" class="input" name="email" id="name">
      <div class="line-box">
        <div class="line"></div>
      </div>
    </label>

    <label>
      <p class="label-txt">ENTER YOUR PASSWORD</p>
      <input type="password" class="input" name="password" id="password">
      <div class="line-box">
        <div class="line"></div>
      </div>
    </label>
    <button type="submit" name="submit" id="submit">Login</button>
    <button type="submit">Cancel</button>

  </form>



</body>
<script>
$(document).ready(function() {

  $('.input').focus(function() {
    $(this).parent().find(".label-txt").addClass('label-active');
  });

  $(".input").focusout(function() {
    if ($(this).val() == '') {
      $(this).parent().find(".label-txt").removeClass('label-active');
    };
  });

});
</script>

</html>