<?php
include 'config.php';

session_start();
$uname = $_SESSION['susername'];

if(isset($_SESSION['susername'])){
    $sql = "SELECT * FROM userlogin a, registration b where a.username = '$uname' and a.usn=b.USN";   
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $usn= $row['USN'];
            $email= $row['email'];
            $fname= $row['First_name'];
            $lname= $row['Last_name'];
            $contact= $row['contact'];
            $sem= $row['sem'];
            $section= $row['section'];
        }
    }
    else {
        $sql = "SELECT * FROM userlogin  where username = '$uname'";   
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            $usn= $row['usn'];
            $email= $row['email'];
            $fname= "--";
            $lname= "--";
            $contact= "--";
            $sem= "--";
            $section= "--";

        }
    }
}
else {
    echo "<script>alert('Woops! Not recognized.')</script>";
}

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $sem = $_POST['sem'];
    $section = $_POST['sec'];

    $query = "UPDATE registration set email='$email', First_name='$fname', Last_name='$lname', contact='$contact', sem='$sem', section='$section'
              where USN='$usn'";
    $upresult = mysqli_query($conn, $query);

    $loginquery = "UPDATE userlogin set email='$email', username='$uname'
                   where usn='$usn'";
    $loginresult = mysqli_query($conn, $loginquery);

    $tosql = "SELECT * FROM registration";   
    $toresult = mysqli_query($conn, $tosql);
    $count =0;
    if(mysqli_num_rows($toresult) > 0){
        while($torow = mysqli_fetch_array($toresult)){
            if($usn == $torow['USN']){
                $count++;
            }
        }
        if($count == 0){
            $insql = "INSERT INTO registration ( First_name, Last_name, USN, email, sem, section, contact)
                      VALUES ('$fname','$lname','$usn','$email','$sem','$section','$contact')";
            $inresult = mysqli_query($conn, $insql);
        }
        
    }

    if($upresult) {
        header("Location: profilepage.php"); 
    }
    else {
        echo "<script>('Woops! no update.')</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile Card</title>
    <link rel="stylesheet" href="profilepage.css">
    <link rel="stylesheet" href="navbar.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="left">
            <img src="user image.png" alt="user" width="100"><br>
            
        </div>
        <div class="right">
            <div class="info"> 
                <h3>Personal Details</h3> 
                <form method="post">
                <div class="info_data">
                    <div class="data">
                    <h4>USN</h4>  
                           <p><?php if(mysqli_num_rows($result) > 0){
                                        echo $usn;
                                    }
                                else{
                                    echo "--";
                                }
                        ?><br>
                               </p>
                    </div>
                    <div class="data">
                        <h4>Username</h4>
                        <p> <input type="text" name="uname" value="<?php if(mysqli_num_rows($result) > 0){
                                echo $uname;    
                        }
                        else{
                            echo "--";
                        }
                      ?>"></p>
                    </div>
                </div>
                <br>
                <div class="info_data">
                    <div class="data">
                        <h4>Email</h4>
                        <p><input type="text" name="email" value="<?php if(mysqli_num_rows($result) > 0){
                                echo $email;    
                        }
                        else{
                            echo "--";
                        }
                      ?>"></p>
                    </div>

                    <div class="data">
                        <h4>Contact No.</h4>
                        <p><input type="text" name="contact" value="<?php if(mysqli_num_rows($result) > 0){
                                echo $contact;    
                        }
                        else{
                            echo "--";
                        }
                      ?>"></p>
                    </div>
                </div>
                <br>
                <div class="info_data">
                    <div class="data">
                        <h4>First Name</h4>
                        <p><input type="text" name="fname" value="<?php if(mysqli_num_rows($result) > 0){
                                echo $fname;    
                        }
                        else{
                            echo "--";
                        }
                      ?>"></p>
                    </div>
                    <div class="data">
                        <h4>Last Name</h4>
                        <p><input type="text" name="lname" value="<?php if(mysqli_num_rows($result) > 0){
                                echo $lname;    
                        }
                        else{
                            echo "--";
                        }
                      ?>"></p>
                    </div>
                </div>
                <br>
                <div class="info_data">
                    <div class="data">
                        <h4>Semester</h4>
                        <p><input type="text" name="sem" value="<?php if(mysqli_num_rows($result) > 0){
                                echo $sem;    
                        }
                        else{
                            echo "--";
                        }
                      ?>"></p>
                    </div>
                    <div class="data">
                        <h4>Section</h4>
                        <p><input type="text" name="sec" value="<?php if(mysqli_num_rows($result) > 0){
                                echo $section;    
                        }
                        else{
                            echo "--";
                        }
                      ?>"></p>
                    </div>
                </div><br>
                <button name="submit" type="submit" >Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>