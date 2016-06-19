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
require_once PROJECT_PATH.'/include/login/db_connect.php';
require_once PROJECT_PATH.'/include/login/functions.php';
require_once PROJECT_PATH.'/include/functions.inc.php';


$extra_html = "<script type='text/JavaScript' src='js/sha512.js'></script> 
               <script type='text/JavaScript' src='js/forms.js'></script>";

sec_session_start();

if (login_check($mysqli) > 0 && !isset($_GET['success'])) {
    header('Location: login.php?success');
} else {
    $logged = 'out';
}

html_head("Login",$extra_html);
 


?>
<?php
//ADD MENU
top_menu();
    ?>  

    <div class="container" style="margin-top: 7%;">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bitte melde dich an</h3>
                    </div>
                    <div class="panel-body">
                        <?php 
                        // ERROR CHECK
                        if (isset($_GET['error'])) {
                            echo '<div class="alert alert-danger" role="alert">Fehler beim Login!</div>';
                        }
                        if (isset($_GET['success'])) {
                            echo '<div class="alert alert-info" role="info">Erfolgreich angemeldet!</div>';
                        }
                        else {
                        ?>
                        <!-- Login Form -->
                        <form role="form" action="include/login/process_login.php" method="post" name="login_form" autocomplete="on">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Benutzername" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Passwort" name="password" type="password" id="password">
                                </div>
                                <input type="submit" value="Login" onclick="formhash(this.form, this.form.password);" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
                        </form>
                        </div>
                        <div class="panel-footer">
                            <div class="btn-group btn-group-justified">
                                <a href="register.php" class="btn btn-default btn-block">Registrieren</a><a href="reset_password.php" class="btn btn-default btn-block">Passwort vergessen?</a>
                            </div>
                        </div>
                        <?php
                        //END ERFOLGREICH ANGEMELDET
                        }
                        ?>
                </div>
                
            </div>
        </div>
    </div>
<?php
footer("");


