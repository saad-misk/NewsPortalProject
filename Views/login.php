<?php
    session_start();
    require_once '../config/databaseConfig.php';

    $error = '';

    if ( isset($_POST['email']) && isset($_POST['password']) ) {
        $email = $_POST['email'];
        $password =  $_POST['password'];


        require_once '../models/User.php';

        $userModel = new User();
        $user = $userModel->findByEmail($email);
        // if( $user ) echo "user exists\n";
        // if( password_verify($password, $user['password']) ) echo "password verified\n";
        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            if ($user['role'] === 'admin') {
                header("Location: ../Views/Admin/admin_dashboard.php");
            } elseif ($user['role'] === 'editor') {
                header("Location: ../Views/Editor/editor_dashboard.php");
            } else {
                header("Location: ../Views/Author/author_dashboard.php");
            }
            exit();
        } else {
            $error = "Failed to login.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>