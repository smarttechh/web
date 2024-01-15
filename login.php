<?php
session_start();
 
$username = $_POST ['username'] ;
$password = $_POST['password'];
 
 
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "smarttech";
// Create connection
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
 // mysqli_select_db($conn ,'account')


 
$sql = " SELECT * FROM register WHERE username = '$username' and password = '$password' ";



$result = mysqli_query($conn , $sql);
$num = mysqli_num_rows($result);


if($num==1){
	 $_SESSION['current_user'] = $username;
	 
	header("location:home.php");
}else{?>
	<script type="text/javascript">alert('username and password not match');</script>
	<?php
	// header('location:login_form.php');
	 } 
 
?>