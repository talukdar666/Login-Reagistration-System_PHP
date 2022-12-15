<?php
include "conn.php";

$table = "information";

$data = $conn->query("SELECT * FROM {$table} ");

$msg = "";
$massage = "";
$success = "Task added successfully";
$delete  = "Task deleted successfully";
$update  = "Task updated successfully";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];

    if ($msg == "success") {
        $massage = $success;
    } else if ($msg == "deleted") {
        $massage = $delete;
    } else if ($msg == "updated") {
        $massage = $update;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>todo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h3 class="text-primary"><?php echo $massage ?></h3>

    <div class="container">
        <form class="form-inline" action="insert.php" method="POST">
            <div class="form-group mx-sm-3 mb-2">
                <label for="input" class="sr-only">create</label>
                <input type="text" name="input" id="input" class="form-control" placeholder="Enter a task">
            </div>
            <button type="submit" name="submit" class="btn btn-primary mb-2">Create</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>

                <?php while ($row = $data->fetch(PDO::FETCH_OBJ)) : ?>

                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><a class="btn btn-danger" href="delete.php?id=<?php echo $row->id; ?>">delete</a></td>
                        <td><a class="btn btn-warning" href="update.php?id=<?php echo $row->id; ?>">update</a></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</body>

</html>