<?php
require_once '../../includes/autoload.php';
include '../../includes/header.php';
use classes\util\DBUtil;
use classes\business\UserManager;
use classes\entity\User;

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$passwordc="";
$pwdtitle = "Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters";
$nametitle = "Please fill in alphabets only, min 2 letters and max 20 letters";

if ( isset($_REQUEST["submitted"]) ) {
    $firstName = $_REQUEST["firstName"];
    $lastName  = $_REQUEST["lastName"];
    $email     = $_REQUEST["email"];
    $password  = $_REQUEST["password"];
    $passwordc = $_REQUEST["cpassword"];

    if (    $firstName != ''
         && $lastName != ''
         && $email != ''
         && $password != ''
         && $passwordc != ''
    ) {
        if ( $password == $passwordc ) {
        $UM   = new UserManager();
        $user = new User();
        $user->firstName = $firstName;
        $user->lastName  = $lastName;
        $user->email     = $email;
        $user->password  = md5($password);
        $user->role      = "user";
        $existuser = $UM->getUserByEmail($email);

        if( !isset($existuser) ) {
            // Save the Data to Database
            $UM->saveUser($user);
            #header("Location:registerthankyou.php");
			echo "<meta http-equiv='Refresh' content='1; url=./registerthankyou.php?firstname=".$firstName."&lastname=".$lastName."'>";
        } else {
            $formerror = "User Already Exist";
        }
      } else {
        $formerror = "Password does not match";
      }
    } else {
        $formerror = "Please fill in the fields";
    }
}
?>

<link rel="stylesheet" href="..\..\css/bootstrap/css/bootstrap.min.css">
<div class="row d-flex justify-content-center p-3 bg-light">

  <div class="col-12 mb-5">
    <h3 class="text-center">Register Account</h3>
  </div>

  <div class="col-auto">
    <form name="myForm" method="post" class="">

      <div class="text-danger text-center">
        <?=$formerror?>
      </div>

      <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" name="firstName" value="<?=$firstName?>"
        pattern="^[A-Za-z]{2,20}$" title="<?=$nametitle?>" required></td>
      </div>
      <div class="form-group">
        <label for="lastName">Last Name</label>
        <td><input type="text" class="form-control" name="lastName" value="<?=$lastName?>"
          pattern="^[A-Za-z]{2,20}$" title="<?=$nametitle?>" required></td>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?=$email?>"
        pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <td><input type="password" class="form-control" name="password"
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="<?=$pwdtitle?>" required>
      </div>
      <div class="form-group">
        <label for="cpassword">Confirm Password</label>
        <input type="password" class="form-control" name="cpassword"
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="<?=$pwdtitle?>" required>
      </div>
      <input type="submit" class="btn col-12 mb-1 mt-5 btn-dark" name="submitted" value="Register">
      <input type="reset" class="btn col-12 btn-dark" name="reset" value="Clear">
    </form>
  </div>
</div>

<?php
include '../../includes/footer.php';
?>
