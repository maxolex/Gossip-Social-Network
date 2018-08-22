    <?php $tittle = "Connexion";?>
    <?php include("includes/constants.php");?>
    <?php include("partials/_header.php");?>
    <div class="main-content">
        <div class="container">
              <h1 class="lead"><?php echo $long_text['login'][get_current_locale()]; ?></h1>

                    <?php include("partials/_errors.php"); ?>

              <form data-parsley-validate class="well span6" method="post" autocomplete="off">

                <div class="form-group">
                  <label class="control-label" for="identifiant"><?php echo $long_text['pseudo_or_email'][get_current_locale()]; ?></label>
                  <input value="<?php echo get_input('identifiant'); ?>" type="text" class="form-control" id="identifiant" name="identifiant" data-parsley-trigger="change" required="required"/>
                </div>

                <div class="form-group">
                  <label class="control-label" for="password"><?php echo $long_text['password'][get_current_locale()]; ?></label>
                  <input type="password" class="form-control" id="password" name="password" data-parsley-trigger="change" required="required"/>
                </div>

                <input type="submit" class="btn btn-primary" value="<?php echo $long_text['login'][get_current_locale()]; ?>" name="login"/>




              </form>
        </div> <!-- /container -->

    </div>
    
    <?php include("partials/_footer.php");?>

