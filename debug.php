<?php

/* 
 * Copyright (c) 2015, Pictureclass
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

require_once 'config.php';
include_once PROJECT_PATH.'/include/login/db_connect.php';
include_once PROJECT_PATH.'/include/login/functions.php';
sec_session_start();
require_once PROJECT_PATH.'/include/functions.inc.php';

html_head("Debug",NULL);


//GET TABLES
$tableList = array();
$res = $mysqli->query("SHOW TABLES");
while($cRow = mysqli_fetch_array($res))
{
  $tableList[] = $cRow[0];
}

//Show Grants
$grants = array();
$sql_grants = $mysqli->query("SHOW GRANTS");
while($grant = mysqli_fetch_array($sql_grants))
{
  $grants[] = $grant[0];
}

//CHeck for 64 bit support

$int = "9223372036854775807";
$int = intval($int);
if ($int > 2147483647) {
    $bit_check = "<strong>TRUE</strong> - " . $int;
}
else {
    $bit_check = "<strong>FALSE</strong> - " . $int;
}

?>

<?php
//Load Menu
top_menu();
?>
<div class="container" style="padding-top: 60px;">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php">Debug</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    MySQL Informations
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>MySQL Server Version</dt>
                        <dd><?php echo mysqli_get_server_info($mysqli); ?></dd>
                        <dt>MySQLi Support</dt>
                        <dd><?php var_dump(function_exists('mysqli_connect'));?></dd>
                        <dt>Tables</dt>
                        <dd><pre><?php print_r($tableList);?></pre></dd>
                        <dt>Privileges</dt>
                        <dd><pre><?php print_r($grants);?></pre></dd>
                        
                        
                    </dl>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    PHP Informations
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>64 Bit Support</dt>
                        <dd><?php echo $bit_check; ?></dd>
                    
                        <dt>PHP Info</dt>
                        <dd>
                        <?php
                        ob_start();
                        phpinfo();

                        preg_match ('%<style type="text/css">(.*?)</style>.*?(<body>.*</body>)%s', ob_get_clean(), $matches);

                        # $matches [1]; # Style information
                        # $matches [2]; # Body information

                        echo "<div class='phpinfodisplay'><style type='text/css'>\n",
                            join( "\n",
                                array_map(
                                    create_function(
                                        '$i',
                                        'return ".phpinfodisplay " . preg_replace( "/,/", ",.phpinfodisplay ", $i );'
                                        ),
                                    preg_split( '/\n/', $matches[1] )
                                    )
                                ),
                            "</style>\n",
                            $matches[2],
                            "\n</div>\n";
                        ?>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php
$extra_html_footer = "";
footer($extra_html_footer);
?>