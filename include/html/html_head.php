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


function html_head($page_title, $extra_html_header){
    if (empty($page_title)){$page_title = "";}
    if (empty($extra_html_header)){$extra_html_header = "";}
    echo " 
    <!DOCTYPE html>
    <html lang='de'>

    <head>

        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name='description' content=''>
        <meta name='author' content='Servertester.de'>

        <title>". $page_title ." - Altis Life Control</title>

        <link rel='shortcut icon' href='".PROJECT_URL."/img/favicon.ico' type='image/x-icon'>
        <link rel='icon' href='".PROJECT_URL."/img/favicon.ico' type='image/x-icon'>

        <!-- Bootstrap Core CSS -->
        <link href='".PROJECT_URL."/css/bootstrap.css' rel='stylesheet'>

        <!-- Custom CSS -->
        <link href='".PROJECT_URL."/css/modern-business.css' rel='stylesheet'>
        
        <!-- Custom Fonts -->
        <link href='".PROJECT_URL."/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
        
        <!-- jQuery Version 1.11.0 -->
        <script src='".PROJECT_URL."/js/jquery-1.11.0.js'></script>

        <!-- Bootstrap Core JavaScript -->
        <script src='".PROJECT_URL."/js/bootstrap.min.js'></script>       
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
            <script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
        <![endif]-->

        ".
        $extra_html_header
        ." 
    </head>
    <body style='background-image: url(".PROJECT_URL."/img/altis_background.jpg); background-repeat: repeat-y; background-attachment: fixed; padding-bottom: 100px;'> ";
}

