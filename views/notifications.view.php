<?php $title = "Notifications"; ?>
<?php include("includes/constants.php");?>
<?php include('partials/_header.php'); ?>
	
<div id="main-content">
	<div class="container">
		<h1 class="lead">Vos notifications</h1>
		<ul class="list-group">
		<?php foreach($notifications as $notification): ?>
			<li class="list-group-item <?php echo $notification->seen == '0' ? 'not_seen' : '' ?>">
				<?php require("partials/notifications/{$notification->name}.php"); ?>
			</li>
		<?php endforeach; ?>
		</ul>
		<div class="pagination"><?php echo $pagination ?></div>
	</div>
</div>

<script src="scripts/jquery.min.js" type="text/javascript"></script> 
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/default.js" type="text/javascript"></script>

    <script src="libraries/jquery.timeago.js"></script>
    <script src="libraries/jquery.timeago.fr.js"></script>
    <script src="libraries/jquery.livequery.min.js"></script>

    <script src="libraries/parsley/parsley.min.js"></script>
    <script src="libraries/parsley/i18n/fr.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {

      $("span.timeago").livequery(function(){

        $(this).timeago();

      });
    });
    window.parsleyValidator.setLocale('fr');
    </script>