    <?php $tittle = "Mes Codes";?>
    <?php require("includes/init.php"); ?>
    <?php include("includes/constants.php");?>
    <?php include("partials/_header.php");?>
    <div class="main-content">
        <div class="container">
              <div class="span12">
                <h2>Mes Codes</h2>
                  <table class='table table-striped'>
                    <thead>
                        <td>#</td>
                        <td>Code</td>
                        <td>Action</td>
                    </thead>
                      <tbody>
                         <?php foreach ($codes as $code): ?>
                          <td><?php echo $code->id; ?></td>         
                          <td><?php echo substr(e($code->code), 0,50)."..."; ?></td>
                          <td><a class="btn btn-primary" href="show_code.php?id=<?php echo $code->id; ?>">Voir le code</a></td>                          
                        </tr>
                       <?php endforeach ?> 
                      </tbody>                             
                  </table>
              </div>
        </div>

    </div>
    
    <?php include("partials/_footer.php");?>
