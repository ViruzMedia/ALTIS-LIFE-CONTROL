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

function admin_menu($active_top, $active_sub) {
    global $lang;
    ?>
    <link href="<?php echo PROJECT_URL;?>/css/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo PROJECT_URL;?>/css/sb-admin-2.css" rel="stylesheet">
    <!--<div class="col-sm-3 col-md-2 sidebar">-->                    
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav nav-sidebar" id="side-menu">
                <li <?php if($active_top == 1){echo "class='active'";}?>>
                    <a href="<?php echo PROJECT_URL;?>/admin/index.php" <?php if($active_sub == 11){echo "class='active'";}?>><i class="glyphicon glyphicon-th"></i> <?php echo $lang["admin_menu_overview"];?></a>
                </li>
                <li <?php if($active_top == 2){echo "class='active'";}?>>
                    <a href="#"><i class="glyphicon glyphicon-user"></i> <?php echo $lang["admin_menu_users"];?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" style="">
                        <li>
                            <a href="<?php echo PROJECT_URL;?>/admin/user_list.php" <?php if($active_sub == 21){echo "class='active'";}?>><?php echo $lang["admin_menu_all_users"];?></a>
                        </li>
                        <li>
                            <a href="<?php echo PROJECT_URL;?>/admin/user_new.php" <?php if($active_sub == 22){echo "class='active'";}?>><?php echo $lang["admin_menu_new_user"];?></a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li <?php if($active_top == 3){echo "class='active'";}?>>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> <?php echo $lang["g_player"];?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo PROJECT_URL;?>/admin/player_list.php" <?php if($active_sub == 31){echo "class='active'";}?>><?php echo $lang["player_list"];?></a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li <?php if($active_top == 4){echo "class='active'";}?>>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> <?php echo $lang["g_vehicle"];?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo PROJECT_URL;?>/admin/vehicle_list.php" <?php if($active_sub == 41){echo "class='active'";}?>><?php echo $lang["vehicle_list"];?></a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li <?php if($active_top == 5){echo "class='active'";}?>>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> <?php echo $lang["g_houses"];?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo PROJECT_URL;?>/admin/house_list.php" <?php if($active_sub == 51){echo "class='active'";}?>><?php echo $lang["houses_list"];?></a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li <?php if($active_top == 6){echo "class='active'";}?>>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> <?php echo $lang["wanted_list"];?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo PROJECT_URL;?>/admin/wanted_list.php" <?php if($active_sub == 61){echo "class='active'";}?>><?php echo $lang["wanted_list"];?></a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
    </div>
    <?php
}
