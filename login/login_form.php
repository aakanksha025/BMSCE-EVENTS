<?php

include 'config.php';

error_reporting(0);

if(isset($_POST['submit'])) {
  $uptype = $_POST['uptype'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
  $usn = $_POST['usn'];

  if($password == $cpassword) {
    if($uptype == 'student') {
      
      $sql = "SELECT * FROM userLogin WHERE email='$email' ";
      $result = mysqli_query($conn, $sql);
      if(!$result->num_rows > 0){
        $sql = "INSERT INTO userLogin (username, email, password, usn) VALUES('$username', '$email', '$password', '$usn')";
        $result = mysqli_query($conn, $sql);
        if($result) {
          echo "<script>alert('Wow! User Registration Complete.')</script>";
          $username = "";
          $email = "";
          $_POST['password'] = "";
          $_POST['cpassword'] = "";
        } 
        else {
          echo "<script>alert('Woops! Something went Wrong.')</script>";
        }
      }
      else{
        echo "<script>alert('Woops! Email Already Exists.')</script>";
      }
    }

    else if($uptype == 'event_coordinator') {
      $sql = "SELECT * FROM cordLogin WHERE email='$email' ";
      $result = mysqli_query($conn, $sql);
      if(!$result->num_rows > 0){
        $sql = "INSERT INTO cordLogin (username, email, password, usn) VALUES('$username', '$email', '$password', '$usn')";
        $result = mysqli_query($conn, $sql);
        if($result) {
          echo "<script>alert('Wow! User Registration Complete.')</script>";
          $username = "";
          $email = "";
          $_POST['password'] = "";
          $_POST['cpassword'] = "";
        } 
        else {
          echo "<script>alert('Woops! Something went Wrong.')</script>";
        }
      } 
      else {
        echo "<script>alert('Woops! Email Already Exists.')</script>";
      }
    }
  }

  else {
    echo "<script>alert('Password Not Matched.')</script>";
  }
}

session_start();

if(isset($_POST['ssubmit'])) {
  $intype = $_POST['intype'];
  $susername = $_POST['susername'];
  $spassword = md5($_POST['spassword']);

  if($intype == 'student') {
    $sql = "SELECT * FROM userLogin WHERE username='$susername' AND password='$spassword'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['susername'] = $row['username'];
      header("Location: ../HomePage/index.html");
    }
    else {
      echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
    }
  }

  else if($intype == 'event_coordinator') {
    $sql = "SELECT * FROM cordLogin WHERE username='$susername' AND password='$spassword'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['susername'] = $row['username'];
      header("Location: ../coordinator/view.php");
    }  
    else {
      echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
  <script type = "text/javascript" >  
        function preventBack() { window.history.forward(); }  
        setTimeout("preventBack()", 0);  
        window.onunload = function () { null };  
    </script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="loginform_style.css" />
    <title>BMSCE Events</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="#" method="POST" class="sign-in-form">
            <h2 class="title">Sign in</h2>

            <div class="login-type">
              <input type="radio" value="student" name="intype" required/>&nbsp;Student&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" value="event_coordinator" name="intype"/>&nbsp;Event Coordinator
            </div>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="susername" required />
            </div>

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="spassword" required/>
            </div>
            
            <input type="submit" value="Login" name="ssubmit" class="btn solid"/>
          </form>
          
          <form action="#" method="POST" class="sign-up-form">
            <h2 class="title">Sign up</h2>

            <div class="login-type">
              <input type="radio" value="student" name="uptype" required/>&nbsp;Student&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" value="event_coordinator" name="uptype"/>&nbsp;Event Coordinator
            </div>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" required/>
            </div>

            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input id="EmailText" type="email" placeholder="Email" name="email" required />
            </div>

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input id="PassText" type="password" placeholder="Password" name="password" required/>
            </div>
            
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input id="PassText" type="password" placeholder="Confirm Password" name="cpassword" required/>
            </div>
            
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="USN" name="usn" required/>
            </div>
            <input name="submit" type="submit" class="btn" value="Sign up" 
            onclick="ValidateEmail(document.getElementById('EmailText'),document.getElementById('PassText'))" 
             />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>WELCOME TO BMSCE Events</h3>
            <p>
              Don't have an accout?
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="login_img/img_1.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>SIGN UP FOR BMSCE Events Account</h3>
            <p>
              Already have an account?
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="login_img/img_2.png" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="login.js"></script>
  </body>
</html>
