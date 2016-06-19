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

$prep_stmt = "SELECT id, side, classname, type, pid, alive, active, color, name, uid FROM ".MySQL_TABLE_PREFIX."vehicles LEFT JOIN ".MySQL_TABLE_PREFIX."players ON ".MySQL_TABLE_PREFIX."vehicles.pid = ".MySQL_TABLE_PREFIX."players.playerid";
$main_vehicle_list = $mysqli->prepare($prep_stmt);

if ($main_vehicle_list) {
    $main_vehicle_list->execute();
    // hole Variablen von result.
    $main_vehicle_list->bind_result($r_id, $r_side, $r_classname, $r_type, $r_pid, $r_alive, $r_active, $r_color, $r_name, $r_uid);
    //$main_vehicle_list->fetch();
    $main_vehicle_list->store_result();
} else {
    $error_msg .= '<p class="error">Datenbankfehler</p>';
}
    