<?php

    if($_SERVER['HTTP_HOST'] === 'localhost:8080')
    {
        //Errors
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }