<?php
  session_start();
$db = mysqli_connect('localhost', 'root', '', 'student');
$user = $_SESSION['username'];
$_SESSION['link'] = 'home.php';
$_SESSION['paper'] = 'paper.php';
?>
<!DOCTYPE html>
<html lan="en">
<head>
    <title>exam portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style5.css" />

</head>
<body>

   <div id="image">
        <img src="https://img.collegepravesh.com/2015/12/IGDTUW-Logo.png" alt="IGDTUW" width="150" height="150"  style="margin-left:8%">
    </div>
	<div class="top" style=" margin-top:-10%;margin-left:23%; align:center">
	<p style="font-size:30px; color:green"><b>INDIRA GANDHI DELHI TECHNICAL UNIVERSITY FOR WOMEN</b></p>
	<p style="margin-left:33%; margin-top:-2%; font-size:20px"><b>Kashmere Gate, Delhi-110006<b></p>
	</div>
	<br>
	<hr size='10'; color='green'></hr>
    <div id="navbar">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="paper.php">Display Papers</a></li>
            <li><a href="#contact">Attendance</a></li>
            <?php 

            $name = "admin";
             $query = "SELECT * FROM `admin` WHERE  Name='$name' ";
             $results = mysqli_query($db, $query);
             $row=mysqli_fetch_assoc($results);
             if($row['Checked'] == 0)
             { ?>
            <li><a href="result.php">Results</a></li>
            <?php
              } 
              else
              {
                ?>
            <li><a href="final_result.php">Results</a></li>
            <?php
              }
            ?>

            <li><a href="#about">Notifications</a></li>
        </ul>
    </div>
    <br>
    <div id="navbar1">
        <ul>
            <li><a href="#enrollno.">Welcome <?php echo $user; ?></a></li>
            <li><a href="changePassword.php">Change password</a></li>
            <li><a href="front.php?logout='1'">Log Out</a></li>

        </ul>
    </div>
    <?php
	$query = "SELECT * FROM register WHERE Enrollment_No='$user'";
    $results = mysqli_query($db, $query);
    $row=mysqli_fetch_assoc($results);
	$imagesrc = 'data:image/jpeg;base64,'.base64_encode( $row['Photo'] ).'';
	$image2src = 'data:image/jpeg;base64,'.base64_encode( $row['Signature'] ).'';
    ?>
    <div id="maincontent">

        <div id="details">

            <div class="det" style="height: 10%;background-color:green;">
                <p style="color: white;background-color:green;">Profile</p>
            </div>
			<br><br>
            <img src="<?php echo $imagesrc; ?>" style="text-align: center" class="img-circle" height='100%' width ='100%' alt="Profile Pic">
			<br>
			<img src="<?php echo $image2src; ?>" style="text-align: center" class="img-circle" height='100%' width ='100%' alt="Profile Pic">
            <hr>

            <div class="stt">
                <p>Enrollment No:<?php echo $user;?></p>
                <hr style="border-top: dotted 1px;" />
                <p>Name:<?php echo $row["Name"];?></p>
                <hr style="border-top: dotted 1px;" />
                <p>Semester:<?php echo $row["Semester"];?></p>
                <hr style="border-top: dotted 1px;" />
                <br>

            </div>
        </div>
        <div id="side" style="margin-top: -39%;">
            <br>
            <p style="text-align: center;font-size: 24px">STUDENT BASIC DETAILS</p>
            <br><br>
            <div id="as" style="font-size: 20px;margin-top: -4%">
                <p>Father's Name:             <?php echo $row["Father's_Name"];?></p>
                <p>Mother's Name:             <?php echo $row["Mother's_Name"];?></p>
				<?php 
				$add = $row["Address Line 1"];
				$city = $row["City"];
				$distt = $row["District"];
				$state = $row["State"];
				$pin = $row["Pincode"];
				$a = $add.', '.$city.', '.$distt.', '.$state.' - '.$pin;
				?>
                <p>Address:                   <?php echo $a;?></p>
                <p>Mobile No. :               <?php echo $row["Contact_No"];?></p>
                <p>Email-Id :                 <?php echo $row["Email_ID"];?></p>
            </div>
            <br><br><br><br>
        </div>
    </div>
    <div id="last">
        <h2 style="color: white">Copyright of IGDTUW</h2>
    </div>
    <div id="blc">
        <h2>IGDTUW-EXAMINATION DIVISION</h2>
    </div>
    <?php
    mysqli_free_result($results);
    mysqli_close($db);?>
</body>
</html>