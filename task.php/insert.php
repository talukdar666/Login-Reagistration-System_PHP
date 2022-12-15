<?php
include "conn.php";

if (isset($_POST['submit'])) {
    $task   = $_POST['input'];
    $table  = "information";

    $insert = $conn->prepare("INSERT INTO {$table} (name) VALUES (:name) ");

    $insert->execute([':name' => $task]);

    if ($insert == true) {
        header("location: index.php?msg=success");
    }
}
