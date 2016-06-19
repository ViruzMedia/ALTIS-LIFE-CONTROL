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
    header('Location: wanted_list.php');
}
if(ctype_digit($_GET['id']) == false){
    header('Location: wanted_list.php');
}
else{
    $id = $_GET['id'];
}

//Get Data from Database
$wanted_detail_SQL = $mysqli->query("SELECT * FROM ".MySQL_TABLE_PREFIX."wanted LEFT JOIN ".MySQL_TABLE_PREFIX."players ON ".MySQL_TABLE_PREFIX."wanted.wantedID = ".MySQL_TABLE_PREFIX."players.playerid WHERE wanted.wantedID = ".$id."");
if(!$wanted_detail_SQL) {
    echo "Error: ".mysqli_error($mysqli)."<br>";
    exit();        
}
$row = mysqli_fetch_object($wanted_detail_SQL);

///////////////////////////////////////////////////////////////////////////
//////////////////////// START RELOAD AREA ////////////////////////////////
///////////////////////////////////////////////////////////////////////////

//FORMULAR RELOAD
if (isset($_POST['type']) || !empty($_POST['type'])){
      
        
    //DELETE Wanted Record
    if($_POST['type'] == "delete"){
        
        $delete_wanted = $mysqli->query("DELETE FROM ".MySQL_TABLE_PREFIX."wanted WHERE wantedid = '".$id."' ");
            if(!$delete_wanted) {
                echo "fehler: ".mysqli_error($mysqli)."<br>"; 
                exit();        
            }
        header('Location: wanted_list.php');
    }
}

//GET Reload

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


////////////////////
//DESIGN LEVEL
////////////////////









