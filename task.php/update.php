<?php
include "conn.php";

$table = "information";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $data = $conn->query("SELECT * FROM {$table} WHERE id = $id ");

    $rows = $data->fetch(PDO::FETCH_OBJ);

    if (isset($_POST['submit'])) {
        $task   = $_POST['input'];

        $update = $conn->prepare("UPDATE {$table} SET name =:name WHERE id = $id ");

        $update->execute([':name' => $task]);

        if ($update == true) {
            header("location: index.php?msg=updated");
        }
    }
}
?>

<form class="form-inline" action="update.php?id=<?php echo $id; ?>" method="POST">
    <div class="form-group mx-sm-3 mb-2">
        <label for="input" class="sr-only">Task</label>
        <input type="text" name="input" id="input" class="form-control" value="<?php echo $rows->name; ?>">
    </div>
    <button type="submit" name="submit" class="btn btn-primary mb-2">update</button>
</form>