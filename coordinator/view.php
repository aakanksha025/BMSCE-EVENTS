<?php
include_once('connect.php');


if(isset($_POST['submit'])) {
    $event_id = $_POST['event_id'];
}
    $event_id = (string)filter_input(INPUT_POST, 'event_id');
    $sql = "SELECT * FROM registration where event_id = '$event_id'";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tables.css">
        <title>Coordinator</title>
    </head>
    <body>
        <div class="top">
            <a href="../login/login_form.php"><button name="submit" class="btn">Sign Out</button></a>
        </div>
        <form action="" method="POST">
        <div class="wrapper">
        <div class="form">
            <div class="inputfield"><b>
                <label>Event ID</label><br><br>
                <input type="text" class="input" name="event_id"  required><br><br></b>
            </div>
            <button name="submit" class="btn">Submit</button> 
       </div>
       </div>


       <div class="content">
       <table class="content-submit">
       <thead>
            <tr>
                <th> First Name</th>
                <th> Last Name</th>
                <th> USN </th>
                <th> email </th>
                <th> Semester </th>
                <th> Section </th>
                <th> Contact Number </th>
                <th> Event Name </th>
                <th> Event ID</th>
            </tr>
        </thead>
        
        <span style="color: orange;">
<?php
    if(isset($_POST['submit'])){
        if(mysqli_num_rows($result) < 1){
            echo "<h2>No registrations for this event.</h2>";
        }
    }
        while($rows = mysqli_fetch_assoc($result)){
?>

                <tr>
                    <td><?php echo $rows['First_name']; ?> </td>
                    <td><?php echo $rows['Last_name']; ?> </td>
                    <td><?php echo $rows['USN']; ?> </td>
                    <td><?php echo $rows['email']; ?> </td>
                    <td><?php echo $rows['sem']; ?> </td>
                    <td><?php echo $rows['section']; ?> </td>
                    <td><?php echo $rows['contact']; ?> </td>
                    <td><?php echo $rows['event_name']; ?> </td>
                    <td><?php echo $rows['event_id']; ?> </td>
                </tr>

                <?php
                    }
                ?>
                </span>
                
        </table>
        </div>
        

        <div class="content">
        <h1> Cultural Events</h1>
        <table class="content-table">
            <thead>
                <tr>
                    <th>S no.</th>
                    <th>Host Club</th>
                    <th>Event Name</th>
                    <th>Event ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>DANZADDIX</td>
                    <td>Group western Dance</td>
                    <td>546</td>
                </tr>
                <tr class="active-row">
                    <td>2</td>
                    <td>DANZADDIX</td>
                    <td>Solo Dance audition</td>
                    <td>002</td>

                </tr>
                <tr>
                    <td>3</td>
                    <td>DANZADDIX</td>
                    <td>Eastern group dance</td>
                    <td>124</td>

                </tr>
                <tr class="active-row">
                    <td>4</td>
                    <td>DANZADDIX</td>
                    <td>Contemporary workshop</td>
                    <td>542</td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>5</td>
                    <td>Inksanity</td>
                    <td>Debate Melange</td>
                    <td>113</td>
                </tr>
                <tr class="active-row">
                    <td>6</td>
                    <td>Inksanity</td>
                    <td>Poem Writing</td>
                    <td>134</td>

                </tr>
                <tr>
                    <td>7</td>
                    <td>Inksanity</td>
                    <td>Parliamentary debate</td>
                    <td>234</td>

                </tr>
                <tr class="active-row">
                    <td>8</td>
                    <td>Inksanity</td>
                    <td>Public Speaking</td>
                    <td>962</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Dramatics Club</td>
                    <td>Nari Raksha</td>
                    <td>124</td>
                </tr>
                <tr class="active-row">
                    <td>10</td>
                    <td>Dramatics</td>
                    <td>Midsummer night's dream</td>
                    <td>046</td>

                </tr>
                <tr>
                    <td>11</td>
                    <td>Dramatics Club</td>
                    <td>Improv</td>
                    <td>118</td>

                </tr>
                <tr class="active-row">
                    <td>12</td>
                    <td>Dramatics Club</td>
                    <td>Express</td>
                    <td>462</td>
                </tr>

                <tr>
                    <td>13</td>
                    <td>Fine Arts </td>
                    <td>Paint the puzzle</td>
                    <td>009</td>
                </tr>
                <tr class="active-row">
                    <td>14</td>
                    <td>Fine Arts</td>
                    <td>Don't Brush</td>
                    <td>012</td>

                </tr>
                <tr>
                    <td>15</td>
                    <td>Fine Arts</td>
                    <td>Manga Drawing Competition</td>
                    <td>008</td>

                </tr>
                <tr class="active-row">
                    <td>16</td>
                    <td>Fine Arts</td>
                    <td>Sketch workshop</td>
                    <td>548</td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>Music </td>
                    <td>Sargam</td>
                    <td>146</td>
                </tr>
                <tr class="active-row">
                    <td>18</td>
                    <td>Music</td>
                    <td>Vocal Solo</td>
                    <td>005</td>

                </tr>
                <tr>
                    <td>19</td>
                    <td>Music</td>
                    <td>Battle of Bands</td>
                    <td>128</td>

                </tr>
                <tr class="active-row">
                    <td>20</td>
                    <td>Music</td>
                    <td>Riyaaz</td>
                    <td>198</td>
                </tr>
                <tr>
                    <td>21</td>
                    <td>Photography</td>
                    <td>Panorama</td>
                    <td>001</td>
                </tr>
                <tr class="active-row">
                    <td>22</td>
                    <td>Photography</td>
                    <td>RVCE photo show</td>
                    <td>482</td>

                </tr>
                <tr>
                    <td>23</td>
                    <td>Photography</td>
                    <td>photo stage</td>
                    <td>112</td>

                </tr>
                <tr class="active-row">
                    <td>24</td>
                    <td>Photography</td>
                    <td>Portrait workshop</td>
                    <td>568</td>
                </tr>

                <tr>
                    <td>25</td>
                    <td>Quizzing</td>
                    <td>General Quiz</td>
                    <td>028</td>
                </tr>
                <tr class="active-row">
                    <td>26</td>
                    <td>Quizzing</td>
                    <td>Fandom Quiz</td>
                    <td>029</td>

                </tr>
                <tr>
                    <td>27</td>
                    <td>Quizzing</td>
                    <td>Anime Quiz</td>
                    <td>030</td>

                </tr>
                <tr class="active-row">
                    <td>28</td>
                    <td>Quizzing</td>
                    <td>Become a qizzer</td>
                    <td>104</td>
                </tr>

            </tbody>
        </table>
        <br>
        <h1>Tech Hub</h1>
        <table class="content-table">
            <thead>
                <tr>
                    <th>S no.</th>
                    <th>Club</th>
                    <th>Event Name </th>
                    <th>Event ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td> IEEE</td>
                    <td>Machine Learning workshop</td>
                    <td>149</td>

                </tr>
                <tr class="active-row">
                    <td>2</td>
                    <td>IEEE</td>
                    <td>Cloud Computing Seminar</td>
                    <td>141</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pentagram</td>
                    <td>HourGlass</td>
                    <td>426</td>

                </tr>
                <tr class="active-row">
                    <td>4</td>
                    <td>Pentagram</td>
                    <td>Treasure Hunt</td>
                    <td>076</td>

                </tr>
                <tr>
                    <td>5</td>
                    <td>Pentagram</td>
                    <td>Math Mania</td>
                    <td>106</td>

                </tr>
                <tr class="active-row">
                    <td>6</td>
                    <td>Rotaract</td>
                    <td>Career Beat</td>
                    <td>376</td>

                </tr>
                <tr>
                    <td>7</td>
                    <td>Rotaract</td>
                    <td>Read Along the Carnival</td>
                    <td>356</td>

                </tr>
                <tr class="active-row">
                    <td>8</td>
                    <td>Rotaract</td>
                    <td>Transcendence </td>
                    <td>276</td>

                </tr>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Rotaract</td>
                    <td>Virtual Discuss </td>
                    <td>176</td>

                </tr>
                <tr class="active-row">
                    <td>10</td>
                    <td>Protocol</td>
                    <td>SkillX</td>
                    <td>372</td>

                </tr>
                <tr>
                    <td>11</td>
                    <td>Protocol</td>
                    <td>Proto-Flag </td>
                    <td>576</td>

                </tr>
            </tbody>
        </table>
        <br>
        <h1>Coder's Arena</h1>
        <table class="content-table">
            <thead>
                <tr>
                    <th>S no.</th>
                    <th>Event Name</th>
                    <th>Event ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Hacker Fest</td>
                    <td>173</td>

                </tr>
                <tr class="active-row">
                    <td>2</td>
                    <td>Web Page Design</td>
                    <td>229</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Know the Unknown</td>
                    <td>119636</td>

                </tr>
            </tbody>
        </table>
        <br>
        <h1>Sports</h1>
        <table class="content-table">
            <thead>
                <tr>
                    <th>S no.</th>
                    <th>Event Name</th>
                    <th>Event ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Basketball</td>
                    <td>910</td>

                </tr>
                <tr class="active-row">
                    <td>2</td>
                    <td>Chess</td>
                    <td>920</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Badminton</td>
                    <td>900</td>

                </tr>
                <tr class="active-row">
                    <td>4</td>
                    <td>Football</td>
                    <td>930</td>

                </tr>
                <tr>
                    <td>5</td>
                    <td>Volleyball</td>
                    <td>960</td>

                </tr>
                <tr class="active-row">
                    <td>6</td>
                    <td>Handball</td>
                    <td>940</td>

                </tr>
                <tr>
                    <td>7</td>
                    <td>Kho-Kho</td>
                    <td>950</td>

                </tr>
            </tbody>
        </table>
    </div>
    </body>
</html>