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
    header('Location: vehicle_list.php');
}
if(ctype_digit($_GET['id']) == false){
    header('Location: vehicle_list.php');
}
else{
    $id = $_GET['id'];
}

//Get Data from Database
$vehicle_detail_SQL = $mysqli->query("SELECT id, side, classname, type, pid, alive, active, plate, color, inventory, name, uid FROM ".MySQL_TABLE_PREFIX."vehicles LEFT JOIN ".MySQL_TABLE_PREFIX."players ON ".MySQL_TABLE_PREFIX."vehicles.pid = ".MySQL_TABLE_PREFIX."players.playerid WHERE vehicles.id = ".$id."");
if(!$vehicle_detail_SQL) {
    echo "Error: ".mysqli_error($mysqli)."<br>"; 
    exit();        
}
$row = mysqli_fetch_object($vehicle_detail_SQL);

///////////////////////////////////////////////////////////////////////////
//////////////////////// START RELOAD AREA ////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//FORMULAR RELOAD
if (isset($_POST['type']) || !empty($_POST['type'])){
    
    //CHANGE COLOR
    if($_POST['type'] == "color"){
        
        $type = mysqli_real_escape_string($mysqli, $_POST['type']);
        $value = mysqli_real_escape_string($mysqli, $_POST['color']);
        $value = intval($value);
        
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."vehicles SET ".$type." = '".$value."' WHERE id = '".$id."' ");
            if(!$update) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: vehicle_edit.php?id='.$id.'');
            
    }
    
        
    //DELETE VEHICLE
    if($_POST['type'] == "delete"){
        
        $delete_vehicle = $mysqli->query("DELETE FROM ".MySQL_TABLE_PREFIX."vehicles WHERE id = '".$id."' ");
            if(!$delete_vehicle) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: vehicle_list.php');
    }
}

//GET Reload

if(isset($_GET['change']) || !empty($_GET['change'])){
    
    //Check what to change
   
    //alive and active
    if($_GET['change'] == "alive" || $_GET['change'] == "active"){
        
        $change = mysqli_real_escape_string($mysqli, $_GET['change']);
        $value = mysqli_real_escape_string($mysqli, intval($_GET['value']));
                
        // UPDATE DATABASE                
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."vehicles SET ".$change." = '".$value."' WHERE id = '".$id."' ");
        if(!$update) {
            echo "Error: ".mysqli_error($mysqli)."<br>"; 
            exit();        
        }
        header('Location: vehicle_edit.php?id='.$id.'');
    }
    
    
    //Clear Inventory
    if($_GET['change'] == "inventory"){
        
        $change = mysqli_real_escape_string($mysqli, $_GET['change']);
                
        // UPDATE DATABASE                
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."vehicles SET ".$change." = '\"[]\"' WHERE id = '".$id."' ");
        if(!$update) {
            echo "Error: ".mysqli_error($mysqli)."<br>"; 
            exit();        
        }
        header('Location: vehicle_edit.php?id='.$id.'');
    }
    
}

///////////////////////////////////////////////////////////////////////////
///////////////////////// END RELOAD AREA /////////////////////////////////
///////////////////////////////////////////////////////////////////////////



////////////////////
//SKINS
////////////////////

//Civilian Skin File
$echo_get_vehicle_img = $row->classname;


////////////////////
//DESIGN LEVEL
////////////////////


/////////////////////
//VEHICLE VALUES
/////////////////////

//Alive
if ($row->alive == 1) {
    $echo_alive = "<a href='?id=".$id."&change=alive&value=0' class='btn btn-success' style='margin-right: 3px;'>".$lang['vehicle_alive']."</a>";
}
else {
    $echo_alive = "<a href='?id=".$id."&change=alive&value=1' class='btn btn-default' style='margin-right: 3px;'>".$lang['vehicle_not_alive']."</a>";
}

//Active
if ($row->active == 1) {
    $echo_active = "<a href='?id=".$id."&change=active&value=0' class='btn btn-default' style='margin-right: 3px;'>".$lang['vehicle_active']."</a>";
}
else {
    $echo_active = "<a href='?id=".$id."&change=active&value=1' class='btn btn-success' style='margin-right: 3px;'>".$lang['vehicle_not_active']."</a>";
}

//////////
//GEAR
//////////

//VEHICLE GEAR

/*
if(gear_convert($row->inventory)){
    $output_vehicle_gear = gear_convert($row->inventory);
}
else{
    $output_vehicle_gear = $lang['g_empty'];
}
*/
if($row->inventory != '"[]"'){
    $output_vehicle_gear = $row->inventory;
}
else{
    $output_vehicle_gear = $lang['g_empty'];
}

////////////////
//VEHICLE DATA
////////////////

//Side
switch ($row->side){
    case "civ":
        $output_side = "<button type='button' class='btn btn-default' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-car fa-3x'></i>
                            <div>".$lang['g_civ']." ".$lang['g_vehicle']."</div>
                        </button> ";
        break;
    case "cop":
        $output_side = "<button type='button' class='btn btn-primary' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-cab fa-3x'></i>
                            <div>".$lang['g_cop']." ".$lang['g_vehicle']."</div>
                        </button> ";
        break;
    case "med":
        $output_side = "<button type='button' class='btn btn-danger' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-cab fa-3x'></i>
                            <div>".$lang['g_medic']." ".$lang['g_vehicle']."</div>
                        </button> ";
        break;
    default: 
        $output_side = "ERROR";
    
}

//Type
switch ($row->type){
    case "Car":
        $output_type = "<button type='button' class='btn btn-default' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-car fa-3x'></i>
                            <div>".$lang['vehicle_type_car']."</div>
                        </button> ";
        break;
    case "Air":
        $output_type = "<button type='button' class='btn btn-primary' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-plane fa-3x'></i>
                            <div>".$lang['vehicle_type_air']." ".$lang['g_vehicle']."</div>
                        </button> ";
        break;
    case "Ship":
        $output_type = "<button type='button' class='btn btn-danger' disabled='disabled' style='opacity: 1; width: 100%;'>
                            <i class='fa fa-ship fa-3x'></i>
                            <div>".$lang['vehicle_type_ship']."</div>
                        </button> ";
        break;
    default: 
        $output_type = "ERROR";
    
}











