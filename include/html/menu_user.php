<?php

/* 
 * Copyright (c) 2014, Servertester.de - Pictureclass
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted. 
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

function menu_user($active_top, $active_sub) {
    global $lang;
    ?>
    <link href="<?php echo PROJECT_URL; ?>/css/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo PROJECT_URL; ?>/css/sb-admin-2.css" rel="stylesheet">
    <!--<div class="col-sm-3 col-md-2 sidebar">-->                    
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav nav-sidebar" id="side-menu">
                <li <?php if($active_top == 1){echo "class='active'";}?>>
                    <a href="<?php echo PROJECT_URL; ?>/user/index.php" <?php if($active_sub == 11){echo "class='active'";}?>><i class="glyphicon glyphicon-user"></i> <?php echo $lang["g_profil"];?></a>
                </li>
                <li <?php if($active_top == 3){echo "class='active'";}?>>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> <?php echo $lang["g_profil"];?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        
                        <!--<li>
                            <a href="<?php //echo PROJECT_URL; ?>/user/profil.php" <?php //if($active_sub == 31){echo "class='active'";}?>>Profil</a>
                        </li>-->
                        <li>
                            <a href="<?php echo PROJECT_URL; ?>/user/email_password.php" <?php if($active_sub == 31){echo "class='active'";}?>> <?php echo $lang["user_change_email_pswd"];?></a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
    </div>
    <?php
}
