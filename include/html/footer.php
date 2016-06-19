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

function footer($extra_html_footer){
  
    echo "
        <nav class='navbar navbar-inverse navbar-fixed-bottom' role='navigation' style='margin-bottom: 0;'>
            <div class='container'>
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class='row'>
                    <div class='col-lg-8'>
                        <p style='color: #fff; font-size: smaller; margin-top: 5px;'>Copyright &copy; ".date('Y')." Altis Life Control 2.0 - by Pictureclass  - All Rights Reserved</br>
                        Only for Private Use. No Commercial Use. Advanced Permissions beyond this license may be available at pictureclass@revoplay.de.</p>
                    </div>
                    <div class='col-lg-2'>
                        <form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top' class='text-center' style='margin-top: 5px; margin-bottom: 10px;'>
                            <input type='hidden' name='cmd' value='_s-xclick'>
                            <input type='hidden' name='hosted_button_id' value='P8E8XVKTZ3BKG'>
                            <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
                            <img alt='' border='0' src='https://www.paypalobjects.com/de_DE/i/scr/pixel.gif' width='1' height='1'>
                        </form>
                    </div>
                    <div class='col-lg-2'>
                        <ul class='list-unstyled list-inline list-social-icons text-center' style='margin-top: 5px; margin-bottom: 10px;'>
                            <li>
                                <a href='https://www.facebook.com/pages/Pictureclass/374630966077122'><i class='fa fa-facebook-square fa-lg' style='color: #fff;'></i></a>
                            </li>
                            <li>
                                <a href='https://twitter.com/Pictureclass'><i class='fa fa-twitter-square fa-lg' style='color: #fff;'></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </nav> 
        
        ".$extra_html_footer." 
    </body>

    </html>
    ";

}

