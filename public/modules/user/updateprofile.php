<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$newpassword="";
$newpasswordc ="";
$pwdtitle = "Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters";
$nametitle = "Please fill in alphabets only, min 2 letters and max 20 letters";

$UM = new UserManager();
$existuser = $UM->getUserByEmail($_SESSION["email"]);
$password  = "PWD".$existuser->password;

if ( !isset($_POST["submitted"]) ) {
  $firstName = $existuser->firstName;
  $lastName  = $existuser->lastName;
  $email     = $existuser->email;
} else {
  $firstName = $_POST["firstName"];
  $lastName  = $_POST["lastName"];
  $email     = $_POST["email"];

  if ( trim($_POST["password"],"PWD") == $existuser->password ) {
  $newpassword  = trim($_POST["password"],"PWD");
  $newpasswordc = trim($_POST["cpassword"],"PWD");

  } else {
  $newpassword  = md5($_POST["password"]);
  $newpasswordc = md5($_POST["cpassword"]);
  }

  if (   $firstName != ''
      && $lastName != ''
      && $email != ''
      && $newpassword != ''
      && $newpasswordc != ''
  ) {
    if ( $newpassword == $newpasswordc ) {
       $update = true;
       $UM = new UserManager();
       if ( $email != $_SESSION["email"] ) {
           $existuser = $UM->getUserByEmail($email);
           if( is_null($existuser) == false ) {
               $formerror = "User Email already in use, unable to update email";
               $update    = false;
           }
       }
       if ( $update ) {
           $existuser = $UM->getUserByEmail($_SESSION["email"]);
           $existuser->firstName = $firstName;
           $existuser->lastName = $lastName;
           $existuser->email = $email;
           $existuser->password = $newpassword;
           $UM->saveUser($existuser);
           $_SESSION["email"] = $email;
           header("Location:../../home.php");
       }
     } else {
       $formerror = "Password does not match";
     }
  } else {
      $formerror = "Please provide required values";
  }
}
?>
<link rel="stylesheet" href="..\..\css/bootstrap/css/bootstrap.min.css">
<div class="row d-flex justify-content-center p-3 bg-light">

  <div class="col-12 mb-5">
    <h3 class="text-center">Update Profile</h3>
  </div>

  <div class="col-auto">
    <form name="myForm" method="post">
      <div class="text-danger text-center">
        <?=$formerror?>
      </div>

      <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" name="firstName" value="<?=$firstName?>"
        pattern="^[A-Za-z]{2,10}$" title="<?=$nametitle?>" required>
      </div>

      <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control" name="lastName" value="<?=$lastName?>"
        pattern="^[A-Za-z]{2,20}$" title="<?=$nametitle?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" value="<?=$email?>"
        pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" value="<?=$password ?>"
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="<?=$pwdtitle?>" required>
      </div>
      <div class="form-group">
        <label for="cpassword">Confirm Password</label>
        <td><input type="password" class="form-control" name="cpassword" value="<?=$password?>"
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="<?=$pwdtitle?>" required>
      </div>

      <input type="submit" class="btn col-12 mb-1 mt-5 btn-dark" name="submitted" value="Submit">
      <input type="reset" class="btn col-12 btn-dark" name="reset" value="Reset">

    </form>
  </div>
</div>

<?php
include '../../includes/footer.php';
?>
