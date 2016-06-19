<?php

/* 
 * Copyright (c) 2014, Pictureclass.de - Pictureclass
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

$error_msg = "";
 
if (isset($_POST['username'], $_POST['email'])) {
    
     
    // Bereinige und überprüfe die Daten
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // keine gültige E-Mail
        $error_msg .= '<p class="error">Die von dir eingegebene E-Mail Adresse ist nicht korrekt</p>';
    }
 
    
 
    $prep_stmt = "SELECT id FROM user WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // Ein Benutzer mit dieser E-Mail-Adresse existiert schon
            $error_msg .= '<p class="error">Ein Benuter mit dieser E-Mail Adresse existiert bereits</p>';
        }
    } else {
        $error_msg .= '<p class="error">Datenbankfehler</p>';
    }
    
    //CHECK IF USER EXIST
    
    $prep_stmt = "SELECT id FROM user WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // Ein Benutzer mit dieser E-Mail-Adresse existiert schon
            $error_msg .= '<p class="error">Ein Benuter mit diesem Namen existiert bereits</p>';
        }
    } else {
        $error_msg .= '<p class="error">Datenbankfehler</p>';
    }
    
    // Noch zu tun: 
    // Wir müssen uns noch um den Fall kümmern, wo der Benutzer keine
    // Berechtigung für die Anmeldung hat indem wir überprüfen welche Art 
    // von Benutzer versucht diese Operation durchzuführen.
 
    if (empty($error_msg)) {
        
        //Key generieren
        $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ0123456789";
        $validCharNumber = strlen($validCharacters);
        $password = "";
        for ($i = 0; $i < 10; $i++) {
            $index = mt_rand(0, $validCharNumber - 1);
            $password .= $validCharacters[$index];
        }
        
        $password_email = $password;

        // Erstelle ein zufälliges Salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Erstelle saltet Passwort 
        $password = hash('sha512', $password . $random_salt);
 
        // Trage den neuen Benutzer in die Datenbank ein 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO ".MySQL_TABLE_PREFIX."user (username, email, password, salt, permission, date_register) VALUES (?, ?, ?, ?, 10, NOW() )")) {
            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
            // Führe die vorbereitete Anfrage aus.
            
            if (!$insert_stmt->execute()) {
                die(print $mysqli->error);
            }
        }
        $user_id = $mysqli->insert_id;
        
        
        //Willkommensmail mit Password
        
        $email_text = 
"Hallo ".$username.",
vielen Dank, dass du dich auf www.Servertester.de registriert hast.
Bevor dein Benutzerkonto aktiviert und deine Registrierung abgeschlossen werden kann, musst du noch einen letzten Schritt unternehmen.

Bitte beachte, dass dieser Schritt zwingend notwendig ist, um ein registrierter Benutzer zu werden. Du musst den Link unten nur ein einziges Mal aufrufen, um dein Benutzerkonto zu aktivieren.

Dein Benutzername lautet: ".$username."
Dein Password lautet: ".$password_email."

**** Gibt es Probleme mit dem Link oben? ****\n
Kontaktiere bitte den Webmaster unter dieser E-Mail-Adresse: info@servertester.de

Mit freundlichen Grüßen
Dein Servertester.de Team
www.Servertester.de";

        $empfaenger = $email;
        $betreff = 'Aktivierung auf Servertester.de';
        
        $header = 'From: ' . $email_sender . "\r\n" .
                        'Reply-To: '. $email_sender . "\r\n" .
                        'Mime-Version: 1.0' ."\r\n" .
                        'Content-type: text/plain; charset=utf-8' ."\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    mail($empfaenger, $betreff, $email_text, $header);
                
        header('Location: ./user_list.php');
    }
}
