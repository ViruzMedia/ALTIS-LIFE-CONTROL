<?php

/* 
 * Copyright (c) 2015, Pictureclass
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

include_once '../config.php';
include_once PROJECT_PATH.'/include/login/db_connect.php';
include_once PROJECT_PATH.'/include/login/db-config.php';
include_once PROJECT_PATH.'/include/login/functions.php';
include_once PROJECT_PATH.'/include/functions.inc.php';

sec_session_start();

//Login Check
if(login_check($mysqli) < 10){
    header('Location: '.PROJECT_URL.'/login.php');
}

require_once 'include/player_edit.inc.php';
admin_html_head($lang["player_edit"], "<link href='".PROJECT_URL."/css/jquery.bootgrid.css' rel='stylesheet' type='text/css'>");

top_menu();

?>
<div class="container-fluid">
    <div class="row">
        <?php
        //Load left Side Menu
        admin_menu(3,31);
        ?>
        <!-- Site Content -->
        <div id="page-wrapper" >
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;"><?php echo $lang['player_edit']." ". $row->name; ?></h1>
            
            <!-- Full Screen Row -->
            <div class="row">
                <div class="col-lg-12">
                    
                    <!-- First Tabpanel -->
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <div class="col-lg-12" style="margin-bottom: 10px;">
                            <div class="row">
                        
                                <ul id="player_detail" class="nav nav-tabs" role="tablist">
                                  <li role="presentation" class="active">
                                      <a href="#detail" id="detail-tab" aria-controls="detail" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <?php echo $lang['g_details'];?></a>
                                  </li>
                                  <li role="presentation">
                                      <a href="#edit" id="edit-tab" aria-controls="edit" role="tab" data-toggle="tab"><i class="fa fa-pencil"></i> <?php echo $lang['g_edit'];?></a>
                                  </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="detail" aria-labelledby="detail-tab">
                                    
                                <!-- Left Side Panel -->
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="text-center"><?php echo $row->name; ?></h4>
                                            </div>
                                            <div class="panel-body text-center">
                                                <ul class="list-group">
                                                    
                                                    <!-- Skinn -->
                                                    <li class="list-group-item">
                                                        <div class="img-responsive" style="height: 35%; overflow: hidden">
                                                            <img src="../img/skin/<?php echo $echo_get_skin_civ;?>.jpg" alt="<?php echo $echo_get_skin_civ;?>" />
                                                        </div>
                                                    </li>
                                                    
                                                    <!-- UID and Link to Steam -->
                                                    <li class="list-group-item">
                                                        <p class="text-center"><?php echo $lang['g_userid'];?>: <?php echo $row->uid;?></p>
                                                        <p class="text-center"><?php echo $lang['g_steamid'];?>: <a href="http://steamcommunity.com/profiles/<?php echo $row->playerid;?>" target="_blank"><?php echo $row->playerid;?></a></p>
                                                    </li>
                                                    <!-- Gang -->
                                                    <li class="list-group-item">
                                                        <p class="text-center"><strong><?php echo $lang['gang'];?>:</strong> <?php echo $output_gang->name;?></p>
                                                    </li>
                                                    <!-- Aliasses -->
                                                    <li class="list-group-item">
                                                        <p class="text-center"><strong><?php echo $lang['player_aliasses'];?>:</strong> <?php echo substr($row->aliases,3,-3);?></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>
                                                            <strong><?php echo $lang['g_vehicles'];?>:</strong> <?php echo $count_vehicles;?>
                                                            <strong><?php echo $lang['g_houses'];?>:</strong> <?php echo $count_houses;?> 
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Panel -->

                                <div class="col-lg-9">

                                    <!-- Player Level -->
                                    <div class="row">
                                        <div class="col-md-6">

                                            <!-- Cop Level -->
                                            <div class="col-md-3 text-center">
                                                <?php 
                                                    echo $echo_coplevel;
                                                ?>
                                                
                                            </div>

                                            <!-- Medic Level -->
                                            <div class="col-md-3 text-center">
                                                <?php 
                                                    echo $echo_mediclevel;
                                                ?>
                                            </div>

                                            <!-- Donator Level -->
                                            <div class="col-md-3 text-center">
                                                <?php 
                                                echo $echo_donatorlevel;
                                                ?>
                                            </div>

                                            <!-- Admin Level -->
                                            <div class="col-md-3 text-center">
                                                <?php 
                                                echo $echo_adminlevel;
                                                ?>
                                            </div>
                                        </div>

                                        <!-- Player Stats -->
                                        <div class="col-md-6">
                                            <div class="panel panel-default">

                                                <!-- Panel Header -->
                                                <div class="panel-heading">
                                                    <h4><?php echo $lang['player_stats'];?></h4>
                                                </div>

                                                <!-- Panel Body -->
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-4 text-center">
                                                            <p>
                                                                <?php echo $output_wanted; ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-4 text-center">
                                                            <p>
                                                                <?php echo $echo_arrested;?>
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-4 text-center">
                                                            <p>
                                                                <?php echo $echo_blacklist; ?>
                                                            </p>
                                                        </div>
                                                        
                                                    </div>
                                                    <hr>
                                                    <!-- Money Stats -->
                                                    <!-- Bank -->
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <form action="player_edit.php?id=<?php echo $row->uid;?>" method="POST" role="form">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-bank fa-fw"></i></span>
                                                                    <div class="input-group-addon"><?php echo currency();?></div>
                                                                    <input class="form-control text-right" type="text" name="value" placeholder="<?php echo $lang['player_money_bankacc'];?>" value="<?php echo money($row->bankacc);?>">
                                                                    <input type="hidden" name="type" value="bankacc">
                                                                    <div class="input-group-addon">.00</div>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="submit"><span class="fa fa-save fa-lg"></span> &nbsp;</button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class='btn-group-vertical'>
                                                                <a class="btn btn-xs btn-success" href="?id=<?php echo $uid;?>&change=bankacc&value=<?php echo ($row->bankacc + 1000);?>">+ 1.000</a>
                                                                <a class="btn btn-xs btn-success" href="?id=<?php echo $uid;?>&change=bankacc&value=<?php echo ($row->bankacc + 10000);?>">+ 10.000</a>
                                                                <a class="btn btn-xs btn-success" href="?id=<?php echo $uid;?>&change=bankacc&value=<?php echo ($row->bankacc + 100000);?>">+ 100.000</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class='btn-group-vertical'>
                                                                <a class="btn btn-xs btn-danger" href="?id=<?php echo $uid;?>&change=bankacc&value=<?php echo ($row->bankacc - 1000);?>">- 1.000</a>
                                                                <a class="btn btn-xs btn-danger" href="?id=<?php echo $uid;?>&change=bankacc&value=<?php echo ($row->bankacc - 10000);?>">- 10.000</a>
                                                                <a class="btn btn-xs btn-danger" href="?id=<?php echo $uid;?>&change=bankacc&value=<?php echo ($row->bankacc - 100000);?>">- 100.000</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <!-- Cash -->
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <form action="player_edit.php?id=<?php echo $row->uid;?>" method="POST" role="form">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-money fa-fw"></i></span>
                                                                    <div class="input-group-addon"><?php echo currency();?></div>
                                                                    <input class="form-control text-right" type="text" name="value" placeholder="<?php echo $lang['player_money_cash'];?>" value="<?php echo money($row->cash);?>">
                                                                    <input type="hidden" name="type" value="cash">
                                                                    <div class="input-group-addon">.00</div>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="submit"><span class="fa fa-save fa-lg"></span> &nbsp;</button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class='btn-group-vertical'>
                                                                <a class="btn btn-xs btn-success" href="?id=<?php echo $uid;?>&change=cash&value=<?php echo ($row->cash + 1000);?>">+ 1.000</a>
                                                                <a class="btn btn-xs btn-success" href="?id=<?php echo $uid;?>&change=cash&value=<?php echo ($row->cash + 10000);?>">+ 10.000</a>
                                                                <a class="btn btn-xs btn-success" href="?id=<?php echo $uid;?>&change=cash&value=<?php echo ($row->cash + 100000);?>">+ 100.000</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class='btn-group-vertical'>
                                                                <a class="btn btn-xs btn-danger" href="?id=<?php echo $uid;?>&change=cash&value=<?php echo ($row->cash - 1000);?>">- 1.000</a>
                                                                <a class="btn btn-xs btn-danger" href="?id=<?php echo $uid;?>&change=cash&value=<?php echo ($row->cash - 10000);?>">- 10.000</a>
                                                                <a class="btn btn-xs btn-danger" href="?id=<?php echo $uid;?>&change=cash&value=<?php echo ($row->cash - 100000);?>">- 100.000</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <!-- End Panel Body -->
                                                </div>

                                            <!-- End Panel -->    
                                            </div>

                                        <!-- End Player Stats -->
                                        </div>

                                    <!-- End Right Panel First Row -->
                                    </div>

                                    <!-- Start Right Panel Second Row Licenses -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <ul class="nav nav-tabs" id="player_tabs" role="tablist">
                                                    <li role="presentation" class="active">
                                                        <a href="#licenses" id="licenses-tab" aria-controls="licenses" role="tab" data-toggle="tab"><?php echo $lang['player_licenses'];?></a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#civ_inventory" id="civ_inventory-tab" aria-controls="civ_inventory" role="tab" data-toggle="tab"><?php echo $lang['player_civ_inventory_s'];?></a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#cop_inventory" id="cop_inventory-tab" aria-controls="cop_inventory" role="tab" data-toggle="tab"><?php echo $lang['player_cop_inventory_s'];?></a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#med_inventory" id="med_inventory-tab" aria-controls="cop_inventory" role="tab" data-toggle="tab"><?php echo $lang['player_med_inventory_s'];?></a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#vehicle" id="vehicle-tab" aria-controls="vehicle" role="tab" data-toggle="tab"><?php echo $lang['g_vehicles'];?></a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href='#houses' id="houses-tab" aria-controls="houses" role="tab" data-toggle="tab"><?php echo $lang['g_houses'];?></a>
                                                    </li>
                                                </ul>
                                                <!-- TAB CONTENT -->
                                                <div id="player_tabs_content" class="tab-content">
                                                    <div class="tab-pane fade active in" id="licenses">
                                                    <!-- CIV Licenses OUTPUT -->
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <?php echo $lang['player_civ_licenses'];?>
                                                            </div>            
                                                            <div class="panel-body">
                                                                <div class="col-md-6">
                                                                    <?php 
                                                                    echo $echo_civ_licenses_true;
                                                                    ?>   
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <?php 
                                                                    echo $echo_civ_licenses_false;
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- COP LICENSES OUTPUT -->            
                                                            <div class="panel-heading">
                                                                <?php echo $lang['player_cop_licenses'];?>
                                                            </div>            
                                                            <div class="panel-body">
                                                                <div class="col-md-6">
                                                                    <?php 
                                                                    echo $echo_cop_licenses_true;
                                                                    ?>   
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <?php 
                                                                    echo $echo_cop_licenses_false;
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        
                                                            <!-- MEDIC LICENSES OUTPUT -->
                                                            <div class="panel-heading">
                                                                <?php echo $lang['player_med_licenses'];?>
                                                            </div>            
                                                            <div class="panel-body">
                                                                <div class="col-md-6">
                                                                    <?php 
                                                                    echo $echo_medic_licenses_true;
                                                                    ?>   
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <?php 
                                                                    echo $echo_medic_licenses_false;
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>   

                                                    <!-- CIV INVENTORY CONTENT -->
                                                    <div class="tab-pane fade" id="civ_inventory">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4><?php echo $lang['player_civ_inventory'];?> <a data-toggle="modal" href="#edit_civ_inventory" class="btn btn-primary" style="float: right;"><span class="glyphicon glyphicon-pencil"></span></a></h4>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_clothing'];?></h4>
                                                                        <p><?php echo $output_civ_gear[0];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_toolbelt-items'];?></h4>
                                                                        <p><?php echo $output_civ_gear[1];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_weapons'];?></h4>
                                                                        <p><?php echo $output_civ_gear[2];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_v-items'];?></h4>
                                                                        <p><?php echo $output_civ_gear[11];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_uniform-items'];?></h4>
                                                                        <p><?php echo $output_civ_gear[3];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_uniform-ammo'];?></h4>
                                                                        <p><?php echo $output_civ_gear[4];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_backpack-items'];?></h4>
                                                                        <p><?php echo $output_civ_gear[5];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_backpack-ammo'];?></h4>
                                                                        <p><?php echo $output_civ_gear[6];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_vest-items'];?></h4>
                                                                        <p><?php echo $output_civ_gear[7];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_vest-ammo'];?></h4>
                                                                        <p><?php echo $output_civ_gear[8];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_p-weapon-attachment'];?></h4>
                                                                        <p><?php echo $output_civ_gear[9];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_s-weapon-attachment'];?></h4>
                                                                        <p><?php echo $output_civ_gear[10];?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 

                                                    <!-- COP INVENTORY CONTENT -->
                                                    <div class="tab-pane fade" id="cop_inventory">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4><?php echo $lang['player_cop_inventory'];?> <a data-toggle="modal" href="#edit_cop_inventory" class="btn btn-primary" style="float: right;"><span class="glyphicon glyphicon-pencil"></span></a></h4>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_clothing'];?></h4>
                                                                        <p><?php echo $output_cop_gear[0];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_toolbelt-items'];?></h4>
                                                                        <p><?php echo $output_cop_gear[1];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_weapons'];?></h4>
                                                                        <p><?php echo $output_cop_gear[2];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_v-items'];?></h4>
                                                                        <p><?php echo $output_cop_gear[11];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_uniform-items'];?></h4>
                                                                        <p><?php echo $output_cop_gear[3];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_uniform-ammo'];?></h4>
                                                                        <p><?php echo $output_cop_gear[4];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_backpack-items'];?></h4>
                                                                        <p><?php echo $output_cop_gear[5];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_backpack-ammo'];?></h4>
                                                                        <p><?php echo $output_cop_gear[6];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_vest-items'];?></h4>
                                                                        <p><?php echo $output_cop_gear[7];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_vest-ammo'];?></h4>
                                                                        <p><?php echo $output_cop_gear[8];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_p-weapon-attachment'];?></h4>
                                                                        <p><?php echo $output_cop_gear[9];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_s-weapon-attachment'];?></h4>
                                                                        <p><?php echo $output_cop_gear[10];?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <!-- Medic INVENTORY CONTENT -->
                                                    <div class="tab-pane fade" id="med_inventory">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4><?php echo $lang['player_med_inventory'];?> <a data-toggle="modal" href="#edit_med_inventory" class="btn btn-primary" style="float: right;"><span class="glyphicon glyphicon-pencil"></span></a></h4>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_clothing'];?></h4>
                                                                        <p><?php echo $output_med_gear[0];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_toolbelt-items'];?></h4>
                                                                        <p><?php echo $output_med_gear[1];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_weapons'];?></h4>
                                                                        <p><?php echo $output_med_gear[2];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_v-items'];?></h4>
                                                                        <p><?php echo $output_med_gear[11];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_uniform-items'];?></h4>
                                                                        <p><?php echo $output_med_gear[3];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_uniform-ammo'];?></h4>
                                                                        <p><?php echo $output_med_gear[4];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_backpack-items'];?></h4>
                                                                        <p><?php echo $output_med_gear[5];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_backpack-ammo'];?></h4>
                                                                        <p><?php echo $output_med_gear[6];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_vest-items'];?></h4>
                                                                        <p><?php echo $output_med_gear[7];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_vest-ammo'];?></h4>
                                                                        <p><?php echo $output_med_gear[8];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_p-weapon-attachment'];?></h4>
                                                                        <p><?php echo $output_med_gear[9];?></p>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h4><?php echo $lang['inv_s-weapon-attachment'];?></h4>
                                                                        <p><?php echo $output_med_gear[10];?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <!-- Vehicle Tab -->
                                                    <div class="tab-pane fade" id="vehicle">
                                                        <table class="table table-hover">
                                                            <tr>
                                                                <td><strong>#</strong> </td>
                                                                <td><strong>Name</strong></td>
                                                                <td><strong>Side</strong></td>
                                                                <td><strong>Type</strong></td>
                                                                <td><strong>Alive</strong></td>
                                                                <td><strong>Active</strong></td>
                                                                <td><strong>Inventory</strong></td>
                                                                <td><strong>Settings</strong></td>
                                                            </tr>
                                                        <?php while($row_veh = mysqli_fetch_object($vehicle_SQL)){ ?>
                                                            <tr>
                                                                <td><?php echo $row_veh->id;?></td>
                                                                <td><?php echo "<a href='vehicle_detail.php?id=".$row_veh->id."'>".$row_veh->classname."</a>";?></td>
                                                                <td><?php echo $row_veh->type;?></td>
                                                                <td><?php echo $row_veh->side;?></td>
                                                                <td><?php echo $row_veh->alive;?></td>
                                                                <td><?php echo $row_veh->active;?></td>
                                                                <td><?php echo $row_veh->inventory;?></td>
                                                                <td><a href="vehicle_detail.php?id=<?php echo $row_veh->id;?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </table>
                                                    </div> 
                                                    <!-- Houses Tab -->
                                                    <div class="tab-pane fade" id="houses">
                                                        <table class="table table-hover">
                                                            <tr>
                                                                <td><strong>#</strong> </td>
                                                                <td><strong>Position</strong></td>
                                                                <td><strong>Inventory</strong></td>
                                                                <td><strong>Containers</strong></td>
                                                                <td><strong>Owned</strong></td>
                                                                <td><strong>Settings</strong></td>
                                                            </tr>
                                                        <?php while($row_houses = mysqli_fetch_object($houses_SQL)){ ?>
                                                            <tr>
                                                                <td><?php echo "<a href='houses.php?id=".$row_houses->id."'>".$row_houses->id."</a>";?></td>
                                                                <td><?php echo $row_houses->pos;?></td>
                                                                <td style="word-wrap: break-word;"><?php echo $row_houses->inventory;?></td>
                                                                <td style="word-wrap: break-word;"><?php echo $row_houses->containers;?></td>
                                                                <td><?php echo $row_houses->owned;?></td>
                                                                <td><a href="houses.php?id=<?php echo $row_houses->id;?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                                            </tr>
                                                        <?php 
                                                        //END WHILE
                                                            } ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <!-- End Right Side COL -->
                                </div>
                                
                            <!-- End First Tab tabpanel Detail-->
                            </div>
                            
                            <!-- Start Second Tab tabpanel Edit -->
                            <div role="tabpanel" class="tab-pane fade" id="edit" aria-labelledby="edit-tab">
                                <p>test</p>   

                            </div>
                        </div>

                    </div>
                </div>
            </div>    
        </div>        
    </div>
</div>
    
<!-- TAB Menu -->
            

<!-- START MODAL -->


<!-- START MODAL CIV Inventory -->
<div class="modal fade" id="edit_civ_inventory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Edit Civ Inventory</h4>
            </div>
            <form method="post" action="player_edit.php?id=<?php echo $row->uid;?>" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="civ_gear" />
                        <div class="row">
                            <textarea class="form-control" rows="10" name="civ_gear_value"><?php echo $row->civ_gear;?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="reset">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL CIV INVENTORY -->
<!-- START MODAL COP Inventory -->
<div class="modal fade" id="edit_cop_inventory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Edit Cop Inventory</h4>
            </div>
            <form method="post" action="player_edit.php?id=<?php echo $row->uid;?>" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="cop_gear" />
                        <div class="row">
                            <textarea class="form-control" rows="10" name="cop_gear_value"><?php echo $row->cop_gear;?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="reset">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL COP INVENTORY -->
<!-- START MODAL MEDIC Inventory -->
<div class="modal fade" id="edit_med_inventory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Edit Medic Inventory</h4>
            </div>
            <form method="post" action="player_edit.php?id=<?php echo $row->uid;?>" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="med_gear" />
                        <div class="row">
                            <textarea class="form-control" rows="10" name="med_gear_value"><?php echo $row->med_gear;?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="reset">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL MEDIC INVENTORY -->
<!-- START MODAL DELETE -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="player_edit.php?id=<?php echo $row->uid;?>" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Delete <?php echo $row->name;?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="delete" />
                        <input type="hidden" name="playerid" value="<?php echo $row->playerid;?>" />
                        <p>Do you realy want to delete the Player <strong>"<?php echo $row->name;?>" </strong> and all his Stuff (Vehicles/Houses)?</p>                                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="reset">Close</button>
                    <button class="btn btn-primary" type="submit">Delete Player</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS FOR TABS -->
<script type="text/javascript">
$('#player_tabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
  })
</script>
<?php
admin_footer("<script src='".PROJECT_URL."/js/sb-admin-2.js'></script>
<script src='".PROJECT_URL."/js/metisMenu/metisMenu.min.js'></script>");

    
    