    <?php $tittle = "Partage de Codes Sources";?>
    <?php require("includes/init.php"); ?>
    <?php include("includes/constants.php");?>
    <?php include("partials/_header.php");?>
    <div class="main-content">
        <div id="main-content-share-code">
        	<form data-parsley-validate method="post" action="" autocomplete="off">

        		<textarea name="code"  id="code" placeholder="Entrer votre Code ici..." required="required"><?php echo $code; ?></textarea>
        		<div class="btn-group navig">

        			<input  type="reset" value="Tout Effacer!" class="btn btn-danger">
        			<input type="submit" name="save" class="btn btn-success" value="Enregistrer!">


        		</div>
        	</form>
              
        </div>

    </div>
    
    <?php include("partials/_footer.php");?>

    <script src="assets/js/tabby.min.js" type="text/javascript"></script>
    <script>
        $("#code").tabby();
        $("#code").height($(window).height() - 50);
    </script>

