<?php

	session_start();
	$con = mysqli_connect('localhost','root','','student');
	//mysqli_select_db($con,'assessmentportal');
	if($con === false) 
	{
	die("ERROR:Could not connect.".mysqli_connect_error());
	}

	$table = $_SESSION['tablename'];
	$index = $_SESSION['callindex'];
	//$total = $_SESSION['totalstudents'];
	$index = (int)($index/10) + 1; // column index for marks for finding the subject number

	//echo $table;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
			$marks = $_POST['marks'];
            //$res = mysqli_query("SELECT * FROM `".$table."` WHERE 1",$con);
            $colname = "grade" . "$index";
            $query = "SELECT rollno FROM `".$table."` WHERE 1";
            $result1 = mysqli_query($con,$query);
            
            $j=0;
            $count = count($marks);
            //foreach( $marks as $key => $n )
            while($j < $count  && $row = mysqli_fetch_assoc($result1)){
            	$n = $marks[$j];
                $rollno = $row['rollno'];
            	$res = "UPDATE `".$table."` SET  ".$colname." = '".$n."' WHERE rollno = '$rollno'";
            	$result = mysqli_query($con,$res);

            	if( $result == false )
            	{
            		echo 'fail';
            		header('location: rollno_midterm.php');

            	}
            	$j+=1;
            	//echo $i;
            }
			//echo 'success';
			 $name = $_SESSION['username']; 
            $code =  $_SESSION['SubCode'];
            $branch =  $_SESSION['Branch'];
             $sem = $_SESSION['Sem'];
             $query1 = "UPDATE `faculty1` SET `Grade`='1' WHERE Name = '$name' && SubCode = '$code' && Sem = '$sem' &&  Branch=
             '$branch'";
             $result1 = mysqli_query($con,$query1);
			echo "<script> alert('Marks Added Successfully'); </script>";
			$_SESSION['midterm'] = 'true';
			$_SESSION['colname'] = $colname;
			header( "refresh:1;url=papers.php" );   // after submitting marks back to papers.php
		  
			//echo 'hello';
	}
	else{
		header('location: rollno_midterm.php');
	}

?>