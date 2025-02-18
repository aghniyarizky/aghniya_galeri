<?php

    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'aghniya_galeri';

    $conn = new mysqli($server, $username, $password, $database);

    if ($conn -> connect_error){
        die('error connection');
    }

?>