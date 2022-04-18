<?php

    require __DIR__ . '/vendor/autoload.php';

    use Yosymfony\Toml\Toml;

    function getConfig()
    {
        $config_file = file_get_contents("conf.toml");
        $array = Toml::Parse($config_file);

        return $array;
    }


    function getSqlRow(string t) {


    }


    function getSqli()
    {
        $config = getConfig();

        $db = mysqli_connect($config['database']['hostname'], $config['database']['username'], $config['database']['password'], $config['database']['name']);
        return $db;
    }
