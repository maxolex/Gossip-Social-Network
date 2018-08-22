
    <?php $tittle = "Edition de Profil"; ?>
    <?php include("includes/constants.php");?>
    <?php require("includes/init.php"); ?>
    <?php include("partials/_header.php");?>
    <div class="main-content">
        <div class="container">
            <div class="row">

                    <?php if (!empty($_GET['pseudo']) && $_GET['pseudo'] === get_session('pseudo')) : ?>
                <div class="span6">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title">Complèter mon profil</h3>

                        </div>
                        <div class="panel-body">
                            <?php include('partials/_errors.php'); ?>
                            <form data-parsley-validate method="post" autocomplete="off">
                                <div class="container">
                                    <div class="row">
                                        
                                        <div class="span3">
                                                <label for="first_name">Prénoms<span class="text-danger">*</span></label>
                                                <input class="input-medium" type="text" name="first_name" id="first_name" placeholder="John" value="<?php echo get_input('first_name') ? get_input('first_name') : e($user->first_name); ?>" required="required"/>
                                        </div>
                                         <div class="span3">
                                                <label for="city">Ville<span class="text-danger">*</span></label>
                                                <input class="input-medium" type="text" name="city" id="city" value="<?php echo get_input('city') ? get_input('city') : e($user->city); ?>" required="required"/>
                                        </div>

                                    </div>
                                    <div class="row">
                                        
                                        <div class="span3">
                                                <label for="country">Pays<span class="text-danger">*</span></label>
                                                <input class="input-medium" type="text" name="country" id="country" value="<?php echo get_input('country') ? get_input('country') : e($user->country); ?>" required="required"/>
                                        </div>
                                         <div class="span3">
                                                <label for="sex">Sexe<span class="text-danger">*</span></label>
                                                <select required="required" name="sex" id="sex" class="input-medium">
                                                <option value="H" <?php echo $user->sex  == "H" ? "selected" : ""; ?>>
                                                    Homme
                                                </option>
                                                <option value="F" <?php echo $user->sex  == "F" ? "selected" : ""; ?>>
                                                    Femme
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="span3">
                                                <label for="facebook">Facebook<span class="text-danger">*</span></label>
                                                <input class="input-medium" type="text" name="facebook" id="facebook" value="<?php echo get_input('facebook') ? get_input('facebook') : e($user->facebook); ?>" required="required"/>
                                        </div>
                                         <div class="span3">
                                                <label for="twitter">Twitter</label>
                                                <input class="input-medium" type="text" name="twitter" id="twitter" value="<?php echo get_input('twitter') ? get_input('twitter') : e($user->twitter); ?>"/>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="span6">

                                            <label for="available_for_hiring">
                                                <input type="checkbox" name="available_for_hiring" id="available_for_hiring" <?php echo $user->available_for_hiring ? "checked" : ""; ?>>
                                                Disponible pour emploi?

                                            </label><br>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="span6">

                                            <label for="bio">Biographie<span class="text-danger">*</span></label>
                                            <textarea required="required" class="input-xlarge" type="text" name="bio" id="bio" cols="30" rows="10" placeholder="Je suis un amoureux de la programmation..."><?php echo get_input('bio') ? get_input('bio') : e($user->bio); ?></textarea>
                                        </div>

                                    </div>
                                        <input type="submit" class="btn btn-primary" value="Valider" name="update">
                                </div>
                            </form>

                            

                        </div>

                    </div>

                </div>
                <div class="span6">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title">Changer d'avatar</h3>

                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="avatar">Changer mon avatar</label>
                                <input type="file" name="avatar" id="avatar" />
                            </div>

                        </div>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include("partials/_footer.php");?>

    <script type="text/javascript">
        <?php $timestamp = time(); ?>
        $(function() {
            $('#avatar').uploadify({
                'fileObjName': 'avatar',
                'fileTypeDesc' : 'Images Files',
                'fileTypeExts' : '*.gif; *.jpg; *.jpeg; *.png',
                'buttonText' : 'Parcourir',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp; ?>',
                    'token'     : '<?php echo md5('unique_salt' . $timestamp); ?>',
                    'user_id'   : "<?php echo get_session('user_id'); ?>"
                },
                'swf'      : 'libraries/uploadify/uploadify.swf',
                'uploader' : 'libraries/uploadify/uploadify.php'
            });
        });
    </script>