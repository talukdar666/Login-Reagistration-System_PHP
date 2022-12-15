<?php

try {
    $host = "localhost";
    $db   = "udemy_2";
    $user = "root";
    $pass = "";

    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "error is" . $e->getMessage();
}

//?\mSe{&O5m=Ao\z4