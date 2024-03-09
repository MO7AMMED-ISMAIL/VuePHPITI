<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
    header("Access-Control-Allow-Methods: POST, OPTIONS, GET ,PUT,DELETE");


    // this to basic authentication for API but dont use it now
    function checkAuthenticate(){
        if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
            if ($_SERVER['PHP_AUTH_USER'] != "Mohamed" ||  $_SERVER['PHP_AUTH_PW'] != "3122000"){
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo 'Page Not Found';
                exit();
            }
        }
    }
    // checkAuthenticate();
?>