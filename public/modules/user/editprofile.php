<?php
session_start();

require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$UM = new UserManager();

$formerror="";
$firstName="";
$lastName="";
$email="";
$nametitle = "Please fill in alphabets only, min 2 letters and max 20 letters";

if ( !isset($_POST["edit"]) ) {
$id = $_GET['id'];
$existuser = $UM->getUserById($id);
$firstName = $existuser->firstName;
$lastName  = $existuser->lastName;
$email     = $existuser->email;

} else {
  $firstName = $_POST["firstName"];
  $lastName  = $_POST["lastName"];
  $email     = $_POST["email"];
  $id        = $_POST['id'];
  $existuser = $UM->getUserById($id);

  if (   $firstName != ''
      && $lastName != ''
      && $email != ''
  ) {
    $update = true;
    $UM = new UserManager();
    if ( $email != $existuser->email ) {
        $existuser = $UM->getUserByEmail($email);
        if ( is_null($existuser) == false ) {
            $formerror = "User Email already in use, unable to update email";
            $update    = false;
        }
    }
      if ( $update ) {
        $existuser = $UM->getUserById($id);
        $existuser->firstName = $firstName;
        $existuser->lastName  = $lastName;
        $existuser->email     = $email;
        $UM->saveUser($existuser);
        header("Location:../../home.php");
      }
    } else {
        $formerror = "Please provide required values";
    }
}
?>
<link rel="stylesheet" href="..\..\css/bootstrap/css/bootstrap.min.css">
<div class="row d-flex justify-content-center p-3 bg-light">

<div class="col-12 mb-5">
<h3 class="text-center">Edit Profile</h3>
</div>

<div class="col-auto">
<form class="" action="<?php echo $_SERVER['PHP_SELF']," ?id=$id "?>" method="post">
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
    pattern="^[A-Za-z]{2,10}$" title="<?=$nametitle?>" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" value="<?=$email?>"
    pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
  </div>
  <input type="submit" class="btn col-12 mb-1 mt-5 btn-dark" name="edit" value="Save">
  <input type="reset" class="btn col-12 btn-dark" name="reset" value="Reset">
  <input type="hidden" name="id" value="<?=$id?>">

</form>
</div>
</div>

<?php
include '../../includes/footer.php';
?>
