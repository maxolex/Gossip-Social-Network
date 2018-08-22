<?php $tittle = "Photo de profil"; ?>
<?php require("includes/init.php"); ?>
<?php include("includes/constants.php");?>
<?php include("partials/_header.php");?>
<div style="margin-top:50px; margin-bottom:50px;" class="main-content">
<div class="container">
	<div class="row">
		<h1 style="text-align:center">Changer la photo de profil</h1>
		<?php foreach ($users as $user): ?>
		<div class="span6">
			<div>
				<img  class="photo" src="<?php echo get_avatar($user->email); ?>" alt="Image de profil de <?php echo $user->pseudo; ?>">
			</div>

		</div>

		<div class="span6">
				<form clas="well" action="show_picture.php" method="post" enctype="multipart/form-data">
					<div class="control-group">
					    <div class="controls">
					        <input  type="file" id="img" name="img">
					    </div>
					</div>
					    <div class="control-group">
					        <div class="controls">
					            <button type="submit" class="btn btn-success" name="img">Changer la photo de profil</button>
					        </div>
					    </div> 
				</form>
		</div>


	</div>
	<?php endforeach; ?>

</div>
</div>

<?php include("partials/_footer.php"); ?>