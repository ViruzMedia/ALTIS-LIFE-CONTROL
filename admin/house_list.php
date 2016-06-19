<?php
/* 
 * Copyright (c) 2014, Pictureclass
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
    header('Location: '.PROJECT_URL.'/login.php');
}

require_once 'include/house_list.inc.php';
admin_html_head($lang["house_list"], "<link href='".PROJECT_URL."/css/jquery.bootgrid.css' rel='stylesheet' type='text/css'>");

top_menu();

?>
<div class="container-fluid">
    <div class="row">
        <?php
        //Load left Side Menu
        admin_menu(5,51);
        ?>
        
        <div id="page-wrapper" >
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;"><?php echo $lang['house_list'];?></h1>
            <!--<div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Neuste Spieler
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Benutername</th>
                                            <th>Aktiviert</th>
                                            <th>Datum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Neuste Benutzer
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Benutername</th>
                                            <th>Aktiviert</th>
                                            <th>Datum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Neuste Benutzer
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Benutername</th>
                                            <th>Aktiviert</th>
                                            <th>Datum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $lang['house_all'];?>
                        </div>
                        <div class="panel-body">
                                <table class="table table-striped table-bordered" id="main_house" >
                                    <thead>
                                        <tr>
                                            <th data-column-id="id" data-formatter="id" data-identifier="true" data-type="numeric">#</th>
                                            <th data-column-id="pid" ><?php echo $lang['g_owner'];?></th>
                                            <th data-column-id="pos"><?php echo $lang['house_position'];?></th>
                                            <th data-column-id="inventory"><?php echo $lang['g_inventory'];?></th>
                                            <th data-column-id="containers"><?php echo $lang['house_containers'];?></th>
                                            <th data-column-id="owned"><?php echo $lang['g_owned'];?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($main_house_list->fetch()) {
                                            echo "<tr>";
                                            echo "<td><a href='house_edit.php?id=".$r_id."'>" . $r_id . "</a></td>";
                                            //echo "<td><a href='player_edit.php?id=".$r_uid."'>" . $r_name . "</a></td>";
                                            echo "<td>" . $r_name . "</td>";
                                            echo "<td>" . $r_pos . "</td>";
                                            echo "<td>" . $r_inventory . "</td>";
                                            echo "<td>" . $r_containers . "</td>";
                                            echo "<td>" . $r_owned . "</td>";
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

    $('#main_house').bootgrid({

        formatters: {
            'id': function (column, row)
            {
                return '<a href=\'house_edit.php?id=' + row['id'] + '\'>' + row[column.id] + '</a>';

            }
        }
    });
   
</script>";
admin_footer("<script src='".PROJECT_URL."/js/sb-admin-2.js'></script>
<script src='".PROJECT_URL."/js/metisMenu/metisMenu.min.js'></script>".$js_url_table);
    