<!-- Navigation Bar -->
<?php
   if ( isset($_SESSION["email"]) ) {
?>

<link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.min.css">
  <div class="container">
    <div class="row">
      <div class="col">
        <nav class="navbar navbar-expand-sm navbar-light py-1">
          <a class="navbar-brand" href="#">
  <img src="../images/logo.png"  style="width:70px;">
  </a>
  <ul class="navbar-nav ml-auto mt-5 ">
    <li class="nav-item">
  <a href="/students/sg0318a11/abcportal/public/home.php" class="nav-link text-dark">Home</a>
</li>
<li class="nav-item">
  <a href="/students/sg0318a11/abcportal/public/aboutus.php" class="nav-link text-dark">About Us</a>
</li>
<li class="nav-item">
  <a href="/students/sg0318a11/abcportal/public/modules/user/updateprofile.php" class="nav-link text-dark">Update Profile</a>
</li>
  <?php
      if ( $_SESSION["role"] == "admin" ) {
        ?>
        <li class="nav-item">
      <a href="/students/sg0318a11/abcportal/public/modules/user/userlist.php"  class="nav-link text-dark">View Users</a>
    </li>
      <?php
      }
  ?>
  <li class="nav-item">
  <a href="/students/sg0318a11/abcportal/public/contactus.php"  class="nav-link text-dark">Contact</a>
</li>
<li class="nav-item">
  <a href="/students/sg0318a11/abcportal/public/logout.php"  class="nav-link text-dark">Logout</a>
</li>
</ul>
</nav>
</div>
</div>


<?php
   } else {
?>
<link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.min.css">
<div class="container">
  <div class="row">
    <div class="col">
      <nav class="navbar navbar-expand-sm navbar-light py-1">
        <a class="navbar-brand" href="#">
          <img src="../images/logo.png"  style="width:70px;">
          </a>
          <ul class="navbar-nav ml-auto mt-5 ">
            <li class="nav-item">
            <a href="/students/sg0318a11/abcportal/public/modules/user/register.php" class="nav-link text-dark">Register</a>
          </li>
          <li class="nav-item">
            <a href="/students/sg0318a11/abcportal/public/login.php" class="nav-link text-dark">Login</a>
          </li>
          <li class="nav-item">
            <a href="/students/sg0318a11/abcportal/public/aboutus.php" class="nav-link text-dark">About Us</a>
          </li>
          <li class="nav-item">
            <a href="/students/sg0318a11/abcportal/public/contactus.php" class="nav-link text-dark">Contact</a>
          </li>
        </ul>
      </nav>
  </div>
</div>

<?php
   }
?>
