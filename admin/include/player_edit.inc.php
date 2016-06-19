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

if (!isset($_GET['id'])){
    header('Location: player_list.php');
}
if(ctype_digit($_GET['id']) == false){
    header('Location: player_list.php');
}
else{
    $uid = $_GET['id'];
}

//Get Data from Database
$player_detail_SQL = $mysqli->query("SELECT * FROM ".MySQL_TABLE_PREFIX."players WHERE uid = ".$uid."");
if(!$player_detail_SQL) {
    echo "fehler: ".mysqli_error($mysqli)."<br>"; 
    exit();        
}
$row = mysqli_fetch_object($player_detail_SQL);

///////////////////////////////////////////////////////////////////////////
//////////////////////// START RELOAD AREA ////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//FORMULAR RELOAD
if (isset($_POST['type']) || !empty($_POST['type'])){
    
    //CHANGE MONEY
    if($_POST['type'] == "cash" || $_POST['type'] == "bankacc"){
        
        $type = mysqli_real_escape_string($mysqli, $_POST['type']);
        $value = mysqli_real_escape_string($mysqli, $_POST['value']);
        $value = intval($value);
        
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."players SET ".$type." = '".$value."' WHERE uid = '".$uid."' ");
            if(!$update) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: player_edit.php?id='.$uid.'');
            
    }
    
    //CIV GEAR
    if($_POST['type'] == "civ_gear"){
        $civ_gear_value = mysqli_real_escape_string($mysqli, $_POST["civ_gear_value"]);
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."players SET civ_gear = '".$civ_gear_value."' WHERE uid = '".$uid."' ");
            if(!$update) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: player_edit.php?id='.$uid.'#civ_inventory');
    }
    
    //COP GEAR
    if($_POST['type'] == "cop_gear"){
        $cop_gear_value = mysqli_real_escape_string($mysqli, $_POST["cop_gear_value"]);
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."players SET cop_gear = '".$cop_gear_value."' WHERE uid = '".$uid."' ");
            if(!$update) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: player_edit.php?id='.$uid.'#cop_inventory');
    }
    
    //MEDIC GEAR
    if($_POST['type'] == "med_gear"){
        $med_gear_value = mysqli_real_escape_string($mysqli, $_POST["med_gear_value"]);
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."players SET med_gear = '".$med_gear_value."' WHERE uid = '".$uid."' ");
            if(!$update) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: player_edit.php?id='.$uid.'#med_inventory');
    }
    
    //DELETE PLAYER
    if($_POST['type'] == "delete"){
        $delete_player = $mysqli->query("DELETE FROM ".MySQL_TABLE_PREFIX."players WHERE uid = '".$uid."' ");
            if(!$delete_player) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        $pid = mysql_real_escape_string($mysqli, $_POST['playerid']);
        $delete_vehicle = $mysqli->query("DELETE FROM ".MySQL_TABLE_PREFIX."vehicles WHERE pid = '".$pid."' ");
            if(!$delete_vehicle) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: player_list.php');
    }
}

//GET Reload

