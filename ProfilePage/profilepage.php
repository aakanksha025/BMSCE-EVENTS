<?php
include 'config.php';
session_start();
$username = $_SESSION['susername'];

if(isset($_SESSION['susername'])){
    $sql = "SELECT * FROM userlogin a, registration b where a.username = '$username' and a.usn=b.USN";   
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $number = mysqli_num_rows($result);
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
        $number = '0';
        $sql = "SELECT * FROM userlogin  where username = '$username'";   
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

    $sqly = "SELECT * FROM userlogin a, registration b where a.username = '$username' and a.usn=b.USN";   
    $res = mysqli_query($conn, $sqly);
}
else {
    echo "<script>alert('Woops! Not recognized.')</script>";
}

if(isset($_POST['deletesubmit'])){
    $value = $_POST['deletesubmit'];

    $idsql = "SELECT * FROM registration WHERE event_id= '$value' AND USN= '$usn'";   
    $idresult = mysqli_query($conn, $idsql);

    if($idresult){
        if(mysqli_num_rows($idresult) > 0){
            while($idrow = mysqli_fetch_array($idresult)){
                $ids= $idrow['id'];
            }
            $query = "DELETE FROM registration where id ='$ids'";
            $delresult = mysqli_query($conn, $query);
            
            if($delresult) {
                header("Location: profilepage.php");
            }
            else {
                echo "<script>alert('Woops! Not deleted.')</script>";
            }
        } 
    }
    else{
        echo"<script>alert('Woops! Not recognized.')</script>";
    }  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CSS User Profile Card</title>
    <link rel="stylesheet" href="profilepage.css">
    <link rel="stylesheet" href="navbar.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
    <nav>
        <div class="logo">
        </div>
        <input type="checkbox" id="click">
        <label for="click" class="menu-btn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li><a href="../HomePage/index.html">Home</a></li>
            <li><a href="../HomePage/cultural.html">Cultural</a></li>
            <li><a href="../Techub/Tech_Hub_HomePage.html">Tech Hub</a></li>
            <li><a href="../CodersArena/Coder_Homepage/coder_Arena.html">Coders Arena</a></li>
            <li><a href="../sports/sportshomepage.html"> Sports</a></li>
            <li><a class="active" href="profilepage.php"> My Profile</a></li>
        </ul>
    </nav>

    <div class="wrapper">
        <div class="left">
            <img src="user image.png" alt="user" width="100"><br>
            <a href="update.php">
                    <button type="button" class="up">Update</button></a><br><br>
                    <a href="../login/login_form.php"><button type="button">Sign Out</button></a>
        </div>
        <div class="right">
            <div class="info"> 
                <h3>Personal Details</h3> 
                <div class="info_data">
                    <div class="data">
                        <h4>USN</h4>  
                        <p><?php if(mysqli_num_rows($result) > 0){
                                    echo $usn;
                                }
                                else{
                                    echo "--";
                                }
                            ?>
                        </p>
                    </div>
                    <div class="data">
                        <h4>Username</h4>
                        <p> <?php echo $_SESSION['susername']; ?></p>
                    </div>
                </div>
                <br>
                <div class="info_data">
                    <div class="data">
                        <h4>Email</h4>
                        <p><?php if(mysqli_num_rows($result) > 0){
                                echo $email;    
                        }
                        else{
                            echo "--";
                        }
                      ?></p>
                    </div>

                    <div class="data">
                        <h4>Contact No.</h4>
                        <p><?php if(mysqli_num_rows($result) > 0){
                                echo $contact;    
                        }
                        else{
                            echo "--";
                        }
                      ?></p>
                    </div>
                </div>
                <br>
                <div class="info_data">
                    <div class="data">
                        <h4>First Name</h4>
                        <p><?php if(mysqli_num_rows($result) > 0){
                                echo $fname;    
                        }
                        else{
                            echo "--";
                        }
                      ?></p>
                    </div>
                    <div class="data">
                        <h4>Last Name</h4>
                        <p><?php if(mysqli_num_rows($result) > 0){
                                echo $lname;    
                        }
                        else{
                            echo "--";
                        }
                      ?></p>
                    </div>
                </div>
                <br>
                <div class="info_data">
                    <div class="data">
                        <h4>Semester</h4>
                        <p><?php if(mysqli_num_rows($result) > 0){
                                echo $sem;    
                        }
                        else{
                            echo "--";
                        }
                      ?></p>
                    </div>
                    <div class="data">
                        <h4>Section</h4>
                        <p><?php if(mysqli_num_rows($result) > 0){
                                echo $section;    
                        }
                        else{
                            echo "--";
                        }
                      ?></p>
                    </div>
                </div>
            </div>

            <div class="projects">
                <h3>Events</h3>
                <div class="projects_data">
                    <div class="data">
                        <table style="width:100%">
                            <tr>
                                <th>Event Name</th>
                                <th>Event ID</th>
                                <th> </th>
                            </tr>
                            <tr>
                                <?php if(mysqli_num_rows($res) > 0){
                                    while($roweve = mysqli_fetch_array($res)){
                                        $x = 0;
                                            echo "<td>" . $roweve['event_name'] . "</td>";
                                ?> 

                                <?php if($roweve['event_id'] > 0){
                                    echo "<td>" . $roweve['event_id'] . "</td>"; 
                                ?>
                            
                            <form method="post">
                                <td><?php $button[$x] = $roweve['event_id']; ?>
                                    <button name='deletesubmit' value="<?php echo $button[$x] ?>">Unregister</button>
                                </td>
                            </form>
                            </tr>
                            <?php } $x++;} } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>