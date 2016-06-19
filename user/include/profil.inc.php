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

$userid = intval($_SESSION['userid']);
$error_msg = "";
$report_msg = "";

//Start Reload Area
if(!empty($_POST['change'])){

    //
    //GET DATA FOR CHANGES
    //

    $select_data = $mysqli->query("SELECT * FROM ".MySQL_TABLE_PREFIX."alc_user WHERE user.id = ".$userid);
    if($select_data->num_rows != 1){
        $error_msg = "Unzureichende Ergebnisse gefunden";
    }
    $select_data = mysqli_fetch_object($select_data);


    //
    // Formular Main (Benutzername und E-Mail
    //

    if($_POST['change'] == "main"){

        $username = mysql_real_escape_string($_POST["username"]);
        $email = mysql_real_escape_string($_POST["email"]);

        $update_data = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."alc_user SET username = '".$username."', email = '".$email."' WHERE id = ".$userid."");

        if (!$update_data){
            die(print $mysqli->error);
        }
        else {
            $report_msg = "Benutzerdaten erfolgreich geändert";
        }
    }


    //
    // Passwort zurücksetzen
    //

    if($_POST["change"] == "password"){

        if(!reset_password($userid, $select_data->username, $select_data->email)){
            $error_msg .= "Fehler bei Passwort Zurücksetzung";
        }
        else {
            $report_msg = "Passwort erfolgreich zurückgesetzt. Dem Benutzer wurde ein neues Passwort per E-Mail gesendet.";
        }

    }

}

//GET DATA FOR FORM FROM DATABASE

$select_data = $mysqli->query("SELECT * FROM ".MySQL_TABLE_PREFIX."alc_user WHERE user.id = ".$userid);
if($select_data->num_rows != 1){
    $error_msg = "Unzureichende Ergebnisse gefunden";
}
$select_data = mysqli_fetch_object($select_data);


