<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>
      <?php
        echo isset($tittle)? $tittle . ' - '.WEBSITE_NAME : WEBSITE_NAME;
      ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Réseau Social pour développeurs">
    <meta name="author" content="Maxolex Togolais">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <link href="scripts/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
    <link href="scripts/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />


    <!--link rel="stylesheet" href="scripts/font-awesome.min.css"-->

    <link href="scripts/style.css" rel="stylesheet" type="text/css" />
    <link href="scripts/camera.css" rel="stylesheet" type="text/css" />

    <link href="scripts/custom.css" rel="stylesheet" type="text/css"/>
    <link href="assets/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="libraries/uploadify/uploadify.css">
    <link rel="stylesheet" href="libraries/sweetalert/sweetalert.css">
    
    <link type="image/x-icon" href="assets/images/icon.ico" rel="shortcut icon" />



    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body id="pageBody">

<div id="decorative2">
    <div class="container">

        <div class="divPanel topArea notop nobottom">
            <div class="row-fluid">
                <div class="span12">

                    <div id="divLogo" class="pull-left">
                        <a href="index.php" id="divSiteTitle"><?php echo WEBSITE_NAME;?></a><br />
                        <a href="index.php" id="divTagLine">Making developers more closer!</a>
                    </div>

<?php include("partials/_nav.php");?>
<?php include("partials/_flash.php");?>
