<?php
/* 
 * Copyright (c) 2015, Pictureclass
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

$select_settings = $mysqli->query("SELECT * FROM ".MySQL_TABLE_PREFIX."alc_settings");
        if($select_settings->num_rows != 1){
            $error_msg = "Unzureichende Ergebnisse gefunden";
        }
$select_settings = mysqli_fetch_object($select_settings);

//DEFINE OUTPUT
$output_top = "";
$output_staff = "";
//CHECK WHICH STATISTIC SHOULD BE DISPLAYED

if ($select_settings->statistic_cash == 1)
{
    
    // GET DATA
    $sql_select_cash = $mysqli->query("SELECT name, cash FROM ".MySQL_TABLE_PREFIX."players ORDER BY cash DESC LIMIT 5");
    if (!$sql_select_cash){
        die(print $mysqli->error);
    }
    
    // WORK WITH DATA
    
    $output_top .= "<div class='col-md-3'><div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>Am meisten Bargeld</h3>
                            </div><div class='panel-body'><table class='table table-striped table-condensed'><thead><tr><th>Name</th><th>Summe</th></tr></thead><tbody>";
    
    while ($row = mysqli_fetch_object($sql_select_cash)) {
        $output_top .= "<tr><td>".$row->name."</td><td>".money($row->cash)."</td></tr>";
    }
    
    $output_top .= "</table></div></div></div>";
}
if ($select_settings->statistic_bankacc == 1)
{
    // GET DATA
    $sql_select_bankacc = $mysqli->query("SELECT name, bankacc FROM ".MySQL_TABLE_PREFIX."players ORDER BY bankacc DESC LIMIT 5");
    if (!$sql_select_bankacc){
        die(print $mysqli->error);
    }
    
    // WORK WITH DATA
    
    $output_top .= "<div class='col-md-3'><div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>Reichster Bürger</h3>
                </div><div class='panel-body'><table class='table table-striped'><thead><tr><th>Name</th><th>Summe</th></tr></thead><tbody>";
    
    while ($row = mysqli_fetch_object($sql_select_bankacc)) {
        $output_top .= "</tbody><tr><td>".$row->name."</td><td>".money($row->bankacc)."</td></tr>";
    }
    
    $output_top .= "</table></div></div></div>";
}
if ($select_settings->statistic_cop == 1)
{
    // GET DATA
    $sql_select_cop = $mysqli->query("SELECT name, coplevel FROM ".MySQL_TABLE_PREFIX."players WHERE coplevel > '0' ORDER BY coplevel DESC ");
    if (!$sql_select_cop){
        die(print $mysqli->error);
    }
    
    // WORK WITH DATA
    
    $output_staff .= "<div class='col-md-3'><div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>Cops</h3>
                </div><div class='panel-body'><table class='table table-striped'><thead><tr><th>Name</th></tr></thead><tbody>";
    
    while ($row = mysqli_fetch_object($sql_select_cop)) {
        $output_staff .= "</tbody><tr><td>".$row->name."</td></tr>";
    }
    
    $output_staff .= "</table></div></div></div>";
}
if ($select_settings->statistic_medic == 1)
{
    // GET DATA
    $sql_select_medic = $mysqli->query("SELECT name, mediclevel FROM ".MySQL_TABLE_PREFIX."players WHERE mediclevel > '0' ORDER BY mediclevel DESC ");
    if (!$sql_select_medic){
        die(print $mysqli->error);
    }
    
    // WORK WITH DATA
    
    $output_staff .= "<div class='col-md-3'><div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>Medics</h3>
                </div><div class='panel-body'><table class='table table-striped'><thead><tr><th>Name</th></tr></thead><tbody>";
    
    while ($row = mysqli_fetch_object($sql_select_medic)) {
        $output_staff .= "</tbody><tr><td>".$row->name."</td></tr>";
    }
    
    $output_staff .= "</table></div></div></div>";
}
if ($select_settings->statistic_admin == 1)
{
    // GET DATA
    $sql_select_admin = $mysqli->query("SELECT name, adminlevel FROM ".MySQL_TABLE_PREFIX."players WHERE adminlevel > '0' ORDER BY adminlevel DESC ");
    if (!$sql_select_admin){
        die(print $mysqli->error);
    }
    
    // WORK WITH DATA
    
    $output_staff .= "<div class='col-md-3'><div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>Cops</h3>
                </div><div class='panel-body'><table class='table table-striped'><thead><tr><th>Name</th></tr></thead><tbody>";
    
    while ($row = mysqli_fetch_object($sql_select_admin)) {
        $output_staff .= "</tbody><tr><td>".$row->name."</td></tr>";
    }
    
    $output_staff .= "</table></div></div></div>";
}
if ($select_settings->statistic_gangs == 1)
{
    // GET DATA
    $sql_select_gangs = $mysqli->query("SELECT name, bank FROM ".MySQL_TABLE_PREFIX."gangs ORDER BY bank DESC LIMIT 5");
    if (!$sql_select_gangs){
        die(print $mysqli->error);
    }
    
    // WORK WITH DATA
    
    $output_top .= "<div class='col-md-3'><div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>Gangs</h3>
                </div><div class='panel-body'><table class='table table-striped'><thead><tr><th>Name</th><th>Bank</th></tr></thead><tbody>";
    
    while ($row = mysqli_fetch_object($sql_select_gangs)) {
        $output_top .= "</tbody><tr><td>".$row->name."</td><td>".money($row->bank)."</tr>";
    }
    
    $output_top .= "</table></div></div></div>";
}





    