if(isset($_GET['change']) || !empty($_GET['change'])){
    
    //Check what to change
    
    //licenses
    if($_GET['change'] == "civ_licenses" || $_GET['change'] == "cop_licenses" || $_GET['change'] == "med_licenses"){
        
        $change_license = mysqli_real_escape_string($mysqli, $_GET['type']);
        $value = mysqli_real_escape_string($mysqli, $_GET['value']);
        $license_type = mysqli_real_escape_string($mysqli, $_GET['change']);
        if($value == "false"){
            $new_license = "`".$change_license."`,0";
            $old_license = "`".$change_license."`,1";
        }
        elseif ($value == "true"){
            $new_license = "`".$change_license."`,1";
            $old_license = "`".$change_license."`,0";
        }
        else {
            echo "WRONG DATA";
            exit();
        }
                
        $new_license = str_replace($old_license, $new_license, $row->$license_type);
                
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."players SET ".$license_type." = '".$new_license."' WHERE uid = '".$uid."' ");
        if(!$update) {
            echo "fehler: ".mysqli_error($mysqli)."<br>"; 
            exit();        
        }
        header('Location: player_edit.php?id='.$uid.'#licenses');
        
    }
    //blacklist and arrested
    if($_GET['change'] == "arrested" || $_GET['change'] == "blacklist"){
        
        $change = mysqli_real_escape_string($mysqli, $_GET['change']);
        $value = mysqli_real_escape_string($mysqli, intval($_GET['value']));
                
        // UPDATE DATABASE                
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."players SET ".$change." = '".$value."' WHERE uid = '".$uid."' ");
        if(!$update) {
            echo "fehler: ".mysqli_error($mysqli)."<br>"; 
            exit();        
        }
        header('Location: player_edit.php?id='.$uid.'#licenses');
    }
    
    //LEVEL (COP, MEDIC, Admin & Donator)
    if($_GET['change'] == "coplevel" ||$_GET['change'] == "mediclevel" || $_GET['change'] == "adminlevel" || $_GET['change'] == "donatorlvl"){
        
        $change = mysqli_real_escape_string($mysqli, $_GET['change']);
        $value = mysqli_real_escape_string($mysqli, $_GET['value']);
        
        //CHECK IF VALUE = delete for extra mysqli querys
        if ($value == "delete"){
            $value = 0;
        }
        // UPDATE DATABASE                
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."players SET ".$change." = '".$value."' WHERE uid = '".$uid."' ");
        if(!$update) {
            echo "fehler: ".mysqli_error($mysqli)."<br>"; 
            exit();        
        }
        header('Location: player_edit.php?id='.$uid.'#licenses');
            
    }
    
    // MONEY (CASH AND BANKACC)
    
    if($_GET['change'] == "bankacc" || $_GET['change'] == "cash"){
        
        $change = mysqli_real_escape_string($mysqli, $_GET['change']);
        $value = mysqli_real_escape_string($mysqli, intval($_GET['value']));
        
        // UPDATE DATABASE                
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."players SET ".$change." = '".$value."' WHERE uid = '".$uid."' ");
        if(!$update) {
            echo "fehler: ".mysqli_error($mysqli)."<br>"; 
            exit();        
        }
        header('Location: player_edit.php?id='.$uid.'#licenses');
    }
    
}

///////////////////////////////////////////////////////////////////////////
///////////////////////// END RELOAD AREA /////////////////////////////////
///////////////////////////////////////////////////////////////////////////



////////////////////
//SKINS
////////////////////

//Civilian Skin File
$echo_get_skin_civ = $row->civ_gear;
if($echo_get_skin_civ == " \"[]\" ") {
    $echo_get_skin_civ = "U_C_Poloshirt_stripped";
}
else
{
    $echo_get_skin_civ = substr($echo_get_skin_civ,3);
    $echo_get_skin_civ = substr ($echo_get_skin_civ,0,strpos ($echo_get_skin_civ, "`"));
    if(empty($echo_get_skin_civ)){
        $echo_get_skin_civ = "U_C_Poloshirt_stripped";
    }
}

//Cop Skin File
$echo_get_skin_cop = $row->cop_gear;
if($echo_get_skin_cop == "\"[]\""){
    $echo_get_skin_cop = "not_a_cop";
}
else{
    $echo_get_skin_cop = "U_Rangemaster";
}

////////////////////
//DESIGN LEVEL
////////////////////

// COP LEVEL
if($row->coplevel < 7){
        $next_coplevel = "<a class='btn btn-xs btn-default' href='?id=".$uid."&change=coplevel&value=".($row->coplevel + 1)."'><i class='fa fa-plus'></i></a>";
    }
if($row->coplevel > 0){
    $pre_coplevel = "<a class='btn btn-xs btn-default' href='?id=".$uid."&change=coplevel&value=".($row->coplevel - 1)."'><i class='fa fa-minus'></i></a>
                    <a class='btn btn-xs btn-default' href='?id=".$uid."&change=coplevel&value=delete'><i class='fa fa-times'></i></a>
                    ";
}
if ($row->coplevel > 0){

    $echo_coplevel = "  <button type='button' class='btn btn-lg btn-primary' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-cab fa-3x'></i>
                            <div>".$lang["g_cop"].": ".$row->coplevel."</div>
                        </button> 
                        <div class='btn-group' style='margin-top: 5px;'>
                            ".@$next_coplevel."
                            ".@$pre_coplevel."
                        </div>
                        ";
}
else
{
    $echo_coplevel = "  <button type='button' class='btn btn-lg btn-default' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-cab fa-3x'></i>
                            <div>".$lang["player_level_noCop"]."</div>
                        </button> 
                        <div class='btn-group' style='margin-top: 5px;'>
                            ".@$next_coplevel."
                            ".@$pre_coplevel."
                        </div>
";
}

