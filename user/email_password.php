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

include_once '../config.php';
include_once PROJECT_PATH.'/include/login/db_connect.php';
include_once PROJECT_PATH.'/include/login/db-config.php';
include_once PROJECT_PATH.'/include/login/functions.php';
include_once PROJECT_PATH.'/include/functions.inc.php';
include_once PROJECT_PATH.'/include/login/change_pswd.inc.php';
include_once PROJECT_PATH.'/include/login/change_email.inc.php';
include_once PROJECT_PATH.'/include/login/functions.php';
include_once PROJECT_PATH.'/include/login/db_connect.php';

sec_session_start();

//Login Check
if(login_check($mysqli) == 0){
    header('Location: ".PROJECT_URL."/login.php');
}

//
// HTML HEADER + EXTRA HTML
//
$extra_html = "<script type='text/JavaScript' src='".PROJECT_URL."/js/sha512.js'></script> 
               <script type='text/JavaScript' src='".PROJECT_URL."/js/forms.js'></script>";
html_head($lang["user_email_password"], $extra_html);

//Login Check



//Load Menu
top_menu();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-3">
            <div id="page-wrapper" >
                <h1 class="page-header" style="margin-top: 0; padding-top: 20px;"><?php echo $lang["user_email_password"];?></h1>
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $lang["user_change_email"];?></h3>
                            </div>
                            <div class="panel-body">
                                <?php 
                                // CHECK IF RELOAD COMPLETE
                                if (isset($email_cemail_complete)) {
                                    echo '<div class="alert alert-success" role="alert"><strong>'.$lang["user_changed_email"].'</strong><p>'.$lang["user_changed_email_string"].'</p></div>';
                                }
                                // ERROR CHECK
                                if (!empty($error_cemail_msg)) {
                                    echo '<div class="alert alert-danger" role="alert">'.$error_cemail_msg.'</div>';
                                }
                                ?>
                                <form role="form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="change_email">
                                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $lang["register_password"];?>" name="password" type="password" id="password">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $lang["user_change_new_email"];?>" name="new_email" type="email" id="new_email">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $lang["user_change_new_email_confirm"];?>" name="new_email_confirm" type="email" id="new_email_confirm">

                                        </div>
                                        <input type="button" value="<?php echo $lang["user_change_email"];?>" onclick="return change_email_hash(this.form, this.form.password, this.form.new_email, this.form.new_email_confirm);" class="btn btn-lg btn-success btn-block" />
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $lang["user_change_pswd"];?></h3>
                            </div>
                            <div class="panel-body">
                                <?php 
                                // CHECK IF RELOAD COMPLETE
                                if (isset($password_cpswd_complete)) {
                                    echo '<div class="alert alert-success" role="alert"><strong>'.$lang["user_change_pswd_success"].'</strong><p>'.$lang["user_change_pswd_string"].'</p></div>';
                                }
                                // ERROR CHECK
                                if (!empty($error_cpswd_msg)) {
                                    echo '<div class="alert alert-danger" role="alert">'.$error_cpswd_msg.'</div>';
                                }
                                ?>
                                <form role="form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="change_password">
                                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $lang["user_change_pswd_old"];?>" name="old_pswd" type="password" id="old_pswd">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $lang["user_change_pswd_new"];?>" name="new_pswd" type="password" id="new_pswd">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $lang["user_change_pswd_new_confirm"];?>" name="new_pswd_confirm" type="password" id="new_pswd_confirm">
                                        </div>
                                        <input type="button" value="<?php echo $lang["user_change_pswd"];?>" onclick="return change_pswd_hash(this.form, this.form.old_pswd, this.form.new_pswd, this.form.new_pswd_confirm);" class="btn btn-lg btn-success btn-block" />
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php
footer("<script src='".PROJECT_URL."/js/sb-admin-2.js'></script>
<script src='".PROJECT_URL."/js/metisMenu/metisMenu.min.js'></script>");
?>