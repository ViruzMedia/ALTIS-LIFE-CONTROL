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


// MAIN TABLE RESULT

$prep_stmt = "SELECT wantedID, wantedName, wantedCrimes, wantedBounty, active FROM ".MySQL_TABLE_PREFIX."wanted LEFT JOIN ".MySQL_TABLE_PREFIX."players ON ".MySQL_TABLE_PREFIX."wanted.wantedID = ".MySQL_TABLE_PREFIX."players.playerid WHERE wanted.active = 1";
$main_wanted_list = $mysqli->prepare($prep_stmt);
if(!$main_wanted_list) {
    echo "Error: ".mysqli_error($mysqli)."<br>"; 
    exit();        
}
$error_msg = "";
if ($main_wanted_list) {
    $main_wanted_list->execute();
    // hole Variablen von result.
    $main_wanted_list->bind_result($r_wantedid, $r_wantedName, $r_wantedCrimes, $r_wantedBounty, $r_active);
    //$main_vehicle_list->fetch();
    $main_wanted_list->store_result();
} else {
    $error_msg .= '<p class="error">Datenbankfehler</p>';
}
    