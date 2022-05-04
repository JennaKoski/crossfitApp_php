<?php $host = 'db';
    $dbuser = 'root';
    $dbpassword = 'lionPass';
    $dbname = 'crossfitapp'; 

    $connection = new mysqli($host, $dbuser, $dbpassword, $dbname);

    if($connection->connect_error){
        die("Connection failed: " . $connection->connect_error);
     }

    ?>