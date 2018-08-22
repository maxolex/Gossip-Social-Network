    <?php if (!empty($_GET['pseudo']) && $_GET['pseudo'] == get_session('pseudo')) :?>
        <?php $tittle = get_session('pseudo'); ?>
    <?php endif; ?>
    <?php require("includes/init.php"); ?>
    <?php include("includes/constants.php");?>
    <?php include("partials/_header.php");?>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 style="font-weight:bold;" class="panel-title">Profil de <?php echo e($user->pseudo); ?> (<?php echo friends_count(); ?> ami<?php echo friends_count() == 1 ? '' : 's'; ?>)</h3>

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="span12">
                                  <div style="max-width: 20%;" class="span5">

                                    <a title="cliquer pour changer la photo de profil" href="show_picture.php"><img src="<?php echo get_avatar($user->email); ?>" alt="Image de profil de <?php echo $user->pseudo; ?>"/></a> 

                                  </div>
                                  <div class="span7">
                                      <?php if (!empty($_GET['pseudo']) && $_GET['pseudo'] !== get_session('pseudo')): ?>
                                      
                                          <?php include('partials/_relation_links.php'); ?>

                                      <?php endif; ?>
                                    
                                  </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="span6">
                                    <div class="row">
                                <div class="span3">

                                    <strong><?php echo e($user->pseudo); ?></strong><br>
                                    <a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email) ?></a><br>
                                    <?php 
                                        if($user->city && $user->country){
                                    ?>
                                        <i class="icon-map-marker"></i>&nbsp;<?php echo e($user->city).' - '. e($user->country); ?><br>
                                    <?php
                                   }else{

                                        echo "";
                                   } 
                                   ?>
                                   <a href="https://www.google.com/maps?q=<?php echo e($user->city). ' '. e($user->country) ?>" target="_blank">Voir sur Google Maps</a><br>

                                </div>
                                <div class="span3">

                                   <?php 
                                   if($user->facebook){
                                    ?>
                                   <a href="//facebook.com/<?php echo e($user->facebook); ?>" target="_blank"><i class="icon-globe"></i>&nbsp;<?php echo e($user->facebook); ?></a><br>
                                   <?php
                                   }else{

                                        echo "";
                                   } 
                                   ?>

                                   <?php 
                                   if($user->twitter){
                                    ?>
                                   <a href="//twitter.com/<?php echo e($user->twitter); ?>" target="_blank"><i class="icon-fire"></i>&nbsp;@<?php echo e($user->twitter); ?></a><br>
                                   <?php
                                   }else{

                                        echo "";
                                   } 
                                   ?>

                                   <?php 
                                   if($user->available_for_hiring){
                                    ?>
                                    <i class="icon-user"></i>
                                    <?php
                                        echo "Disponible pour emploi";
                                   }else{
                                    ?>
                                    <i class="icon-user"></i>
                                    <?php

                                        echo "Non Disponible pour emploi";
                                   } 
                                   ?>

                                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div style="margin-top:20px;" class="span5 well">

                                    <h5>Petite Biographie de <?php echo e($user->first_name); ?></h5>
                                    <p>
                                        <?php 
                                   if($user->bio){
                                    
                                        echo nl2br(e($user->bio));
                                   }else{

                                        echo "Aucune Biographie pour le moment....";
                                   } 
                                   ?>


                                    </p>


                                </div>
                        </div>

                    </div>
                            
                        </div>


                </div>
                <div class="span6">
                      <div class="status-post">
                       <?php if (!empty($_GET['pseudo']) && $_GET['pseudo'] == get_session('pseudo')) :?>
                       <form action="microposts.php" method="post" data-parsley-validate>
                         <div class="form-group">
                           <label for="content" class="sr-only">Statut:</label>
                           <textarea name="content" id="content" rows="3" class="form-control" placeholder="Alors quoi de neuf?" required="required"></textarea>
                         </div>
      
                         <div class="form-group status-post-submit">
                           <input type="submit" name="publish" value="publier" class="btn btn-default btn-small">
                         </div>
      
                       </form>
                        <?php endif; ?>
                     </div>
                     <?php if (!empty($_GET['pseudo'])): ?>

                     <?php if(count($microposts) != 0 ): ?>

                        <?php foreach ($microposts as $micropost): ?>
                          <?php require("partials/_microposts.php"); ?>   
                        <?php endforeach; ?>

                     <?php else: ?> 
                        <p style="margin-top:20px;">Cet utilisateur n'a encore rien poster pour le moment!</p>
                    <?php endif; ?>

                </div>

                
                <?php endif; ?>

            </div>

            </div><!-- /container -->

    	</div> 
    
    <script src="scripts/jquery.min.js" type="text/javascript"></script> 
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/default.js" type="text/javascript"></script>

    <script src="libraries/jquery.timeago.js"></script>
    <script src="libraries/jquery.timeago.fr.js"></script>
    <script src="libraries/jquery.livequery.min.js"></script>

    <script src="libraries/parsley/parsley.min.js"></script>
    <script src="libraries/parsley/i18n/fr.js"></script>
    
    <script src="libraries/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {

      $("span.timeago").livequery(function(){

        $(this).timeago();

      });

        $("a.like").on("click", function(e){

            e.preventDefault();

            var id = $(this).attr("id");
            var action = $(this).data("action");
            var micropostId = id.split("like")[1];
            var url = 'ajax/micropost_like.php';
            
            $.ajax({

              type: 'POST',
              url: url,
              data: {

                micropost_id: micropostId,
                action: action
              },
              success: function(likers){
                $("#likers_" + micropostId).html(likers)
                if(action == "like"){

                  $('#'+id).html("<i class='icon-thumbs-down'></i>Je n'aime plus").data("action","unlike");
                }else{

                  $('#'+id).html("<i class='icon-thumbs-up'></i>J'aime").data("action","like");
                }
               
              }

            });

        });

    });
    window.parsleyValidator.setLocale('fr');
    </script>