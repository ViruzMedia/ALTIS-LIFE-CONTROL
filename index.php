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
include_once PROJECT_PATH.'/include/login/db_connect.php';
include_once PROJECT_PATH.'/include/login/functions.php';
sec_session_start();
require_once PROJECT_PATH.'/include/functions.inc.php';



html_head("Start",NULL);
?>

<?php
//Load Menu
top_menu();
?>
<div class="container" style="padding-top: 60px;">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php">Start</a></li>
        </ol>
    </div>
    <div class="jumbotron">
        <h1>Hello, Civilist of Altis!</h1>
        <p>You can watch here your ingame Inventory, your Houses and your Cars, Helicopters and Boats. <br>
            Plan your next Travel on Altis, even if your are offline. Here you can watch your ingame inventory, your houses and your vehicles. <br>
            Plan your next tour on Altis, even if you are offline.</p>
        <form method="post" action="player.php" role="form" >
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter your Steam ID here" name="steam_id" >
                <span class="input-group-btn">
                    <button class="btn btn-success" type="submit" >Get Your Data!</button>
                </span>
                
            </div>
        </form>
        <p><a class="btn btn-default" href="steam_id.php" role="button">How to find your Steam User ID</a></p>
</div>
</div>

<!-- Footer -->
<?php
$extra_html_footer = "";
footer($extra_html_footer);
?>