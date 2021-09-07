<?php
if ( !isset($_SESSION['email']) ) {
    header("Location:/students/sg0318a11/abcportal/public/login.php");
}

if ( $_SERVER['PHP_SELF'] ==  "/students/sg0318a11/abcportal/public/modules/user/userlist.php" ) {
    if ($_SESSION['role'] == 'user')
    {
      header("Location:  /students/sg0318a11/abcportal/public/login.php");
    }
}
?>
