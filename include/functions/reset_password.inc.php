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

function reset_password($userid, $username, $email){
    global $mysqli;
    //CREATE NEW PASSWORD STRING
    $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ+-*#&@!?";
    $validCharNumber = strlen($validCharacters);
    $new_password = "";
    for ($i = 0; $i < 10; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $new_password .= $validCharacters[$index];
    }
    //HASH NEW PASSWORD

    $hash_password = hash('sha512', $new_password);

    //CREATE SALT                  
    $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

    // CREATE PASSWORD + SALT
    $password = hash('sha512', $hash_password . $random_salt);

    // UPDATE PASSWORD AND SALT IN DATABASE
    if ($stmt = $mysqli->prepare("UPDATE alc_user SET password = ?, salt = ? WHERE id = ?")) {
        $stmt->bind_param('ssi',$password, $random_salt, $userid);
        // Führe die vorbereitete Anfrage aus.
        
        if (!$stmt->execute()) {
            die(print $mysqli->error);

        }
        $stmt->close();
        
    }
    //SEND MAIL WITH NEW PASSWORD
    $empfaenger = $email;
    $betreff = 'Password Reset';
    $nachricht = "Hello ".$username.",\n\nyour password was generated again.\n\nYour new password is: ".$new_password."\n\nMit freundlichen Grüßen \nDein Team von Servertester.de\nhttp://www.Servertester.de";
    $header = 'From: '. $email_sender .'' . "\r\n" .
        'Reply-To: info@servertester.de' . "\r\n" .
        'Content-type: text/plain; charset=utf-8' ."\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($empfaenger, $betreff, $nachricht, $header);
    
    return TRUE;
}