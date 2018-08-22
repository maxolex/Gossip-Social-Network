
<?php $tittle = "Changement de mot de passe"; ?>
<?php require("includes/init.php"); ?>
<?php include("includes/constants.php");?>
<?php include("partials/_header.php");?>

<div class="main-content">
        <div class="container">
            <div class="row">
                <div class="offset3 span6">
                    <?php include('partials/_errors.php'); ?>
                </div>
                <div class="offset3 span6">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title">Changer de mot de passe</h3>
                        </div>
                        <div class="panel-body">
                            <form data-parsley-validate method="post" autocomplete="off">
                                <div class="container">
                                    <div class="row">
                                        <div class="span12">
                                            <div class="form-group">
                                                <label for="current_password">Mot de passe actuel<span class="text-danger">*</span></label>
                                                <input class="span5" type="password" name="current_password" id="current_password" required="required"/>
                                            </div>
                                            <div class="form-group">
                                                    <label for="new_password">Nouveau mot de passe<span class="text-danger">*</span></label>
                                                    <input class="span5" type="password" name="new_password" id="new_password" required="required"  data-parsley-minlength="6" data-parsley-trigger="change"/>
                                            </div>
                                            <div class="form-group">
                                                    <label for="new_password_confirmation">Confirmer nouveau mot de passe<span class="text-danger">*</span></label>
                                                    <input class="span5" type="password" name="new_password_confirmation" id="new_password_confirmation" required="required" data-parsley-equalto="#new_password" data-parsley-trigger="change"/>
                                            </div>
                                        <input type="submit" class="btn btn-primary" value="Valider" name="change_password">
                                        </div>
                                        
                                    </div>
                                </div>
                            </form>
                            
                        </div>

                    </div>

                </div>
        </div>
    </div>

</div>

    

<?php include("partials/_footer.php");?>