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
 
$error_cemail_msg = "";
 
if (isset($_POST['p'], $_POST['e_new'], $_POST['e_new_c'], $_POST['user_id'])) {
    
    // Bereinige und überprüfe die Daten
    $user_id = intval(preg_replace("/[^0-9]+/", "", $_SESSION['userid'])); 
    $pswd = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    $new_email = filter_input(INPUT_POST, 'e_new', FILTER_SANITIZE_EMAIL);
    $new_email_c = filter_input(INPUT_POST, 'e_new_c', FILTER_SANITIZE_EMAIL);
    
    if(empty($new_email) || empty($new_email_c)){
        $error_cemail_msg .= '<p class="error">'.$lang["user_change_email_error_1"].'</p>';
    }
    
    if(empty($new_email_c)){
        $error_cemail_msg .= '<p class="error">'.$lang["user_change_email_error_2"].'</p>';
    }
    
    //Prüfen ob die E-Mail Adresse valide ist
    if(filter_var($new_email, FILTER_VALIDATE_EMAIL) == false){
        $error_cemail_msg .= '<p class="error">'.$lang["user_change_email_error_3"].'</p>';  
    }
    if(filter_var($new_email_c, FILTER_VALIDATE_EMAIL) == false){
        $error_cemail_msg .= '<p class="error">'.$lang["user_change_email_error_3"].'</p>';  
    }
    
    
    // Das gehashte Passwort sollte 128 Zeichen lang sein.
    // Wenn nicht, dann ist etwas sehr seltsames passiert
    if (strlen($pswd) != 128) {
        $error_cemail_msg .= '<p class="error">'.$lang["user_change_pswd_error_1"].'</p>';
    }
        
    //Überprüfen ob das alte Passwort korrekt ist
    if (check_pswd($user_id, $pswd, $mysqli) != true){
        
        $error_cemail_msg .= '<p class="error">'.$lang["user_change_pswd_error_3"].'</p>';
           
    }
    
    //Überprüfen ob E-Mail Adressen übereinstimmen
    
    if ($new_email != $new_email_c){
        $error_cemail_msg .= '<p class="error">'.$lang["user_change_pswd_error_4"].'</p>';
    }
    
    //WENN KOREKT DANN...
    if(empty($error_cemail_msg)){
        //WENN KEINE ERROR

               
        // UPDATE EMAIL IN DATABASE
        if ($stmt = $mysqli->prepare("UPDATE ".MySQL_TABLE_PREFIX."alc_user SET email = ? WHERE id = ?")) {
            $stmt->bind_param('si',$new_email, $user_id);
            // Führe die vorbereitete Anfrage aus.
            if (!$stmt->execute()) {
                die(print $mysqli->error);

            }
            $stmt->close();
            $email_cemail_complete = TRUE;
        }
     }
} 

