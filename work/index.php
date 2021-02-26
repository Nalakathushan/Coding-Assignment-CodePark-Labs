<?php


/*session_start();
if (isset($_SESSION['email'])) {
  header("Location:home.php");
} else {
}*/


if (isset($_POST['register'])) {
  include('config.php');



  $name = $con->real_escape_string($_POST['name']);
  $email = $con->real_escape_string($_POST['email']);
  $password = $con->real_escape_string($_POST['password']);





  if ($name == "" || $email == "" || $password == "")
    echo "Please check your inputs!";
  else {


    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $con->query("INSERT INTO registration (email,name,password)
                VALUES ('$email', '$name', '$password');
            ");
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
  <title>Register</title>
  <style>


  </style>
</head>

<body>

  <form method="POST" action="#">
    <label>
      <p class="label-txt">ENTER YOUR EMAIL</p>
      <input type="text" class="input" name="email" id="email">
      <div class="line-box">
        <div class="line"></div>
      </div>
    </label>
    <label>
      <p class="label-txt">ENTER YOUR NAME</p>
      <input type="text" class="input" name="name" id="name">
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

    <button type="submit" id="register" name="register">Register</button>
    <button type="submit">Cancel</button>
    <p>Already Register?<a href="login.php">Click Here</a>
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