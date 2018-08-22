<?php if (isset($_SESSION['notification']['message'])): ?>

<div class="container">

<div class="alert alert-<?php echo $_SESSION['notification']['type'];?>">

<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>

<h4><?php echo $_SESSION['notification']['message']; ?></h4>

</div>

</div>

<?php $_SESSION['notification'] = "";?>


<?php endif; ?>
