<?php

/* 
 * Copyright (c) 2016, Pictureclass
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
include_once 'config.php';
include_once PROJECT_PATH.'/include/login/db_connect.php';
include_once PROJECT_PATH.'/include/login/db-config.php';
include_once PROJECT_PATH.'/include/login/functions.php';
include_once PROJECT_PATH.'/include/functions.inc.php';

sec_session_start();

//RELOAD AREA
if(isset($_POST['send_form'])){
    include_once PROJECT_PATH.'/include/login/reset_password.inc.php';
}

html_head("Passwort vergessen?",NULL);

//ADD MENU
top_menu();
    ?> 
      
    <div class="container" style="margin-top: 8%;">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Passwort wiederherstellung</h3>
                    </div>
                    <div class="panel-body">
                        <?php 
                        // CHECK IF RELOAD COMPLETE
                        if (isset($password_restet_complete)) {
                            echo '<div class="alert alert-success" role="alert"><strong>Passwort zurückgesetzt</strong><p> Dein Passwort wurde erfolgreich zurückgesetzt und ein neues Passwort an deine hinterlegte E-Mail Adresse gesendet.<br>Du kannst dich nun wieder <a href="login.php" class="alert-link">anmelden</a></p></div>';
                        }
                        // ERROR CHECK
                        if (isset($error_reset)) {
                            echo '<div class="alert alert-danger" role="alert">'.$error_reset.'</div>';
                        }
                        
                        ?>
                        <!-- E-Mail Form -->
                        <form role="form" action="reset_password.php" method="post" name="login_form">
                            <p>Um dein Passwort zurückzusetzen, geben deinen Benutzernamen ein. Es wird dir dann ein neues Passwort an deine hinterlegte E-Mail Adresse gesendet.</p>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Benutzername" name="username" autofocus>
                                </div>
                                <input type="hidden" name="send_form">
                                
                                <?php
                                //RECAPATCHA
                                require_once('include/recaptchalib.php');
                                $publickey = "6LdvUfoSAAAAABxD8plqQf9tZPStwSVjpthM7tBb"; // you got this from the signup page
                                echo recaptcha_get_html($publickey);
                                
                                ?>
                                
                                <input type="submit" value="Passwort zurücksetzen" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
                        </form>
                        </div>
                        <div class="panel-footer">
                            <div class="btn-group btn-group-justified">
                                <a href="register.php" class="btn btn-default btn-block">Registrieren</a><a href="login.php" class="btn btn-default btn-block">Login</a>
                            </div>
                        </div>
                    
                </div>
                
            </div>
        </div>
    </div>