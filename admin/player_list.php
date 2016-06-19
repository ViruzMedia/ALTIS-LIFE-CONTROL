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

require_once 'include/player_list.inc.php';
admin_html_head($lang["player_list"], "<link href='".PROJECT_URL."/css/jquery.bootgrid.css' rel='stylesheet' type='text/css'>");

top_menu();

?>
<div class="container-fluid">
    <div class="row">
        <?php
        //Load left Side Menu
        admin_menu(3,31);
        ?>
        
        <div id="page-wrapper" >
            <h1 class="page-header" style="margin-top: 0; padding-top: 20px;">Benutzer</h1>
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
                            <?php echo $lang["player_all"];?>
                        </div>
                        <div class="panel-body">
                                <table class="table table-striped table-bordered" id="main_player" >
                                    <thead>
                                        <tr>
                                            <th data-column-id="uid" data-identifier="true" data-type="numeric">#</th>
                                            <th data-column-id="name" data-formatter="name"><?php echo $lang["g_player"];?></th>
                                            <th data-column-id="cash"><?php echo $lang["player_money_cash"];?></th>
                                            <th data-column-id="bankacc"><?php echo $lang["player_bankacc"];?></th>
                                            <th data-column-id="coplevel"><?php echo $lang["player_cop_level"];?></th>
                                            <th data-column-id="mediclevel"><?php echo $lang["player_medic_level"];?></th>
                                            <th data-column-id="adminlevel"><?php echo $lang["player_admin_level"];?></th>
                                            <th data-column-id="donatorlvl"><?php echo $lang["player_donator_level"];?></th>
                                            <th data-column-id="blacklist"><?php echo $lang["player_blacklisted"];?></th>
                                            <th data-column-id="arrested"><?php echo $lang["player_arrested"];?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($main_player_list->fetch()) {
                                            echo "<tr>";
                                            echo "<td>" . $r_uid . "</td>";
                                            echo "<td ><a href='/admin/player_edit.php?id=".$r_uid."'>" . $r_name . "</a></td>";
                                            echo "<td>" . money($r_cash) . "</td>";
                                            echo "<td>" . money($r_bankacc) . "</td>";
                                            echo "<td>" . $r_coplevel . "</td>";
                                            echo "<td>" . $r_mediclevel . "</td>";
                                            echo "<td>" . $r_adminlevel . "</td>";
                                            echo "<td>" . $r_donatorlvl . "</td>";
                                            echo "<td>" . $r_blacklist . "</td>";
                                            echo "<td>" . $r_arrested . "</td>";
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
    //$('#main_player').bootgrid();
    
    $(function ()
    {
        $('#main_player').bootgrid({
            formatters: {
                'name': function (column, row)
                {
                    return '<a href=\'player_edit.php?id=' + row['uid'] + '\'>' + row[column.id] + '</a>';
                    
                }
            }
        });
    });
</script>";
admin_footer("<script src='".PROJECT_URL."/js/sb-admin-2.js'></script>
<script src='".PROJECT_URL."/js/metisMenu/metisMenu.min.js'></script>".$js_url_table);
    