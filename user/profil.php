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
if(login_check($mysqli) == 0){
    header('Location: /login.php');
}

require_once PROJECT_PATH.'/user/include/profil.inc.php';
admin_html_head("Profil bearbeiten", "");

top_menu();

?>
<div class="container-fluid">
    <div class="row">
        <?php
        //Load left Side Menu
        menu_user(3,31);
        ?>
        
        <div id="page-wrapper" >
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;">Profil bearbeiten</h1>
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
                            Benuter <?php echo $select_data->username;?> bearbeiten
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daten
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>Letzter Login:</td>
                                    <td><?php echo function_mysql_date($select_data->date_last_login);?></td>
                                </tr>
                                <tr>
                                    <td>Angemeldet seid:</td>
                                    <td><?php echo function_mysql_date($select_data->date_register);?></td>
                                </tr>
                            </table>
                        </div>   
                    </div>    
                </div>
                <div class="col-lg-3">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php

admin_footer("<script src='/js/sb-admin-2.js'></script>
<script src='/js/metisMenu/metisMenu.min.js'></script>");