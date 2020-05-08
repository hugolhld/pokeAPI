<?php

    if($_SERVER['HTTP_HOST'] === 'localhost:8080')
    {
        //Errors
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        //Config
        // define('OPEN_WEATHER_MAP_API_KEY', 'f2bd2e32eedfe80cebf784b96d1eff70');
        // define('KEY_GOOGLE', 'AIzaSyB6u8RLqSXjwSCunqI-U9Mzz0s-JYNKWrc');
    }
    define('BASE_URL', 'https://pokeapi.co/api/v2/pokemon');
    // $url = 'https://pokeapi.co/api/v2/pokemon';