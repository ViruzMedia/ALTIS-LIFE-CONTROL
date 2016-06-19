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

require_once 'include/user_list.inc.php';
admin_html_head($lang['g_user'], "<link href='/css/jquery.bootgrid.css' rel='stylesheet' type='text/css'>");

top_menu();

?>
<div class="container-fluid">
    <div class="row">
        <?php
        //Load left Side Menu
        admin_menu(2,21);
        ?>
        
        <div id="page-wrapper" >
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;"><?php echo $lang['g_users'];?></h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $lang['userlist_all'];?>
                        </div>
                        <div class="panel-body">
                            
                            <table class="table table-striped table-bordered" id="main_user" >
                                    <thead>
                                        <tr>
                                            <th data-column-id="id" data-identifier="true" data-type="numeric">#</th>
                                            <th data-column-id="username" data-formatter="username"><?php echo $lang['g_user'];?></th>
                                            <th data-column-id="email"><?php echo $lang['register_email'];?></th>
                                            <th data-column-id="permission"><?php echo $lang['user_permissions'];?></th>
                                            <th data-column-id="register"><?php echo $lang['user_date_register'];?></th>
                                            <th data-column-id="activate"><?php echo $lang['user_last_login'];?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($main_user_list->fetch()) {
                                            echo "<tr>";
                                            echo "<td>" . $r_id . "</td>";
                                            echo "<td ><a href='/admin/player_edit.php?id=".$r_id."'>" . $r_username . "</a></td>";
                                            echo "<td>" . $r_email . "</td>";
                                            echo "<td>" . $r_permission . "</td>";
                                            echo "<td>" . function_mysql_date($r_date_register) . "</td>";
                                            echo "<td>" . function_mysql_date($r_date_last_login) . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js_url_table = "<script>
    //$('#main_user').bootgrid();
    $(function ()
    {
        $('#main_user').bootgrid({
            formatters: {
                'username': function (column, row)
                {
                    return '<a href=\'user_edit.php?id=' + row['id'] + '\'>' + row[column.id] + '</a>';
                    //return '<a href=\'http://test.com/customer/' + row['id'] + '\'>' + row[column.id] + '</a>';
                }
            }
        });
    });
</script>";
admin_footer("<script src='/js/sb-admin-2.js'></script>
<script src='/js/metisMenu/metisMenu.min.js'></script>".$js_url_table);
    