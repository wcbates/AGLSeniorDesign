<html>
<head>
<title>AGL: Audition</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include 'MasterCode.php';
$role = $_COOKIE['role'];
$email = $_COOKIE['email'];
$password = $_COOKIE['password'];
$showtitle = $_COOKIE['showtitle'];
$showID = $_COOKIE['showID'];

	//No unauthorized access
	if(!isset($_COOKIE['email']) || !isset($_COOKIE['password']) || !isset($_COOKIE['role']))
	{
		echo "<script type='text/javascript'>
			 	window.location = 'LogIn.php';</script>";//redirect back to log in page    
		exit;
	}

//redirect to ListUsers.php when "HOME" button is clicked
if (isset($_POST['home'])) 
{
    //First check to see which "Home" the user is going to
    if($role == 0 || $role == 1){
        echo "<script type='text/javascript'>
		  window.location = 'AdminTools.php';</script>";
	   exit;
    }
    else if($role == 2){
        echo "<script type='text/javascript'>
		  window.location = 'UserTools.php';</script>";
	   exit;
    }
	
}

//remove cookies and redirect to login.php when "LOGOUT" button is clicked
if (isset($_POST['logout'])) 
{
	unset($_COOKIE['role']);
	unset($_COOKIE['email']);
	unset($_COOKIE['password']);
	unset($_COOKIE['showtitle']);

	setcookie('role', '', time() - 3600);		
	setcookie('email', '', time() - 3600);
	setcookie('password', '', time() - 3600);
	setcookie('showtitle', '', time() - 3600);
	setcookie('showID', '', time() - 3600);		
	
	echo "<script type='text/javascript'>
		  alert('Goodbye!');".
		 "window.location = 'LogIn.php';</script>";//redirect to login page
	exit;	
}
//Code for submitting an audition
if(isset($_POST['save']))
{
	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);
	
	if ($db_found)
	{	
		$SQL = "SELECT * FROM Personnel WHERE Contact_Email = '$email' AND password = '$password'";
		$result = mysql_query($SQL);
		$db_field = mysql_fetch_array($result);
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$personnelID = $db_field['idPersonnel'];
			
			$SQL = "SELECT * FROM Audition WHERE Personnel_idPersonnel = '$personnelID'";
			$result = mysql_query($SQL);
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0)
			{
				echo "<script type='text/javascript'>
		 		 		alert('You have already auditioned for this show!');".
		 				"window.location = 'ListShows.php';</script>";
			}
			else
			{
				$SQL = "INSERT INTO Audition (Personnel_idPersonnel, Shows_idShows) VALUES ('$personnelID', '$showID')";
				$result = mysql_query($SQL);
			}
		}
		else
		{
			echo "<script type='text/javascript'>
				 alert('An error has occured.');".
				 "window.location = 'Audition.php';</script>";//redirect back to Create Show   
			exit;//exit, so that the following code is not executed
		}
				
		echo "<script type='text/javascript'>
			  window.location='ListShows.php';</script>";		
		exit;	
    }
	else//if DB was not found
	{
		echo '<script type="text/javascript"> 
			  alert("Database is not found");
			  </script>';	
		exit;
	}
	mysql_close($db_handle);
}
?>
</head>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (Audition.psd) -->
<form name="form1" method="post" action="Audition.php">
<table width="1400" height="1141" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
	<tr>
		<td colspan="6">
			<img src="Assets/Audition_01.gif" width="1400" height="71" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="3">
			<img src="Assets/Audition_02.gif" width="1211" height="135" alt=""></td>
		<td colspan="2">
			<input type="image" name="home" value="home" src="Assets/Audition_03.gif" id="home"></td>
		<td rowspan="3">
			<img src="Assets/Audition_04.gif" width="82" height="135" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="image" name="logout" value="logout" src="Assets/Audition_05.gif" id"logout"></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/Audition_06.gif" width="107" height="68" alt=""></td>
	</tr>
	<tr>
		<td colspan="6">
			<img src="Assets/Audition_07.gif" width="1400" height="57" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="Assets/Audition_08.gif" width="116" height="877" alt=""></td>
		<td width="1163" height="712" colspan="3" background="Assets/Audition_09.gif">&nbsp;
        <!--
        CALENDAR GOES HE'A 
        OR CALENDAR CAN GO HERE
        OR HERE!
        -->
        </td>
		<td colspan="2" rowspan="4">
			<img src="Assets/Audition_10.gif" width="121" height="877" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="Assets/Audition_11.gif" width="1163" height="31" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="Assets/Audition_12.gif" width="1047" height="134" alt=""></td>
		<td colspan="2">
			<input type="image" name="save" value="home" src="Assets/Audition_13.gif" id="save"></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="Assets/Audition_14.gif" width="116" height="97" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="Assets/spacer.gif" width="116" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="1047" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="48" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="68" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="39" height="1" alt=""></td>
		<td>
			<img src="Assets/spacer.gif" width="82" height="1" alt=""></td>
	</tr>
</table>
</form>
<!-- End Save for Web Slices -->
</body>
</html>