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

//RELOAD AREA
if(isset($_POST['send_form'])){
    //RECAPTCH CHECK
    require_once('include/recaptchalib.php');
    $privatekey = "6LdvUfoSAAAAABsHl4epa0fVpKvstytRfwpSlkVI";
    $resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
        // What happens when the CAPTCHA was entered incorrectly
        $error_reset .= "Sicherheitscode nicht korrekt";
    } else { 
        //CHECK IF USERNAME IS SET
        if(empty($_POST['username']) && !isset($_POST['usernmae'])){
            $error_reset .= "Benutzername nicht eingegeben";
        }
        else
        {
            //CHECK IF USERNAME IN DATABASE
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $query = "SELECT * FROM ".MySQL_TABLE_PREFIX."alc_user WHERE `username`='".$username."'";
            $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

            // GOING THROUGH THE DATA
            // CHECK if User exist
            if($result->num_rows > 0) {
                
                //Check if more the one user with this name
		if($result->num_rows == 1){
                    while($row = $result->fetch_assoc()) {
                        $user_id = stripslashes($row['id']);	
                        $email = stripslashes($row['email']);
                    }
                    
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
                    if ($stmt = $mysqli->prepare("UPDATE ".MySQL_TABLE_PREFIX."alc_user SET password = ?, salt = ? WHERE id = ?")) {
                        $stmt->bind_param('ssi',$password, $random_salt, $user_id);
                        // Führe die vorbereitete Anfrage aus.
                        if (!$stmt->execute()) {
                            die(print $mysqli->error);
                            
                        }
                        $stmt->close();
                        
                    }
                    //SEND MAIL WITH NEW PASSWORD
                    $empfaenger = $email;
                    $betreff = 'Passwort Wiederherstellung';
                    $nachricht = "Hallo ".$username.",\n\nda du vermutlich dein Kennwort bei Servertester.de vergessen hast, wolltest du dir ein neues Kennwort zuschicken lassen.\nSolltest du kein neues Kennwort angefordert haben, ignoriere bitte diese E-Mail. \n\nDein neues Passwort lautet: ".$new_password."\n\nMit freundlichen Grüßen \nDein Team von Servertester.de\nhttp://www.Servertester.de";
                    $header = 'From: noreply@servertester.de' . "\r\n" .
                        'Reply-To: info@servertester.de' . "\r\n" .
                        'Content-type: text/plain; charset=utf-8' ."\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    mail($empfaenger, $betreff, $nachricht, $header);
                    
                    $password_restet_complete = TRUE;

                }
                else
                {
                    $error_reset .= "Zu viele Benutzer gefunden.";
                }
                
            }
            else {
		$error_reset .= "Benutzer nicht vorhanden";
            }
            
                        
        }
    }
}

