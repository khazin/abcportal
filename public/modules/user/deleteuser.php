<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
?>

<?php

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$deleteflag = false;

if ( isset($_POST["submitted"]) ) {
  if ( isset($_GET["id"]) ) {
       $UM = new UserManager();
       $existuser = $UM->deleteAccount($_GET["id"]);
       $formerror = "User deleted successfully.";
    	 $deleteflag = true;
	}
} else if ( isset($_POST["cancelled"]) ) {
	header("Location:../../home.php");
} else {
	if ( isset($_GET["id"]) ) {
	  $UM = new UserManager();
	  $existuser = $UM->getUserById($_GET["id"]);
	  $firstName = $existuser->firstName;
	  $lastName  = $existuser->lastName;
	  $email     = $existuser->email;
	  $password  = $existuser->password;
	}
}
?>
<link rel="stylesheet" href="..\..\css/bootstrap/css/bootstrap.min.css">
<div class="row d-flex justify-content-center align-items-center p-3 bg-light" style="height: 420px">
  <div class="col-12 mb-4">
    <h3 class="text-center">Delete User</h3>
    <h3  class="text-center">Are you sure that you want to delete the following record?</h3>
  </div>

  <div class="col-4">
<form name="deleteUser" method="post" class="">
<div class="text-center text-success"><?=$formerror?></div>
<?php
if ( !$deleteflag )
{
?>

   <div class="form-group">
     <label for="email">Email</label>
    <input type="email" class="form-control" name="email" value="<?=$email?>" readonly>
</div>
    <input type="submit" class="btn col-12 mb-1 mt-5" name="submitted" value="Delete" class="pure-button pure-button-primary">
    <input type="submit" class="btn col-12" name="cancelled" value="Cancel" class="pure-button pure-button-primary">

<?php
}
?>
</form>
</div>
</div>

<?php
include '../../includes/footer.php';
?>
