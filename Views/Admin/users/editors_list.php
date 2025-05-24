<?php
    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../unauthorized.php");
        exit;
    }

    $name = htmlspecialchars($_SESSION['name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editors List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
</head>
<body class="container mt-4">

    <?php
        require_once '../../../models/User.php';
        $userModel = new User();
        $editors = $userModel->getAllByRole('editor');
    ?>

    <?php require_once '../nav.php' ?>

    <h2>Editors List (<?= count($editors) ?>)</h2>
    <a class="btn btn-primary mb-3" href="add_editor.php">Add New Editor</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($editors as $editor): ?>
                <tr>
                    <td><?= $editor['name']?></td>
                    <td><?= $editor['email']?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="edit_editor.php?id=<?= $editor['id'] ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="delete_user.php?id=<?= $editor['id'] ?>&type=editor" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../admin_dashboard.php" class="btn btn-secondary">Go Back to Dashboard</a>

</body>
</html>