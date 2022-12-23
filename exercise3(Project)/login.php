<?php
session_start(); 
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
$exists=false;
$doesnotexist=false;
$file='logininfo.txt';
if($_SESSION['user']!=""&&$_SESSION['pass']!=""){
$URL="Form.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
if(isset($_POST['loginbtn'])){
if(file_exists('logininformation.json'))
{
	$filename = 'logininformation.json';
	$data = file_get_contents($filename); //data read from json file
	//print_r($data);
	$users = json_decode($data);  //decode a data

	//print_r($users); //array format data printing
	 $message = "<h3 class='text-success'>JSON file data</h3>";
}else{
	 $message = "<h3 class='text-danger'>JSON file Not found</h3>";
}
foreach($users as $user){
if($_POST['username']==$user->username&&$_POST['password']==$user->password){
$exists=true;
}
}
if($exists==true){
$_SESSION['user']=$_POST['username'];
$_SESSION['pass']=$_POST['password'];
$URL="Form.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}else{
$doesnotexist=true;
}

}elseif(isset($_POST['registerbtn'])){
$URL="createaccount.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
include 'header.php';
include 'navigation.php';
if($doesnotexist){
echo '<h3 class"text-danger">Your Username/Password is incorrect.<br>Please Try Again!</h3>';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Login</title>
</head>
<body>
<h3 class="word-wrap text-primary">In order to give away your pet you need to have an account.<br><br> Please Log In or Click the Register button to Create an account.</h3><br>
<form method="POST" action="login.php">
<div class="form-floating">
  <input type="text" class="form-control" name="username" id="floatingUsername" style="width:75%;" placeholder="Password">
  <label for="floatingUsername">Username</label>
</div><br>
<div class="form-floating">
  <input type="password" class="form-control" name="password" id="floatingPassword"  style="width:75%;"  placeholder="Password">
  <label for="floatingPassword">Password</label>
</div><br>
<input type="submit" class="btn btn-primary" value="Log In" name="loginbtn">&nbsp;&nbsp;
<input type="submit"  class="btn btn-primary" value="Register" name="registerbtn">
</form>
<?php
include 'footer.php'?>
</body>
</html>