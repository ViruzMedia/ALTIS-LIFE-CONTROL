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

if(!isset($_GET['id'])){
    header('Location: user_list.php');
}
   

include_once '../config.php';
include_once PROJECT_PATH.'/include/login/db_connect.php';
include_once PROJECT_PATH.'/include/login/db-config.php';
include_once PROJECT_PATH.'/include/login/functions.php';
include_once PROJECT_PATH.'/include/functions.inc.php';

sec_session_start();

//Login Check
if(login_check($mysqli) < 10){
    header('Location: /login.php');
}

require_once 'include/user_edit.inc.php';
admin_html_head($lang['user_edit'], "");

top_menu();

?>
<div class="container-fluid">
    <div class="row">
        <?php
        //Load left Side Menu
        admin_menu(2,21);
        ?>
        
        <div id="page-wrapper" >
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;"><?php echo $lang['user_edit'];?></h1>
            <div class="row">
                <?php
                //ERROR AUSGABE
                if(!empty($error_msg)){
                    echo "<div class='alert alert-danger' role='alert'><h5>".$error_msg."</h5></div>";
                }
                if(!empty($report_msg)){
                    echo "<div class='alert alert-success' role='alert'><h5>".$report_msg."</h5></div>";
                }
                
                
                ?>
                
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $lang['user_edit_short'];?> <?php echo $select_data->username;?> 
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-4">
                                <div class="row text-center" style="margin-top: 10px;">
                                    <form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF'])."?id=".$userid; ?>" role="form">
                                        <input type="hidden" name="change" value="password">
                                        <button type="submit" class="btn btn-default"><?php echo $lang['user_reset_password'];?></button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF'])."?id=".$userid; ?>" role="form">
                                    <div class="form-group">
                                        <label for="username"><?php echo $lang['user_name'];?></label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="" value="<?php echo $select_data->username;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><?php echo $lang['user_email_adress'];?></label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="" value="<?php echo $select_data->email;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><?php echo $lang['user_permissions'];?></label>
                                        <input type="text" class="form-control" name="permission" id="permission" placeholder="" value="<?php echo $select_data->permission;?>">
                                    </div>
                                    <input type="hidden" name="change" value="main">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> <?php echo $lang['g_save'];?></button>
                                </form>
                                
                                                                 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <a href="#" class="btn btn-default"><i class="fa fa-trash"></i> <?php echo $lang['user_delete'];?></a>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daten
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td><?php echo $lang['user_last_login'];?>:</td>
                                    <td><?php echo function_mysql_date($select_data->date_last_login);?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $lang['user_date_register'];?></td>
                                    <td><?php echo function_mysql_date($select_data->date_register);?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $lang['user_activated'];?></td>
                                    <td><?php echo function_mysql_date($select_data->date_activate);?></td>
                                </tr>
                            </table>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

admin_footer("<script src='/js/sb-admin-2.js'></script>
<script src='/js/metisMenu/metisMenu.min.js'></script>");