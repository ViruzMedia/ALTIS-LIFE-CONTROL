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
function formhash(form, password) {
    // Erstelle ein neues Feld für das gehashte Passwort. 
    var p = document.createElement("input");
 
    // Füge es dem Formular hinzu. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Sorge dafür, dass kein Text-Passwort geschickt wird. 
    //password.value = "";
 
    // Reiche das Formular ein. 
    form.submit();
}

function regformhash(form, uid, email, password, conf) {
     // Überprüfe, ob jedes Feld einen Wert hat
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Überprüfe den Benutzernamen
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Username must contain only letters, numbers and underscores. Please try again"); 
        form.username.focus();
        return false; 
    }
 
    // Überprüfe, dass Passwort lang genug ist (min 6 Zeichen)
    // Die Überprüfung wird unten noch einmal wiederholt, aber so kann man dem 
    // Benutzer mehr Anleitung geben
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // Mindestens eine Ziffer, ein Kleinbuchstabe und ein Großbuchstabe
    // Mindestens sechs Zeichen 
 
    //var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    //if (!re.test(password.value)) {
    //    alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
    //    return false;
    //}
 
    // Überprüfe die Passwörter und bestätige, dass sie gleich sind
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
 
    // Erstelle ein neues Feld für das gehashte Passwort.
    var p = document.createElement("input");
 
    // Füge es dem Formular hinzu. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Sorge dafür, dass kein Text-Passwort geschickt wird. 
    password.value = "";
    conf.value = "";
 
    // Reiche das Formular ein. 
    form.submit();
    return true;
}

function change_pswd_hash(form, old_pswd, new_pswd, new_pswd_confirm) {
    //NEUE PASSWÖRTER AUF MINDESTLÄNGE ÜBERPRÜFEN
    
    if (old_pswd.value.length < 6) {
        alert('Dein altes Passwort muss mindestens 6 Zeichen lang sein');
        form.old_pswd.focus();
        return false;
    }
    
    if (new_pswd.value.length < 6) {
        alert('Dein neues Passwort muss mindestens 6 Zeichen lang sein');
        form.new_pswd.focus();
        return false;
    }
    if (new_pswd_confirm.value.length < 6) {
        alert('Dein neues Passwort muss mindestens 6 Zeichen lang sein');
        form.new_pswd_confirm.focus();
        return false;
    }
    //ÜBERPRÜFE OB PASSWÖRTER ÜBEREINSTIMMEN
    if (new_pswd.value != new_pswd_confirm.value) {
        alert('Dein neues Passwort stimmt nicht mit der Bestätigung überein');
        form.password.focus();
        return false;
    }
    
    // Erstelle ein neues Feld für das gehashte Passwort. 
    var p_old = document.createElement("input");
    var p_new = document.createElement("input");
    var p_new_c = document.createElement("input");
    //var u_id = document.createElement("input");
    // Füge es dem Formular hinzu. 
    form.appendChild(p_old);
    p_old.name = "p_old";
    p_old.type = "hidden";
    p_old.value = hex_sha512(old_pswd.value);
    
    form.appendChild(p_new);
    p_new.name = "p_new";
    p_new.type = "hidden";
    p_new.value = hex_sha512(new_pswd.value);
 
    form.appendChild(p_new_c);
    p_new_c.name = "p_new_c";
    p_new_c.type = "hidden";
    p_new_c.value = hex_sha512(new_pswd_confirm.value);
    
    
    // Sorge dafür, dass kein Text-Passwort geschickt wird. 
    old_pswd.value = "";
    new_pswd.value = "";
    new_pswd_confirm.value = "";
 
    // Reiche das Formular ein. 
    form.submit();
}

function change_email_hash(form, password, new_email, new_email_confirm) {
    //NEUE PASSWÖRTER AUF MINDESTLÄNGE ÜBERPRÜFEN
    
    if (password.value.length < 6) {
        alert('Dein Passwort muss mindestens 6 Zeichen lang sein');
        form.password.focus();
        return false;
    }
    
    //ÜBERPRÜFE OB E-Mail ÜBEREINSTIMMEN
    if (new_email.value != new_email_confirm.value) {
        alert('Deine E-Mail Adresse stimmt nicht mit der Bestätigung überein');
        form.new_email.focus();
        return false;
    }
    
    // Erstelle ein neues Feld für das gehashte Passwort. 
    var p = document.createElement("input");
    var e_new = document.createElement("input");
    var e_new_c = document.createElement("input");
    //var u_id = document.createElement("input");
    // Füge es dem Formular hinzu. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
    
    form.appendChild(e_new);
    e_new.name = "e_new";
    e_new.type = "hidden";
    e_new.value = new_email.value;
 
    form.appendChild(e_new_c);
    e_new_c.name = "e_new_c";
    e_new_c.type = "hidden";
    e_new_c.value = new_email_confirm.value;
    
    
    // Sorge dafür, dass kein Text-Passwort geschickt wird. 
    password.value = "";
     
    // Reiche das Formular ein. 
    form.submit();
}

