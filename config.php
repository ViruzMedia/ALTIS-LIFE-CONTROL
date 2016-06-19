<?php
/* 
 * Copyright (c) 2016 Pictureclass
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

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// MYSQL SETTINGS /////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

$dbhost = "localhost";          	//Database IP or Domain
$dbname = "DBNAME";               	//Database Name
$dbuser = "DBUSER";                 //Database User with writing rights
$dbpswd = "DBPSWD";               	//Database User Password
$db_prefix = "";                    //If you use Prefixes for your Tablenames, setup the prefix here. Example: If your table Name is al_vehicle, $db_prefix must be "al_"

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// SETTINGS /////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

$settings_money_format = "EUR";             // EUR or US as Value

//reCaptch maybe later
$reCaptcha             = 1;                 // User reCaptch for registration? 1 = YES, 0 = NO Required https://www.google.com/recaptcha/
$reCaptcha_private_key = "asd";                // reCaptch Private Key
$reCaptcha_public_key  = "das";                // reCaptch Public Key

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// EMAIL SETTINGS /////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

$email_sender = "test@test.com";



/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// ADVANCED SETTINGS /////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('PROJECT_PATH', dirname(__FILE__));

define('PROJECT_URL', "http://alc.localhost.de"); 

error_reporting(E_ALL); 
ini_set('display_errors', 1);