// MEDIC LEVEL
if($row->mediclevel < 5){
    $next_mediclevel = "<a class='btn btn-xs btn-primary' href='?id=".$uid."&change=mediclevel&value=".($row->mediclevel + 1)."'><i class='fa fa-plus'></i></a>";
}
if($row->mediclevel > 0){
    $pre_mediclevel = " <a class='btn btn-xs btn-warning' href='?id=".$uid."&change=mediclevel&value=".($row->mediclevel - 1)."'><i class='fa fa-minus'></i></a>
                        <a class='btn btn-xs btn-danger' href='?id=".$uid."&change=mediclevel&value=delete'><i class='fa fa-times'></i></a>
                    ";
}

if ($row->mediclevel > 0){
    $echo_mediclevel = "<button type='button' class='btn btn-lg btn-danger' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-heartbeat fa-3x'></i>
                            <div>".$lang["g_medic"].": ".$row->mediclevel."</div>
                        </button>
                        <div class='btn-group' style='margin-top: 5px;'>
                            ".@$next_mediclevel."
                            ".@$pre_mediclevel."
                      </div>
                    ";
}
else
{
    $echo_mediclevel = "<button type='button' class='btn btn-lg btn-default' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-heartbeat fa-3x'></i>
                            <div>".$lang["player_level_noMedic"]."</div>
                        </button> 
                        <div class='btn-group' style='margin-top: 5px;'>
                            ".@$next_mediclevel."
                            ".@$pre_mediclevel."
                        </div>
                       ";
}

// DONATOR LEVEL

//CREATING BUTTONS

if($row->donatorlvl < 5){
    $next_donatorlevel = "<a class='btn btn-xs btn-primary' href='?id=".$uid."&change=donatorlvl&value=".($row->donatorlvl + 1)."'><i class='fa fa-plus'></i></a>";
}
if($row->donatorlvl > 0){
    $pre_donatorlevel = " <a class='btn btn-xs btn-warning' href='?id=".$uid."&change=donatorlvl&value=".($row->donatorlvl - 1)."'><i class='fa fa-minus'></i></a>
                        <a class='btn btn-xs btn-danger' href='?id=".$uid."&change=donatorlvl&value=delete'><i class='fa fa-times'></i></a>
                    ";
}

//DISPLAY DONATORLEVEL
if ($row->donatorlvl > 0){
    $echo_donatorlevel = "  <button type='button' class='btn btn-lg btn-succsess' disabled='disabled' style='opacity: 1; width: 100%;'>
                                <i class='fa fa-dollar fa-3x'></i>
                                <div>".$lang["player_level_donator"].": ".$row->donatorlvl."</div>
                            </button> 
                            <div class='btn-group' style='margin-top: 5px;'>
                                ".@$next_donatorlevel."
                                ".@$pre_donatorlevel."
                            </div>
                            ";
}
else
{
    $echo_donatorlevel =  " <button type='button' class='btn btn-lg btn-default' disabled='disabled' style='opacity: 1; width: 100%;'>
                                <i class='fa fa-dollar fa-3x'></i>
                                <div>".$lang["player_level_noDonator"]."</div>
                            </button> 
                            <div class='btn-group' style='margin-top: 5px;'>
                                ".@$next_donatorlevel."
                                ".@$pre_donatorlevel."
                            </div>
                            ";
}
// ADMIN LEVEL

if($row->adminlevel < 3){
    $next_adminlevel = "<a class='btn btn-xs btn-primary' href='?id=".$uid."&change=adminlevel&value=".($row->adminlevel + 1)."'><i class='fa fa-plus'></i></a>";
}
if($row->adminlevel > 0){
    $pre_adminlevel = " <a class='btn btn-xs btn-warning' href='?id=".$uid."&change=adminlevel&value=".($row->adminlevel - 1)."'><i class='fa fa-minus'></i></a>
                        <a class='btn btn-xs btn-danger' href='?id=".$uid."&change=adminlevel&value=delete'><i class='fa fa-times'></i></a>
                    ";
}

