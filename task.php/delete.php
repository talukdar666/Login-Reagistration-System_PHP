<?php
include "conn.php";

$table = "information";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete = $conn->prepare("DELETE FROM {$table} WHERE id =:id ");

    $delete->execute([':id' => $id]);

    header("location: index.php?msg=deleted");
}
