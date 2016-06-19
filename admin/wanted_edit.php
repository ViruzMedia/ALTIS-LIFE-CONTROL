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

require_once 'include/wanted_edit.inc.php';
admin_html_head($lang["wanted_edit"], "<link href='".PROJECT_URL."/css/jquery.bootgrid.css' rel='stylesheet' type='text/css'>");

top_menu();

?>
<div class="container-fluid">
    <div class="row">
        <?php
        //Load left Side Menu
        admin_menu(6,61);
        ?>
        <!-- Site Content -->
        <div id="page-wrapper" >
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;"><?php echo $lang['wanted_edit']." ". $row->wantedName; ?></h1>
            
            <!-- Full Screen Row -->
            <div class="row">
                <div class="col-lg-12">
                                    
                    <!-- Left Side Panel -->
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="text-center"><?php echo $row->wantedName; ?></h4>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-group">

                                        <!-- Skinn -->
                                        <li class="list-group-item">
                                            <div class="img-responsive" style="height: 35%; overflow: hidden">
                                                <img src="../img/skin/<?php echo $echo_get_skin_civ;?>.jpg" alt="<?php echo $echo_get_skin_civ;?>" class="img-responsive" />
                                            </div>
                                        </li>

                                        <!-- Link to Player Profile -->
                                        <li class="list-group-item">
                                            <p class="text-center"><?php echo $lang['g_player'];?>: <a href="player_edit.php?id=<?php echo $row->uid;?>" target="_blank"><?php echo $row->wantedName;?></a></p>
                                        </li>
                                        <li class="list-group-item">
                                            <button type='button' class='btn btn-danger' data-toggle="modal" data-target="#delete" style='opacity: 1;'>
                                                <i class='fa fa-trash-o-3x'></i>Delete Wanted Entry
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Panel -->

                    <div class="col-lg-9">

                        <!-- Wanted Entrys -->
                        <div class="row">
                            <div class="col-md-6">

                                <!-- Inventory -->
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4><?php echo $lang['wanted_all'];?></h4>
                                        </div>
                                        <div class="panel-body">
                                            <?php echo $row->wantedCrimes;?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Player Stats -->
                            <div class="col-md-6">
                                <div class="panel panel-default">

                                    <!-- Panel Header -->
                                    <div class="panel-heading">
                                        <h4><?php echo $lang['wanted_bounty'];?></h4>
                                    </div>
                                    
                                    <!-- Panel Body -->
                                    <div class="panel-body">
                                        
                                        <p><?php echo $lang['wanted_bounty'];?>: <?php echo money($row->wantedBounty);?></p>
                                            
                                    <!-- End Panel Body -->
                                    </div>

                                <!-- End Panel -->    
                                </div>

                            <!-- End Player Stats -->
                            </div>

                        <!-- End Right Panel First Row -->
                        </div>
                        
                    <!-- End Right Side COL -->
                    </div>
                </div>
            </div>    
        </div>        
    </div>
</div>
    
<!-- TAB Menu -->
            

<!-- START MODAL -->

<!-- START MODAL DELETE -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="wanted_edit.php?id=<?php echo $row->id;?>" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> <?php echo $lang['wanted_delete']." ".$row->name;?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="delete" />
                        <input type="hidden" name="id" value="<?php echo $row->wantedid;?>" />
                        <p><?php echo $lang['t_delete'].$lang['wanted']." <strong>'".$row->name."'</strong>?";?></p>                                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="reset"><?php echo $lang['g_close'];?></button>
                    <button class="btn btn-primary" type="submit"><?php echo $lang['g_delete'];?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
admin_footer("<script src='".PROJECT_URL."/js/sb-admin-2.js'></script>
<script src='".PROJECT_URL."/js/metisMenu/metisMenu.min.js'></script>");

    
    