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
include_once 'db-config.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // vergib einen Sessionnamen
    $secure = SECURE;
    // Damit wird verhindert, dass JavaScript auf die session id zugreifen kann.
    $httponly = true;
    // Zwingt die Sessions nur Cookies zu benutzen.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Holt Cookie-Parameter.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Setzt den Session-Name zu oben angegebenem.
    session_name($session_name);
    session_start();            // Startet die PHP-Sitzung 
    session_regenerate_id();    // Erneuert die Session, löscht die alte. 
}

function login($username, $password, $mysqli) {
    // Das Benutzen vorbereiteter Statements verhindert SQL-Injektion.
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt FROM ".MySQL_TABLE_PREFIX."alc_user WHERE username = ? LIMIT 1")) {
        $stmt->bind_param('s', $username);  // Bind "$username" to parameter.
        $stmt->execute();    // Führe die vorbereitete Anfrage aus.
        $stmt->store_result();
 
        // hole Variablen von result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
        
        // hash das Passwort mit dem eindeutigen salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // Wenn es den Benutzer gibt, dann wird überprüft ob das Konto
            // blockiert ist durch zu viele Login-Versuche 
            $stmt->close();
            if (checkbrute($user_id, $mysqli) == true) {
                // Konto ist blockiert 
                // Schicke E-Mail an Benutzer, dass Konto blockiert ist
                return false;
            } else {
                // Überprüfe, ob das Passwort in der Datenbank mit dem vom
                // Benutzer angegebenen übereinstimmt.
                if ($db_password == $password) {
                    // Passwort ist korrekt!
                    // Hole den user-agent string des Benutzers.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS-Schutz, denn eventuell wir der Wert gedruckt
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS-Schutz, denn eventuell wir der Wert gedruckt
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/","",$username);
                    
                    $_SESSION['userid'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    
                    // Update Login Date
                    if ($stmt_update = $mysqli->prepare("UPDATE ".MySQL_TABLE_PREFIX."alc_user SET date_last_login = now() WHERE username = ?")) {
                        $stmt_update->bind_param('s',$username);
                        // Führe die vorbereitete Anfrage aus.
                        if (!$stmt_update->execute()) {
                            die(print $mysqli->error);

                        }
                        $stmt_update->close();
                    }
                    // Login erfolgreich.
                    return true;

                } else {
                    // Passwort ist nicht korrekt
                    // Der Versuch wird in der Datenbank gespeichert
                    $now = time();
                    $mysqli->query("INSERT INTO ".MySQL_TABLE_PREFIX."alc_login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            //Es gibt keinen Benutzer.
            return false;
        }
    }
}

function checkbrute($user_id, $mysqli) {
    // Hole den aktuellen Zeitstempel 
    $now = time();
 
    // Alle Login-Versuche der letzten zwei Stunden werden gezählt.
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time FROM ".MySQL_TABLE_PREFIX."alc_login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Führe die vorbereitet Abfrage aus. 
        $stmt->execute();
        $stmt->store_result();
 
        // Wenn es mehr als 5 fehlgeschlagene Versuche gab 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($mysqli) {
    // Überprüfe, ob alle Session-Variablen gesetzt sind 
    if (isset($_SESSION['userid'], $_SESSION['username'], $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['userid'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Hole den user-agent string des Benutzers.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password, permission FROM ".MySQL_TABLE_PREFIX."alc_user WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" zum Parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // Wenn es den Benutzer gibt, hole die Variablen von result.
                $stmt->bind_result($password, $permission);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Eingeloggt!!!! 
                    return intval($permission);
                } else {
                    // Nicht eingeloggt
                    return false;
                }
            } else {
                // Nicht eingeloggt
                return false;
            }
        } else {
            // Nicht eingeloggt
            return false;
        }
    } else {
        // Nicht eingeloggt
        return false;
    }
}

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // Wir wollen nur relative Links von $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

function check_pswd($user_id, $password, $mysqli) {
    // Das Benutzen vorbereiteter Statements verhindert SQL-Injektion.
    $user_id = intval(preg_replace("/[^0-9]+/", "", $user_id));
    if ($stmt = $mysqli->prepare("SELECT password, salt FROM ".MySQL_TABLE_PREFIX."alc_user WHERE id = ? LIMIT 1")) {
        $stmt->bind_param('i', $user_id);  // Bind "$username" to parameter.
        $stmt->execute();    // Führe die vorbereitete Anfrage aus.
        $stmt->store_result();
 
        // hole Variablen von result.
        $stmt->bind_result($db_password, $salt);
        $stmt->fetch();
 
        // hash das Passwort mit dem eindeutigen salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            
            // Überprüfe, ob das Passwort in der Datenbank mit dem vom
            // Benutzer angegebenen übereinstimmt.
            if ($db_password == $password) {
                // Passwort ist korrekt!
                // Hole den user-agent string des Benutzers.
                return true;
            } 
        } else {
            //Es gibt keinen Benutzer.
            return false;
        }
    }
}