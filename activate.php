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
require_once 'config.php';
include_once PROJECT_PATH.'/include/functions.inc.php';
include_once PROJECT_PATH.'/include/login/functions.php';
include_once PROJECT_PATH.'/include/login/db_connect.php';

//RELOAD AREA

include_once PROJECT_PATH.'/include/login/activate.inc.php';

sec_session_start();

//
// HTML HEADER + EXTRA HTML
//

html_head("Aktivierung", NULL);

//
//Load Menu
//
top_menu();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>E-Mail Aktivierung <small>Nur noch ein Schritt</small></h1>
            </div>
            
            <?php 
            //Überprüfen, ob User sich erst registriert hat, oder mit Freischaltungscode kommt
            if(empty($_GET)){
            ?>
            
                <div class="alert alert-warning" role="alert">
                    <p>Schade. Leider kannst du auf dieser Seite nichts machen. Bitte benutze den Link in deiner E-Mail um deinen Account freizuschalten oder <a href="/register.php">registriere dich</a>.</p>
                </div>
            
            <?php
            //ENDE IF
            }
            
            //Überprüfen ob Benuter von Registrierung kommt
            if(isset($_GET['register'])){
            
            ?>
                <div class="alert alert-success" role="alert">
                    <p>Vielen Dank für deine Registrierung. Wir haben zur Verifizierung deiner E-Mail Adresse eine E-Mail mit einem Aktivierungscode gesendet.<br>
                    Bitte klicke auf den Link in deiner E-Mail, um deinen Account zu aktivieren.</p>
                </div>
            <?php
            //END IF
            }
              
                        
            //Überprüfen ob Benuter von Mail kommt
            if(isset($_GET['email']) && isset($_GET['key'])){
            
                if(!empty($error_msg)){
                    echo '<div class="alert alert-warning" role="alert">'.$error_msg.'</div>';    
                }
                if(isset($activation_complete)){
                ?>  
                    <div class="alert alert-success" role="alert">
                        <p>Dein Account wurde erfolgreich aktiviert. Du kannst dich nun <a href="/login.php">einloggen</a>.</p>
                    </div>
            <?php
                }
            //END IF
            }
            
            //Prüfen auf andere GET Variablen
            
            if(!empty($_GET) && !isset($_GET['register']) && !isset($_GET['key']) && !isset($_GET['email'])){
            ?>
            
                <div class="alert alert-warning" role="alert">
                    <h1>Schade.</h1>
                </div>
            
            <?php
            //ENDE IF
            }
            ?>
        </div>
    </div>
</div>




<?php
//
//FOOTER
//
footer("");
