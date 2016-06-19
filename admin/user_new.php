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

sec_session_start();

//Login Check
if(login_check($mysqli) < 10){
    header('Location: /login.php');
}

require_once 'include/user_new.inc.php';

admin_html_head($lang['user_new'], "");

top_menu();

?>
<div class="container-fluid">
    <div class="row">
        <?php
        //Load left Side Menu
        admin_menu(2,22);
        ?>
        
        <div id="page-wrapper" >
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;"><?php echo $lang['user_new'];?></h1>
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
                    <form role="form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
                            <fieldset>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="<?php echo $lang["register_username"];?>" name="username" type="text" id="username" autofocus>
                                        <span class="input-group-btn">
                                            <button id="username_" data-trigger="focus" type="button" class="btn btn-default" data-toggle="popover" data-container="body" title="<?php echo $lang["register_username"];?>" data-content="<?php echo $lang["register_username_desc"];?>"><span class="glyphicon glyphicon-info-sign" style="color: #00df00;"></span></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="<?php echo $lang["register_email"];?>" name="email" type="text" id="email">
                                        <span class="input-group-btn">
                                            <button id="email_" data-trigger="focus" type="button" class="btn btn-default" data-toggle="popover" data-container="body" title="<?php echo $lang["register_email"];?>" data-content="<?php echo $lang["register_email_desc"];?>"><span class="glyphicon glyphicon-info-sign" style="color: #00df00;"></span></button>
                                        </span>
                                    </div>
                                </div>
                                                                                              
                                <hr>
                                
                                <input type="submit" value="<?php echo $lang["register_submit"];?>" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php

admin_footer("<script src='/js/sb-admin-2.js'></script>
<script src='/js/metisMenu/metisMenu.min.js'></script>");