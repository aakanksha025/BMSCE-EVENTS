<?php  

include 'config.php';
error_reporting(0);

if(isset($_POST['submit'])) {
  $fname = $_POST['First_name'];
  $lname = $_POST['Last_name'];
  $USN = $_POST['USN'];
  $email = $_POST['email'];
  $sem = $_POST['sem'];
  $sec = $_POST['section'];
  $contact = $_POST['contact'];
  $ename = $_POST['event_name'];
  $eid = $_POST['event_id'];

  $sql = "INSERT INTO registration ( First_name, Last_name, USN, email, sem, section, contact, event_name, event_id)
          VALUES ('$fname','$lname','$USN','$email','$sem','$sec','$contact','$ename','$eid')";
          $result = mysqli_query($conn, $sql);
          if(!$result) {
            echo "<script>alert('Woops!')</script>";
          }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="registration-style.css">
</head>
<body>

<div class="wrapper">
    <div class="title">
      Registration Form
    </div>
    <form action="" method="POST">
        <div class="form">
       <div class="inputfield">
          <label>First Name</label>
          <input type="text" class="input" name="First_name" value="<?php echo $fname; ?>">
       </div>  
        <div class="inputfield">
          <label>Last Name</label>
          <input type="text" class="input" name="Last_name" value="<?php echo $lname; ?>">
       </div>  
       <div class="inputfield">
          <label>USN</label>
          <input type="text" class="input" name="USN" value="<?php echo $USN; ?>">
       </div>  
       <div class="inputfield">
          <label>BMSCE E-Mail</label>
          <input type="text" class="input" name="email" value="<?php echo $email; ?>">
       </div> 
       <div class="inputfield">
          <label>Sem</label>
          <input type="number" class="input" name="sem" value="<?php echo $sem; ?>">
       </div> 
        <!-- <div class="inputfield">
          <label>Semester</label>
          <div class="custom_select">
            <select name="sem">
              <option value="">Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
            </select>
          </div>
       </div> --> 
       <div class="inputfield" >
          <label>Section</label>
          <input type="text" class="input" name="section" value="<?php echo $sec; ?>">
       </div> 
      <div class="inputfield">
          <label>Contact Number</label>
          <input type="text" class="input" name="contact" value="<?php echo $contact; ?>">
       </div> 
      <div class="inputfield">
          <label>Event Name</label>
          <input type="text" class="input" name="event_name" value="<?php echo $ename; ?>">
       </div> 
      <div class="inputfield">
          <label>Event Id(provided on the information page)</label>
          <input type="text" class="input" name="event_id" value="<?php echo $eid; ?>">
       </div> 
        <h4>Pay using UPI to number: 798322222</h4>
        <div class="inputfield">
          <label>Payment Screenshot</label>
          <div class ="payment-btn">
            <input type="file" id="myfile" name="myfile">
          </div>
       </div> 
      <div class="inputfield terms">
          <label class="check">
            <input type="checkbox">
            <span class="checkmark"></span>
          </label>
          <p>I Confirm the above details</p>
       </div> 
      <div class="inputfield">
        <button name="submit" class="btn">Register</button>
        <!-- <input type="submit" value="Register" class="btn"> -->
      </div>
    </div>
</div>
    </form> 
  
</body>
</html>