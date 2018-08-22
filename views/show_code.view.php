    <?php $tittle = "Afichage de Codes Sources";?>
    <?php require("includes/init.php"); ?>
    <?php include("includes/constants.php");?>
    <?php include("partials/_header.php");?>
    <?php include("libraries/geshi/geshi.php"); ?>
    <div class="main-content">
        <div id="main-content-share-code">

            <?php 

            $source = $data->code;
            $language = 'php';

            $geshi = new GeSHi($source, $language);
            $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
            $geshi->set_keyword_group_style(1, 'color: #FF0000');
            $geshi->set_keyword_group_style(2, 'color: #c2029c');
            $geshi->set_keyword_group_style(3, 'color: #f77b02');
            $geshi->set_keyword_group_style(4, 'color: #3802c2');
            $geshi->set_symbols_style('color: #a108f1');
            $geshi->set_strings_style('color: #a108f1');
            $geshi->set_comments_style('1', 'background-color:orange; font-variant:small-caps;');
            $geshi->set_comments_style('MULTI', 'background-color:orange; font-variant:small-caps;');
            $geshi->set_line_style('background: #fcfcfc;', 'background: #f7ebbb;');
            echo $geshi->parse_code();

            ?>
        	<!--pre class="prettyprint linenums">
               <ol><?php echo  e($data->code); ?></ol>
            </pre-->
            <div class="btn-group navig">

                    <a href="share_code.php?id=<?php echo $_GET['id'];  ?>" class="btn btn-warning">Cloner</a>
                    <a href="share_code.php" class="btn btn-primary">Nouveau</a>


                </div>
              
        </div>

    </div>
    
    <?php include("partials/_footer.php");?>

    <script src="bootstrap/js/jquery.js"></script>