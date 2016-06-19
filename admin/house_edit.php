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

require_once 'include/house_edit.inc.php';
admin_html_head($lang["house_edit"], "<link href='".PROJECT_URL."/css/jquery.bootgrid.css' rel='stylesheet' type='text/css'>");

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
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;"><?php echo $lang['house_edit_owner']." ". $row->name; ?></h1>
            
            <!-- Full Screen Row -->
            <div class="row">
                <div class="col-lg-12">
                                    
                    <!-- Left Side Panel -->
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="text-center"><?php echo $lang['house_edit']. " #" .$row->id; ?></h4>
                                </div>
                                <div class="panel-body text-center">
                                    <ul class="list-group">

                                        <!-- Skinn -->
                                        <li class="list-group-item">
                                            <div class="img-responsive" style="height: 35%; overflow: hidden">
                                                <img src="../img/houses_list.jpg" class="img-responsive"/>
                                            </div>
                                        </li>

                                        <!-- UID and Link to Steam -->
                                        <li class="list-group-item">
                                            <p class="text-center"><?php echo $lang['house_id'];?>: <?php echo $row->id;?></p>
                                            <p class="text-center"><?php echo $lang['g_owner'];?>: <a href="player_edit.php?id=<?php echo $row->uid;?>" target="_blank"><?php echo $row->name;?></a></p>
                                        </li>
                                                                                
                                        <li class="list-group-item">
                                            <button type='button' class='btn btn-danger' data-toggle="modal" data-target="#delete" style='opacity: 1;'>
                                                <i class='fa fa-trash-o-3x'></i><?php echo $lang['g_delete'] . " " . $lang['house'];?>
                                            </button>

                                            <a class="btn btn-warning" href="?id=<?php echo $id;?>&change=inventory" style="opacity: 1;">
                                                <i class='fa fa-trash-o-3x'></i><?php echo $lang['g_delete'] . " " . $lang['g_inventory'];?>
                                            </a>
                                            
                                            <a class="btn btn-warning" href="?id=<?php echo $id;?>&change=inventory" style="opacity: 1;">
                                                <i class='fa fa-trash-o-3x'></i><?php echo $lang['g_delete'] . " " . $lang['house_containers'];?>
                                            </a>
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

                                <!-- Inventory -->
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4><?php echo $lang['house'] . " ".$lang['g_inventory'];?></h4>
                                        </div>
                                        <div class="panel-body" style="word-break: break-word;">
                                            <?php echo $output_house_inventory;?>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4><?php echo $lang['house_containers'];?></h4>
                                        </div>
                                        <div class="panel-body" style="word-break: break-word;">
                                            <?php echo $output_house_containers;?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">

                                    <!-- Panel Header -->
                                    <div class="panel-heading">
                                        <h4><?php echo $lang['house_settings'];?></h4>
                                    </div>
                                    
                                    <!-- Panel Body -->
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <?php echo $output_owned;?>
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
            <form method="post" action="house_edit.php?id=<?php echo $row->id;?>" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> <?php echo $lang['g_delete']." ".$row->classname;?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="delete" />
                        <input type="hidden" name="id" value="<?php echo $row->id;?>" />
                        <p><?php echo $lang['t_delete'].$lang['g_house']." <strong>'".$row->classname."'</strong>?";?></p>                                    
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

    
    