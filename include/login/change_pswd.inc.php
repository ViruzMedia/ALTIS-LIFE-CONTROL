<?php

/* 
 * Copyright (c) 2014, Servertester.de - Pictureclass
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

include_once 'db_connect.php';
include_once 'db-config.php';
 
$error_cpswd_msg = "";
 
if (isset($_POST['p_old'], $_POST['p_new'], $_POST['p_new_c'], $_POST['user_id'])) {
    
    // Bereinige und überprüfe die Daten
    $user_id = intval($_SESSION['userid']); 
    $old_pswd = filter_input(INPUT_POST, 'p_old', FILTER_SANITIZE_STRING);
    $new_pswd = filter_input(INPUT_POST, 'p_new', FILTER_SANITIZE_STRING);
    $new_pswd_c = filter_input(INPUT_POST, 'p_new_c', FILTER_SANITIZE_STRING);
    
    // Das gehashte Passwort sollte 128 Zeichen lang sein.
    // Wenn nicht, dann ist etwas sehr seltsames passiert
    if (strlen($old_pswd) != 128) {
        $error_cpswd_msg .= '<p class="error">'.$lang["user_change_pswd_error_1"].'</p>';
    }
    if (strlen($new_pswd) != 128) {
        $error_cpswd_msg .= '<p class="error">'.$lang["user_change_pswd_error_1"].'</p>';
    }
    if (strlen($new_pswd_c) != 128) {
        $error_cpswd_msg .= '<p class="error">'.$lang["user_change_pswd_error_1"].'</p>';
    }
    
    //Überprüfen ob das alte Passwort korrekt ist
    if (check_pswd($user_id, $old_pswd, $mysqli) != true){
        
        $error_cpswd_msg .= '<p class="error">'.$lang["user_change_pswd_error_2"].'</p>';
           
    }
    
    //WENN KOREKT DANN...
    if(empty($error_cpswd_msg)){
        //WENN KEINE ERROR

        //CREATE SALT                  
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // CREATE PASSWORD + SALT
        $password = hash('sha512', $new_pswd . $random_salt);
        
        // UPDATE PASSWORD AND SALT IN DATABASE
        if ($stmt = $mysqli->prepare("UPDATE ".MySQL_TABLE_PREFIX."alc_user SET password = ?, salt = ? WHERE id = ?")) {
            $stmt->bind_param('ssi',$password, $random_salt, $user_id);
            // Führe die vorbereitete Anfrage aus.
            if (!$stmt->execute()) {
                die(print $mysqli->error);

            }
            $stmt->close();
            $password_cpswd_complete = TRUE;
        }
     }
} 

