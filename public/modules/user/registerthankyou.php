<?php
require_once '../../includes/autoload.php';
include '../../includes/header.php'
?>
<div class="row d-flex justify-content-center p-3 align-items-center bg-light" style="height:420px">
  <div class="col-lg-6">
    <h4 class="text-center">Thank you<?php echo ' '. $_GET['firstname'].' '.$_GET['lastname'].' ' ?>
      for joining us. <br>Please proceed to <a href="../../login.php">login</a></h4>
  </div>
</div>

<?php
include '../../includes/footer.php';
?>
