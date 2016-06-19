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
function admin_html_head($page_title, $extra_html_header){
?>    

<html lang="de">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel='shortcut icon' href='<?php echo PROJECT_URL;?>/img/favicon.ico' type='image/x-icon'>
    <link rel='icon' href='<?php echo PROJECT_URL;?>/img/favicon.ico' type='image/x-icon'>
    
    <title><?php echo $page_title;?> - Servertester.de</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo PROJECT_URL;?>/css/bootstrap.css" rel="stylesheet" type="text/css">

    <!-- Themplate CSS -->
    <link href='<?php echo PROJECT_URL;?>/css/modern-business.css' rel='stylesheet' type="text/css">
    
    <!-- MetisMenu CSS -->
    <link href="<?php echo PROJECT_URL;?>/css/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css">

    <!-- Timeline CSS -->
    <link href="<?php echo PROJECT_URL;?>/css/timeline.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="<?php echo PROJECT_URL;?>/css/sb-admin-2.css" rel="stylesheet" type="text/css">

    <!-- Morris Charts CSS -->
    <link href="<?php echo PROJECT_URL;?>/css/morris.css" rel="stylesheet" type="text/css">
    
    <!-- Buttons Social -->
    <link href="<?php echo PROJECT_URL;?>/css/bootstrap-social.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="<?php echo PROJECT_URL;?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Cutsom HTML -->
    <?php echo $extra_html_header; ?>
    

</head>

<body>
    
<?php
}
?>