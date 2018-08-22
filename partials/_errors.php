<?php                    
                    if (isset($errors) && count($errors) != 0) {

                      echo '<div class="alert span6 alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>';

                        foreach ($errors as $error) {

                          echo $error.'<br/>';
                          

                        }


                      echo '</div>';

                    }