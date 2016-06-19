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

$prep_stmt = "SELECT uid, name, cash, bankacc, coplevel, mediclevel, adminlevel, donatorlvl, blacklist, arrested FROM ".MySQL_TABLE_PREFIX."players";
$main_player_list = $mysqli->prepare($prep_stmt);

if ($main_player_list) {
    $main_player_list->execute();
    // hole Variablen von result.
    $main_player_list->bind_result($r_uid, $r_name, $r_cash, $r_bankacc, $r_coplevel, $r_mediclevel, $r_adminlevel, $r_donatorlvl, $r_blacklist, $r_arrested);
    //$main_player_list->fetch();
    $main_player_list->store_result();
} else {
    $error_msg .= '<p class="error">Database Error</p>';
}
    