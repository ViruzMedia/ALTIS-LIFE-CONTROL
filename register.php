<?php

/* 
 * Copyright (c) 2016 Pictureclass
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
require_once 'config.php';
include_once PROJECT_PATH.'/include/functions.inc.php';
include_once PROJECT_PATH.'/include/login/register.inc.php';
include_once PROJECT_PATH.'/include/login/functions.php';
$extra_html = "<script type='text/JavaScript' src='js/sha512.js'></script> 
               <script type='text/JavaScript' src='js/forms.js'></script>
               <script type='text/JavaScript' src='js/popover.js'></script>
               <script type='text/JavaScript' src='js/tooltip.js'></script>";

html_head($lang["register"], $extra_html);
//ADD MENU
top_menu();
?>  

    <div class="container" style="margin-top: 10%;">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $lang["register"];?></h3>
                    </div>
                    <div class="panel-body">
                        <?php 
                        // ERROR CHECK
                        if (!empty($error_msg)) {
                            echo '<div class="alert alert-danger" role="alert">'.$error_msg.'</div>';
                        }
                        
                        ?>
                        <!-- Login Form -->
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
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="<?php echo $lang["register_password"];?>" name="password" type="password" id="password">
                                        <span class="input-group-btn">
                                            <button id="pswd" type="button" data-trigger="focus" class="btn btn-default" data-toggle="popover" data-container="body" title="<?php echo $lang["register_password"];?>" data-content="<?php echo $lang["register_password_desc"];?>"><span class="glyphicon glyphicon-info-sign" style="color: #00df00;"></span></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="<?php echo $lang["register_password_2"];?>" name="confirmpwd" type="password" id="confirmpwd">
                                        <span class="input-group-btn">
                                            <button id="pswd_repeat" data-trigger="focus" type="button" class="btn btn-default" data-toggle="popover" data-container="body" title="<?php echo $lang["register_password_2"];?>" data-content="<?php echo $lang["register_password_2_desc"];?>"><span class="glyphicon glyphicon-info-sign" style="color: #00df00;"></span></button>
                                        </span>
                                    </div>
                                </div>
                                
                                <?php 
                                if ($reCaptcha = 1) {
                                    require_once(PROJECT_PATH.'/include/recaptchalib.php');
                                    $publickey = $reCaptcha_public_key; // you got this from the signup page
                                    echo recaptcha_get_html($publickey);
                                }
                                else {
                                    echo "<input type='hidden' name='recaptcha_challenge_field' value='jap' />";
                                    echo "<input type='hidden' name='recaptcha_response_field' value='jap' />";
                                }
                                ?>
                                <hr>
                                
                                <input type="button" value="<?php echo $lang["register_submit"];?>" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
                        </form>
                        </div>
                        <div class="panel-footer">
                            <div class="btn-group btn-group-justified">
                                <a href="login.php" class="btn btn-default btn-block"><?php echo $lang["g_login"];?></a><a href="reset_password.php" class="btn btn-default btn-block"><?php echo $lang["register_reset_password"];?></a>
                            </div>
                        </div>
                    
                </div>
                
            </div>
        </div>
    </div>
<script>  
$(function ()  
{ $('#username_').popover();  
  $('#email_').popover();  
  $('#pswd').popover();  
  $('#pswd_repeat').popover();  
});  
</script> 

<?php
footer("");?>