//DISPLAY 
if($row->adminlevel > 0){
    $echo_adminlevel = "<button type='button' class='btn btn-lg btn-warning' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa  fa-user-secret fa-3x'></i>
                            <div>".$lang["g_admin"].": ".$row->adminlevel."</div>
                        </button> 
                        <div class='btn-group' style='margin-top: 5px;'>
                            ".@$next_adminlevel."
                            ".@$pre_adminlevel."
                        </div>
                       ";
}
else
{
    $echo_adminlevel = "<button type='button' class='btn btn-lg btn-default' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa  fa-user-secret fa-3x'></i>
                            <div>".$lang["player_level_noAdmin"]."</div>
                        </button> 
                        <div class='btn-group' style='margin-top: 5px;'>
                            ".@$next_adminlevel."
                            ".@$pre_adminlevel."
                        </div>
                       ";
}

/////////////////////
//MORE PLAYER VALUES
/////////////////////

//Arrested
if ($row->arrested == 1) {
    $echo_arrested = "<a href='?id=".$uid."&change=arrested&value=0' class='btn btn-danger' style='margin-right: 3px;'>".$lang["player_arrested"]."</a>";
}
else {
    $echo_arrested = "<a href='?id=".$uid."&change=arrested&value=1' class='btn btn-success' style='margin-right: 3px;'>".$lang["player_notArrested"]."</a>";
}

//Blacklisted
if ($row->blacklist == 1) {
    $echo_blacklist = "<a href='?id=".$uid."&change=blacklist&value=0' class='btn btn-danger' style='margin-right: 3px;'>".$lang["player_blacklistedn"]."</a>";
}
else {
    $echo_blacklist = "<a href='?id=".$uid."&change=blacklist&value=1' class='btn btn-success' style='margin-right: 3px;'>".$lang["player_notBlacklisted"]."</a>";
}
////////////
//Licenses
////////////

// CIV Licenses
//Format the String of the Licenses to a nice layout
$civ_licenses = array();
$civ_licenses = explode("],[", $row->civ_licenses);
$civ_licenses = str_replace("]]\"","",$civ_licenses);
$civ_licenses = str_replace("\"[[","",$civ_licenses);
$civ_licenses = str_replace("`","",$civ_licenses);
$civ_licenses = str_replace("license_civ_", "", $civ_licenses);

//CREATING OUTPUT        
$echo_civ_licenses_true = "";
$echo_civ_licenses_false = "";

for ( $x = 0; $x < count ($civ_licenses); $x++){

    if(strpos($civ_licenses[$x], "1")!==false){
        $echo_civ_licenses_true .= "<a href='?id=".$uid."&change=civ_licenses&type=license_civ_".substr($civ_licenses[$x],0,-2)."&value=false' class='btn btn-xs btn-success' style='margin-bottom: 5px; text-transform: uppercase;'>".substr($civ_licenses[$x],0,-2)."</a> ";    
    }
    else{
        $echo_civ_licenses_false .= "<a href='?id=".$uid."&change=civ_licenses&type=license_civ_".substr($civ_licenses[$x],0,-2)."&value=true' class='btn btn-xs btn-danger' style='margin-bottom: 5px; text-transform: uppercase;'>".substr($civ_licenses[$x],0,-2)."</a> "; 
    }

}

// COP Licenses
//Format the String of the Licenses to a nice layout
$cop_licenses = array();
$cop_licenses = explode("],[", $row->cop_licenses);
$cop_licenses = str_replace("]]\"","",$cop_licenses);
$cop_licenses = str_replace("\"[[","",$cop_licenses);
$cop_licenses = str_replace("`","",$cop_licenses);
$cop_licenses = str_replace("license_cop_", "", $cop_licenses);

//CREATING OUTPUT        
$echo_cop_licenses_true = "";
$echo_cop_licenses_false = "";

for ( $x = 0; $x < count ($cop_licenses); $x++){
    if(strpos($cop_licenses[$x], "1")!==false){
        $echo_cop_licenses_true .= "<a href='?id=".$uid."&change=cop_licenses&type=license_cop_".substr($cop_licenses[$x],0,-2)."&value=false' class='btn btn-xs btn-success' style='margin-bottom: 5px; text-transform: uppercase;'>".substr($cop_licenses[$x],0,-2)."</a> ";    
    }
    else{
        $echo_cop_licenses_false .= "<a href='?id=".$uid."&change=cop_licenses&type=license_cop_".substr($cop_licenses[$x],0,-2)."&value=true' class='btn btn-xs btn-danger' style='margin-bottom: 5px; text-transform: uppercase;'>".substr($cop_licenses[$x],0,-2)."</a> "; 
    }
}

