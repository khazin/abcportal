<?php
session_start();

use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
include 'includes/header.php';
?>
<link rel="stylesheet" href=".\css/bootstrap/css/bootstrap.min.css">

<div class="row d-flex p-3 align-items-center col-lg-12 bg-light" style="height:620px; ">
  <div class="col-12 text-center">
    <div class="col-12">
    <h3 >CONTACT INFORMATION</h3>
    <table class="table">
      <tr>
        <th>Customer Hotline</th>
        <td>+65 1800 222 6868</td>
      </tr>
      <tr>
        <th>Operating hour</th>
        <td>Monday to Saturday, 0800 - 1800 <br> Sunday & Public Holiday, 0800 - 1400.</td>
      </tr>
    </table>
     </div>
<div >
    <iframe class="col-12" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7600334737967!2d103.88985331447665!3d1.3196913620398996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da19149fe4a925%3A0x82606eb494fd093c!2sLithan+Academy!5e0!3m2!1sen!2ssg!4v1514739525393" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
  </div>
</div>
<br>

<?php
include 'includes/footer.php';
?>
