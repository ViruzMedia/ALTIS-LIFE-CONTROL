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
include_once PROJECT_PATH.'/include/login/db_connect.php';
include_once PROJECT_PATH.'/include/login/db-config.php';
include_once PROJECT_PATH.'/include/login/functions.php';

function top_menu(){
    global $lang;
    global $mysqli;
    $permission = login_check($mysqli);
    if( $permission > 0) {
        $login_menu = " <li class='dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$lang["head_welcome"]. htmlentities($_SESSION['username']) ."<b class='caret'></b></a>
                            <ul class='dropdown-menu'>
                                <li>
                                    <a href='".PROJECT_URL."/user/index.php'>".$lang["head_user_controle"]."</a>
                                </li>
                                <li>
                                    <a href='".PROJECT_URL."/logout.php'>".$lang["g_logout"]."</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href='".PROJECT_URL."/statistic.php'>".$lang["g_stats"]."</a>
                        </li>
                        

";
    } else { 
        $login_menu = " <ul class='nav navbar-nav navbar-right'>
                            <li>
                                <a href='".PROJECT_URL."/register.php'>".$lang["register"]."</a>
                            </li>
                            <li>
                                <a href='".PROJECT_URL."/login.php'>".$lang["g_login"]."</a>
                            </li>
                            <li>
                                <a href='".PROJECT_URL."/statistic.php'>".$lang["g_stats"]."c</a>
                            </li>
                        </ul>";
    }
    if ($permission >= 10){
        $login_menu .= "<ul class='nav navbar-nav navbar-right'>
                            <li>
                                <a href='".PROJECT_URL."/admin/index.php'>".$lang["g_admin"]."</a>
                            </li>
                        </ul>";
    }
    echo "  
    <nav class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
        <div class='container'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' style='padding: 0; color: #fff;' href='".PROJECT_URL."/index.php'><img src='".PROJECT_URL."/img/logo_small.png'> Altis Life Control</a>
            </div>
            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav navbar-right'>
                    ".$login_menu."
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav> ";
} ?>