//MEDIC LICENSES
//Format the String of the Licenses to a nice layout
$medic_licenses = array();
$medic_licenses = explode("],[", $row->med_licenses);
$medic_licenses = str_replace("]]\"","",$medic_licenses);
$medic_licenses = str_replace("\"[[","",$medic_licenses);
$medic_licenses = str_replace("`","",$medic_licenses);
$medic_licenses = str_replace("license_med_", "", $medic_licenses);

//CREATING OUTPUT
$echo_medic_licenses_true = "";
$echo_medic_licenses_false = "";
for ( $x = 0; $x < count ($medic_licenses); $x++){
    if(strpos($medic_licenses[$x], "1")!==false){
        $echo_medic_licenses_true .= "<a href='?id=".$uid."&change=med_licenses&type=license_med_".substr($medic_licenses[$x],0,-2)."&value=false' class='btn btn-xs btn-success' style='margin-bottom: 5px; text-transform: uppercase;'>".substr($medic_licenses[$x],0,-2)."</a> ";    
    }
    else{
        $echo_medic_licenses_false .= "<a href='?id=".$uid."&change=med_licenses&type=license_med_".substr($medic_licenses[$x],0,-2)."&value=true' class='btn btn-xs btn-danger' style='margin-bottom: 5px; text-transform: uppercase;'>".substr($medic_licenses[$x],0,-2)."</a> "; 
    }
}

//////////
//////GEAR
//////////

//CIV GEAR

$output_civ_gear = gear_convert($row->civ_gear);
$output_civ_gear = str_replace(",", "<br>", $output_civ_gear);

//COP Gear

$output_cop_gear = gear_convert($row->cop_gear);
$output_cop_gear = str_replace(",", "<br>", $output_cop_gear);

//Medic Gear

$output_med_gear = gear_convert($row->cop_gear);
$output_med_gear = str_replace(",", "<br>", $output_med_gear);


//SELECT GANG

$query_gang = $mysqli->query("SELECT name, id FROM ".MySQL_TABLE_PREFIX."gangs WHERE members LIKE '%".$row->uid."%'");

if(!$query_gang) {
    echo "fehler: ".mysqli_error($mysqli)."<br>"; 
    exit();        
}

if (mysqli_num_rows($query_gang) == 0){
    $output_gang = "-";
}
else{
    $output_gang = mysqli_fetch_object($query_gang);
}
    
    
//VEHICLES
    
$vehicle_SQL = $mysqli->query("SELECT * FROM ".MySQL_TABLE_PREFIX."vehicles WHERE pid = ".$row->playerid." ORDER BY side");
if(!$vehicle_SQL) {
    echo "fehler: ".mysqli_error($mysqli)."<br>"; 
    exit();        
}
$count_vehicles = mysqli_num_rows($vehicle_SQL);   
    
//COUNT HOUSES

$houses_SQL = $mysqli->query("SELECT * FROM ".MySQL_TABLE_PREFIX."houses WHERE pid = ".$row->playerid."");
if(!$houses_SQL) {
    echo "fehler: ".mysqli_error($mysqli)."<br>"; 
    exit();        
}
$count_houses = mysqli_num_rows($houses_SQL);   

//CHECK IF WANTED

$wanted_sql = $mysqli->query("SELECT * FROM ".MySQL_TABLE_PREFIX."wanted WHERE wantedID = ".$row->playerid." ");
if(!$wanted_sql) {
    echo "fehler: ".mysqli_error($mysqli)."<br>"; 
    exit();        
}

if(mysqli_num_rows($wanted_sql) < 1){
    $output_wanted = "<a href='#' class='btn btn-success'>".$lang["player_notWanted"]."</a>";
}
else {
    $wanted = mysqli_fetch_object($wanted_sql); 

    if($wanted->active == 1){
        $output_wanted = "<a href='wanted_edit.php?id=".$row->playerid."' class='btn btn-danger' style='margin-right: 3px;'>".$lang["player_wanted"]." - ".money($wanted->wantedBounty).currency()."</a>";
    }
    else {
        $output_wanted = "<a href='#' class='btn btn-warning'>".$lang["player_notWanted"]."</a>";
    }
}





