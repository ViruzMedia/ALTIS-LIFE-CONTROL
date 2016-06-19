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

require_once PROJECT_PATH .'/include/functions.inc.php';

html_head("Profil", "");

//Load Menu
top_menu();

?>

<div class="container-fluid">
    <div class="row">
        <?php
        //Load left Side Menu
        menu_user(1,11);
        ?>
        
        <div id="page-wrapper" >
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;">Übersicht</h1>
            <div class="row placeholders">

            </div>
        </div>
    </div>
</div>





<?php
footer("<script src='".PROJECT_URL."/js/sb-admin-2.js'></script>
<script src='".PROJECT_URL."/js/metisMenu/metisMenu.min.js'></script>");
?>

