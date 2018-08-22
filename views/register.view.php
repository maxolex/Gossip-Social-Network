    <?php $tittle = "Inscription";?>
    <?php include("includes/constants.php");?>
    <?php include("partials/_header.php");?>
    <div class="main-content">
        <div class="container">
              <h1 class="lead"><?php echo $long_text['register_title'][get_current_locale()]; ?></h1>

                    <?php include("partials/_errors.php"); ?>

              <form data-parsley-validate class="well span6" method="post" autocomplete="off">

                <div class="form-group">
                  <label class="control-label" for="name">Nom:</label>
                  <input value="<?php echo get_input('name'); ?>" type="text" class="form-control" id="name" name="name" required="required" data-parsley-trigger="change"/>
                </div>

                <div class="form-group">
                  <label class="control-label" for="pseudo">Pseudo:</label>
                  <input value="<?php echo get_input('pseudo'); ?>" type="text" class="form-control" id="pseudo" name="pseudo" required="required" data-parsley-minlength="3" data-parsley-trigger="change"/>
                </div>

                <div class="form-group">
                  <label class="control-label" for="email">Adresse Email:</label>
                  <input value="<?php echo get_input('email'); ?>" type="email" class="form-control" id="email" name="email" required="required" data-parsley-trigger="change"/>
                </div>

                <div class="form-group">
                  <label class="control-label" for="password">Mot de passe:</label>
                  <input type="password" class="form-control" id="password" name="password" required="required" data-parsley-minlength="6" data data-parsley-trigger="change"/>
                </div>

                <div class="form-group">
                  <label class="control-label" for="password_confirm">Confirmer votre Mot de Passe:</label>
                  <input type="password" class="form-control" id="password_confirm" name="password_confirm" required="required" data-parsley-equalto="#password" data-parsley-trigger="change"/>
                </div>

                <input type="submit" class="btn btn-primary" value="<?php echo $long_text['register'][get_current_locale()]; ?>" name="register"/>




              </form>
        </div> <!-- /container -->

    </div>
    
    <?php include("partials/_footer.php");?>

