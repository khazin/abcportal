<?php
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
include 'includes/header.php';

$formerror="";
$formsuccess="";
$email="";
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$validate = new Validation();

if ( isset($_POST["submitted"]) ) {
    $email = $_POST["email"];
  	$UM    = new UserManager();
  	$existuser = $UM->getUserByEmail($email);
	if( isset($existuser) ) {
			//generate new password
			$newpassword=$UM->randomPassword(8, 1, "lower_case,upper_case,numbers");
			//update database with new password
			$UM->updatePassword($email, md5($newpassword[0]));
			//$formerror="Valid email user. password: ".$newpassword[0];
			//coding for sending email

      include '../phpmailer/test.php';
			// do work here

			$formsuccess = "New password have been sent to ".$email;
			//header("Location:home.php");
	} else {
			$formerror = "Email user does not exist";
	}
}

?>

<link rel="stylesheet" href=".\css/bootstrap/css/bootstrap.min.css">
<div class="row d-flex justify-content-center align-items-center bg-light py-3" style="height: 550px">
  <div class="col-12">
    <h3 class="text-center mb-5">Reset Password</h3>
    <h5 class="text-center">To reset password,please provide <br> your email for verification</h5>
  </div>
  <div class="col-auto">
    <form name="myForm" method="post">
      <p class="text-danger text-center">
        <?=$formerror?>
      </p>
      <p class="text-success text-center">
        <?=$formsuccess?>
      </p>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email"
        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
      </div>

      <input type="submit" class="btn col-12 mt-4 btn-dark" name="submitted" value="Submit">

    </form>
  </div>
</div>

<?php
include 'includes/footer.php';
?>
