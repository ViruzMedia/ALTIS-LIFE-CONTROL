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
    header('Location: house_list.php');
}
if(ctype_digit($_GET['id']) == false){
    header('Location: house_list.php');
}
else{
    $id = $_GET['id'];
}

//Get Data from Database
$house_detail_SQL = $mysqli->query("SELECT id, pid, pos, inventory, containers, owned, name, uid FROM ".MySQL_TABLE_PREFIX."houses LEFT JOIN ".MySQL_TABLE_PREFIX."players ON ".MySQL_TABLE_PREFIX."houses.pid = ".MySQL_TABLE_PREFIX."players.playerid WHERE houses.id = ".$id."");
if(!$house_detail_SQL) {
    echo "Error: ".mysqli_error($mysqli)."<br>"; 
    exit();        
}
$row = mysqli_fetch_object($house_detail_SQL);

///////////////////////////////////////////////////////////////////////////
//////////////////////// START RELOAD AREA ////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//FORMULAR RELOAD
if (isset($_POST['type']) || !empty($_POST['type'])){
    
    //CHANGE OWNED
    if($_POST['type'] == "owned"){
        
        $type = mysqli_real_escape_string($mysqli, $_POST['type']);
        $value = mysqli_real_escape_string($mysqli, $_POST['color']);
        $value = intval($value);
        
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."houses SET ".$type." = '".$value."' WHERE id = '".$id."' ");
            if(!$update) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: house_edit.php?id='.$id.'');
            
    }
    
        
    //DELETE VEHICLE
    if($_POST['type'] == "delete"){
        
        $delete_house = $mysqli->query("DELETE FROM ".MySQL_TABLE_PREFIX."houses WHERE id = '".$id."' ");
            if(!$delete_house) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: house_list.php');
    }
}

//GET Reload

if(isset($_GET['change']) || !empty($_GET['change'])){
    
    //Check what to change
   
    //alive and active
    if($_GET['change'] == "owned"){
        
        $change = mysqli_real_escape_string($mysqli, $_GET['change']);
        $value = mysqli_real_escape_string($mysqli, intval($_GET['value']));
                
        // UPDATE DATABASE                
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."houses SET ".$change." = '".$value."' WHERE id = '".$id."' ");
        if(!$update) {
            echo "Error: ".mysqli_error($mysqli)."<br>"; 
            exit();        
        }
        header('Location: house_edit.php?id='.$id.'');
    }
    
    
    //Clear Inventory
    if($_GET['change'] == "inventory"){
        
        $change = mysqli_real_escape_string($mysqli, $_GET['change']);
                
        // UPDATE DATABASE                
        $update = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."houses SET ".$change." = '\"[]\"' WHERE id = '".$id."' ");
        if(!$update) {
            echo "Error: ".mysqli_error($mysqli)."<br>"; 
            exit();        
        }
        header('Location: house_edit.php?id='.$id.'');
    }
    
}

///////////////////////////////////////////////////////////////////////////
///////////////////////// END RELOAD AREA /////////////////////////////////
///////////////////////////////////////////////////////////////////////////


////////////////////
//DESIGN LEVEL
////////////////////


/////////////////////
//VEHICLE VALUES
/////////////////////

//Alive
if ($row->owned == 1) {
    $output_owned = "<a href='?id=".$id."&change=owned&value=0' class='btn btn-success' style='margin-right: 3px;'>".$lang['g_owned']."</a>";
}
else {
    $output_owned = "<a href='?id=".$id."&change=owned&value=1' class='btn btn-default' style='margin-right: 3px;'>".$lang['house_not_owned']."</a>";
}

//////////
//GEAR
//////////

//VEHICLE GEAR

/*
if(gear_convert($row->inventory)){
    $output_house_gear = gear_convert($row->inventory);
}
else{
    $output_house_gear = $lang['g_empty'];
}
*/
if($row->inventory != '"[]"'){
    $output_house_inventory = $row->inventory;
}
else{
    $output_house_inventory = $lang['g_empty'];
}

if($row->containers != '"[]"'){
    $output_house_containers = $row->containers;
}
else{
    $output_house_containers = $lang['g_empty'];
}

$output_position = $row->pos;











