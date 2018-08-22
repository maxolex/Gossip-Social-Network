                    <div id="divMenuRight" class="pull-right">
                        <div class="navbar">
                        <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
                            MENU <span class="icon-chevron-down icon-white"></span>
                        </button>

                        <ul class="nav nav-tabs pull-right">
                                <li><a href="list_users.php"><?php echo $long_text['content_users'][get_current_locale()]; ?></a></li>
                                <li><a href="?lang=fr"><img src="assets/images/fr.gif"></a></li> 
                                <li><a href="?lang=en"><img src="assets/images/gb.gif"></a></li>
                          </ul>
                        <div class="nav-collapse collapse">

                             <ul class="nav nav-pills ddmenu">

                              <li class="<?php echo set_active('index'); ?>"><a href="index.php "><?php echo $menu['accueil'][get_current_locale()]; ?></a></li>
                              <?php if(is_logged_in()) : ?>
                                    <li class="dropdown">
                                    <a class="dropdown-toggle"
                                      data-toggle="dropdown" href="#">
                                      <?php echo get_session('pseudo'); ?>
                                      <b class="caret"></b>
                                    </a>
                                  <ul class="dropdown-menu">
                                    <li class="<?php echo set_active('profile'); ?>"><a href="profile.php?pseudo=<?php echo get_session('pseudo');?>"><?php echo $menu['mon_profil'][get_current_locale()]; ?></a></li>
                                    <li class="<?php echo set_active('change_password'); ?>"><a href="change_password.php"><?php echo $menu['change_password'][get_current_locale()]; ?></a></li>
                                    <li class="<?php echo set_active('edit_user'); ?>"><a href="edit_user.php?pseudo=<?php echo get_session('pseudo');?>"><?php echo $menu['editer_profil'][get_current_locale()]; ?></a></li>
                                    <li class="divider"></li>
                                    <li class="<?php echo set_active('share_code'); ?>"><a href="share_code.php"><?php echo $menu['share_code'][get_current_locale()]; ?></a></li>
                                    <li class="<?php echo set_active('my_codes'); ?>"><a href="my_codes.php"><?php echo $menu['my_codes'][get_current_locale()]; ?></a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php"><?php echo $menu['deconnexion'][get_current_locale()]; ?></a></li>
                    
                                </ul>
                                    <li class="<?php echo $notifications_count > 0 ? 'have_notifs' : '' ?>">
                                      <a href="notifications.php"><i class="icon-bell"></i>
                                      <?php echo $notifications_count > 0 ? "($notifications_count)" : ''; ?>
                                      </a>
                                    </li>
                                  </li>
                            <?php else : ?>
                                  <li class="<?php echo set_active('login'); ?>"><a href="login.php"><?php echo $menu['connexion'][get_current_locale()]; ?></a></li>
                                  <li class="<?php echo set_active('register');?>"><a href="register.php"><?php echo $menu['inscription'][get_current_locale()]; ?></a></li>
                            <?php endif;  ?>

                              
                            </ul>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
