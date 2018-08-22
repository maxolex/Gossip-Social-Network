    <?php $tittle = "Accueil";?>
    <?php require("includes/init.php"); ?>
    <?php include("includes/constants.php");?>
    <?php include("partials/_header.php");?>

<div id="decorative1" style="position:relative">
    <div class="container">

        <div class="divPanel headerArea">
            <div class="row-fluid">
                <div class="span12">
    
                    <div id="headerSeparator"></div>

                    <div class="row-fluid">
                        <div class="span6">

                            <div id="divHeaderText" class="page-content">
                                <div id="divHeaderLine1"><?php echo WEBSITE_NAME; ?></div><br />
                                <div id="divHeaderLine2"><?php echo $long_text['accueil_intro'][get_current_locale()]; ?></div><br />
                            </div>

                        </div>
                        <div class="span6">
                            <!--Edit Camera Slider here-->
                            <div id="camera_wrap">
                                <div data-src="scripts/intro-bg.jpg" ><div class="camera_caption fadeFromBottom cap1">Recevoir de l'aide si vous rencontrez des problèmes sur l'un de vos projets!</div></div>
                                <div data-src="scripts/post03.jpg" ><div class="camera_caption fadeFromBottom cap2">Tisser des liens d'amitiés avec d'autres développeurs!</div></div>
                                <div data-src="scripts/header-bg.jpg" ><div class="camera_caption fadeFromBottom cap1">Échanger des codes sources!</div></div>
                            </div>
                            <!--End Camera Slider here-->

                        </div>
                    </div>

                    <div id="headerSeparator2"></div>
        
                </div>
            </div>
   
        </div>

    </div>
</div>

    </div> <!-- /container -->

    </div>
    
    <?php include("partials/_footer.php");?>

