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

    $select_data = $mysqli->query("SELECT * FROM ".MySQL_TABLE_PREFIX."alc_user LEFT JOIN ".MySQL_TABLE_PREFIX."user_profile ON ".MySQL_TABLE_PREFIX."alc_user.id = ".MySQL_TABLE_PREFIX."user_profile.uid WHERE ".MySQL_TABLE_PREFIX."alc_user.id = ".$userid);
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


    //
    // PROFIL DATEN
    //

    if($_POST["change"] == "profile"){

        if(!validate_date($_POST["birthday"]) && !empty($_POST["birthday"]) ){
            $birthday = date("Y-m-d",strtotime($select_data->birthday));
            $error_msg .= "Fehlerhaftes Geburtsdatum";
        }
        else {
            $birthday = date("Y-m-d",strtotime($_POST["birthday"]));
        }


        if(!validate_url($_POST["website"]) && !empty($_POST["website"])){
            $website = $select_data->website;
            $error_msg .= "Fehlerhafte URL";
        }
        else {
            $website = mysql_real_escape_string(trim($_POST["website"]));
        }

        $city = mysql_real_escape_string($_POST["city"]);
        $about = mysql_real_escape_string($_POST["about"]);
        $hobbies = htmlspecialchars(mysql_real_escape_string($_POST["hobbies"]));

        if(empty($error_msg)){
            $update_data = $mysqli->query("UPDATE ".MySQL_TABLE_PREFIX."alc_user_profile SET birthday = '".$birthday."', website = '".$website."', city = '".$city."', about = '".$about."', hobbies = '".$hobbies."' WHERE uid = ".$userid);

            if (!$update_data){
                die(print $mysqli->error);
            }
            else {
                $report_msg = "Benutzerprofil erfolgreich geändert";
            }
        }
    }


    //
    // SOCIALE DATA
    //

    if($_POST["change"] == "social"){

        // Facebook
        if (!validate_url($_POST["facebook"]) && !empty($_POST["facebook"])) {
            $facebook = $select_data->facebook;
            $error_msg .= "Fehlerhafte Facebook URL";
        } else {
            $facebook = mysql_real_escape_string(trim($_POST["facebook"]));
        }

        // Twitter
        if (!validate_url($_POST["twitter"]) && !empty($_POST["twitter"])) {
            $twitter = $select_data->twitter;
            $error_msg .= "Fehlerhafte Twitter URL";
        } else {
            $twitter = mysql_real_escape_string(trim($_POST["twitter"]));
        }

        // Google +
        if (!validate_url($_POST["googleplus"]) && !empty($_POST["googleplus"])) {
            $googleplus = $select_data->googleplus;
            $error_msg .= "Fehlerhafte Google+ URL";
        } else {
            $googleplus = mysql_real_escape_string(trim($_POST["googleplus"]));
        }

        // Steam
        if (!validate_url($_POST["steam"]) && !empty($_POST["steam"])) {
            $steam = $select_data->steam;
            $error_msg .= "Fehlerhafte Steam URL";
        } else {
            $steam = mysql_real_escape_string(trim($_POST["steam"]));
        }

        //Skype
        if(!empty($_POST["skype"])){
            $skype = mysql_real_escape_string($_POST["skype"]);
        }
        // Youtube
        if (!validate_url($_POST["youtube"]) && !empty($_POST["youtube"])) {
            $youtube = $select_data->youtube;
            $error_msg .= "Fehlerhafte Youtube URL";
        } else {
            $youtube = mysql_real_escape_string(trim($_POST["youtube"]));
        }

        // Twitch
        if (!validate_url($_POST["twitch"]) && !empty($_POST["twitch"])) {
            $twitch = $select_data->twitch;
            $error_msg .= "Fehlerhafte Twitch URL";
        } else {
            $twitch = mysql_real_escape_string(trim($_POST["twitch"]));
        }

        //GET DATA TO DATABASE

        if(empty($error_msg)){
            $update_data = $mysqli->query("UPDATE user_profile SET facebook = '".$facebook."', twitter = '".$twitter."', googleplus = '".$googleplus."', steam = '".$steam."', skype = '".$skype."', twitch = '".$twitch."' WHERE uid = ".$userid);

            if (!$update_data){
                die(print $mysqli->error);
            }
            else {
                $report_msg = "Benutzerprofil erfolgreich geändert";
            }
        }

    }
}

//GET DATA FOR FORM FROM DATABASE

$select_data = $mysqli->query("SELECT * FROM user LEFT JOIN user_profile ON user.id = user_profile.uid WHERE user.id = ".$userid);
if($select_data->num_rows != 1){
    $error_msg = "Unzureichende Ergebnisse gefunden";
}
$select_data = mysqli_fetch_object($select_data);


