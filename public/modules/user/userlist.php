<?php

session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$UM = new UserManager();
$users = $UM->getAllUsers();

if ( isset($users) ) {
    ?>
    <br/><br/>Below is the list of Developers registered in community portal <br/><br/>
    <table class="table table-striped table-bordered" >
            <tr class="text-center">
              <th><b>Id</b></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
               <th><b>Operation</b></th>
            </tr>
    <?php
    foreach ( $users as $user ) {
        if( $user != null ) {
            ?>
            <tr class="text-center">
              <td><?=$user->id?></td>
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->email?></td>
      			   <td>
                 <?php
                 if ( $user->role == 'user' ) {
                  ?>
                  <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                 <a class="nav-link text-danger" href='deleteuser.php?id=<?php echo $user->id ?>'>Delete</a>
                 </li>
                 <li class="nav-item">
                 <a class="nav-link" href='editprofile.php?id=<?php echo $user->id ?>'>Edit</a>
               </li>
             </ul>
                 <?php
                 }
                  ?>
      			   </td>
            </tr>
            <?php
      }
    }
    ?>
    </table><br/><br/>
    <?php
}
?>

<link rel="stylesheet" href="..\..\css/bootstrap/css/bootstrap.min.css">
<form name="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline">
  <!-- <label for="firstName" >Firstname:</label>
  <input type="text" class="form-control" name="firstName" >
  <label for="lastName" >Lastname:</label>
  <input type="text" class="form-control" name="lastName" > -->
  <label for="email" >Email:</label>
  <input type="email" class="form-control" name="email" required>
  <input type="submit" class="btn btn-outline-dark" name="search" value="Search">
  <input type="reset" class="btn btn-outline-dark" name="clear" value="Clear">
</form>

<?php

if ( isset($_POST['search']) ) {

  // $firstname = $_POST['firstName'];
  // $lastname = $_POST['lastName'];
  $email = $_POST['email'];

  $getusers = $UM->getUserFnameLnameEmail($email);
if ( ($email != '')  ){
  if ( isset($getusers) ){
    ?>
      <br/><br/>Below is the list of search results<br/><br/>
      <table class="table table-striped table-bordered" >
        <tr class="text-center">
                  <th><b>Id</b></th>
                 <th><b>First Name</b></th>
                 <th><b>Last Name</b></th>
                 <th><b>Email</b></th>
                 <th><b>Operation</b></th>
              </tr>
        <?php
        foreach ( $getusers as $user ) {
            if ( $user != null ) {
                ?>
                <tr class="text-center">
                  <td><?=$user->id?></td>
                   <td><?=$user->firstName?></td>
                   <td><?=$user->lastName?></td>
                   <td><?=$user->email?></td>
                   <td>
                     <ul class="nav nav-pills justify-content-center">
                     <li class="nav-item">
                  <a class="nav-link text-danger" href='deleteuser.php?id=<?php echo $user->id ?>'>Delete</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href='editprofile.php?id=<?php echo $user->id ?>'>Edit</a>
                </li>
              </ul>
            </td>
                </tr>
                <?php
            }
        }
        ?>
        </table><br/><br/>
        <?php
    }
  }
 }

include '../../includes/footer.php';
?>
