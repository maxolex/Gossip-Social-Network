
    <?php $tittle = "Listes des utilisateurs"; ?>
    <?php require("includes/init.php"); ?>
    <?php include("includes/constants.php");?>
    <?php include("partials/_header.php");?>
        <div class="container">
            <h1><?php echo $long_text['content_users'][get_current_locale()]; ?></h1>

                <?php foreach (array_chunk($users, 4) as $user_set) : ?>
                <div class="row users">
                    <div class="span12">
                    <?php foreach ($user_set as $user) : ?>
                        <div style="max-width:20%;"class="span3 user-block">
                            <a href="profile.php?pseudo=<?php echo $user->pseudo; ?>">
                                <img src="<?php echo get_avatar($user->email); ?>" alt="<?php echo $user->pseudo; ?>" class="avatar img-circle"/>
                            </a>
                   
                            <a href="profile.php?pseudo=<?php echo $user->pseudo; ?>">

                                <h5 class="user-block-username">

                                    <?php echo $user->pseudo; ?>

                                </h5>                        
                            </a>
                  
                        </div>

                <?php endforeach ?>


                    </div>
                </div>
                <?php endforeach ?>

               <div class="pagination"><?php echo $pagination ?></div>
        </div>

    <?php include("partials/_footer.php");?>