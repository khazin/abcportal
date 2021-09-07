<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
include 'includes/header.php';

$formerror="";
$email="";
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$pwdtitle = "Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters";

$validate = new Validation();

if ( isset($_POST["submitted"]) ) {
    $email    = $_POST["email"];
    $password = $_POST["password"];

    $response = $_POST["g-recaptcha-response"];
  	$url  = 'https://www.google.com/recaptcha/api/siteverify';
  	$data = array(
		'secret' => '6LewQnAUAAAAAOypExqpF_pcKCsZXcgqaU3_wDn7',
		'response' => $_POST["g-recaptcha-response"]
  	);
  	$options = array(
  		'http' => array (
  			'method'  => 'POST',
  			'content' => http_build_query($data)
  		)
  	);
  	$context  = stream_context_create($options);
  	$verify   = file_get_contents($url, false, $context);
  	$captcha_success = json_decode($verify);
  	if ( $captcha_success->success == false ) {
  		$formerror = "You are a bot! Go away!";
  	} else if ( $captcha_success->success == true ) {
		// echo "<p>You are not not a bot!</p>";
    $UM = new UserManager();

		$existuser = $UM->getUserByEmailPassword($email, md5($password));
		if( isset($existuser) ) {

			$_SESSION['email'] = $email;
      $_SESSION['id']    = $existuser->id;
			$_SESSION['role']  = $existuser->role;
			echo '<meta http-equiv="Refresh" content="5; url=home.php">';
		} else {
			$formerror = "Invalid User Name or Password";
		}
	}
	// if($validate->check_password($password, $error_passwd))
	{

	}
}

?>

<link rel="stylesheet" href=".\css/bootstrap/css/bootstrap.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="row d-flex justify-content-center align-items-center p-3 bg-light" style="height: 550px">
  <div class="col-12 mb-4">
    <h3 class="text-center">Log In</h3>
  </div>

  <div class="col-auto">
    <form name="myForm" method="post" class="">
      <p class="text-danger text-center"><?=$formerror?></p>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?=$email?>"
        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password"
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="<?=$pwdtitle?>" required>
      </div>

      <div class="g-recaptcha" data-sitekey="6LewQnAUAAAAAAv--zCR0Dt7hy7t7y4J9phWT2dQ"></div>
      <input type="submit" class="btn col-12 mt-4 btn-dark" name="submitted" value="Login">
      <input type="reset" class="btn col-12 mt-4 btn-dark" name="reset" value="Clear">

      <a class="btn navbar-nav ml-auto" href="./forgetpassword.php">Forget Password</a>

    </form>
  </div>
</div>

<?php
include 'includes/footer.php';
?>
