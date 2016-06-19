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

if(isset($_GET['email']) && isset($_GET['key'])){
    $error_msg = "";
    //Validierung der Daten
    $email = htmlspecialchars($_GET['email']);
    
    //Überprüfung ob E-Mail auch E-Mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // keine gültige E-Mail
        $error_msg = '<p class="error">Fehler bei der Aktivierung - Error 1</p>';
    }
    
    //Aktivierungsschlüssel
    $key = htmlspecialchars($_GET['key']);
    
    //Überprüfen ob key auch genau 10 Zeichen hat
    if(strlen($key)!= 10){
        //Sting länger oder kürzer als 10 Zeichen
        $error_msg = '<p class="error">Fehler bei der Aktivierung - Error 2</p>';
    }
    
    //Überprüfen ob String nur aus Zahlen und Buchstaben besteht
    if(ctype_alnum($key) == FALSE){
        //Key besteht nicht nur aus Zahlen und Buchstaben
        $error_msg = '<p class="error">Fehler bei der Aktivierung - Error 3</p>';
    }
    
    //Weiter in Datenbank
    if(empty($error_msg)){
        if ($stmt = $mysqli->prepare("SELECT id, activation_key, permission FROM ".MySQL_TABLE_PREFIX."alc_user WHERE email = ? LIMIT 1")) {
            $stmt->bind_param('s', $email);  // Bind "$username" to parameter.
            $stmt->execute();    // Führe die vorbereitete Anfrage aus.
            $stmt->store_result();

            // hole Variablen von result.
            $stmt->bind_result($user_id, $db_activation_key, $permission);
            $stmt->fetch();
        }
        
        //Prüfen ob Aktivierunsschlüssel stimmen
        if($db_activation_key != $key){
            $error_msg = '<p class="error">Fehler bei der Aktivierung - Error 4</p>';
        }
        
        //Prüfen ob Account schon aktiviert
        if($permission > 0){
            $error_msg = '<p class="error">Dein Account ist bereits aktiviert</p>';
        }
        
        //CHECK ob $error immer noch leer ist
        if(empty($error_msg)){
            
            //User aktivieren
            if ($update_stmt = $mysqli->prepare("UPDATE ".MySQL_TABLE_PREFIX."alc_user SET permission = 1, date_activate = now() WHERE id = ?")) {
                            $update_stmt->bind_param('i', $user_id);
                            // Führe die vorbereitete Anfrage aus.
                            if (!$update_stmt->execute()) {
                                die(print $mysqli->error);

                            }
                            $update_stmt->close();
                            $activation_complete = TRUE;  
            }
        
          
        }
        
    }
}