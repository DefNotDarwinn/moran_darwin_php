<?php
session_start();
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $errors = validateLoginCredentials($email, $password);
    
    if (empty($errors)) {
        $users = getUsers();
        if (checkLoginCredentials($email, $password, $users)) {
            $_SESSION['email'] = $email;
            header('Location: dashboard.php');
            exit();
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post" action="">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
    </form>
    <?php if (!empty($errors)) echo implode('<br>', $errors); ?>
</body>
</html>
