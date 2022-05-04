<?php $host = 'db';
    $dbuser = 'root';
    $dbpassword = 'lionPass';
    $dbname = 'crossfitapp';
    // $port = '8005'; 

    $connection = new mysqli($host, $dbuser, $dbpassword, $dbname);

    if($connection->connect_error){
        die("Connection failed: " . $connection->connect_error);
     }

    ?>