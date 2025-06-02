<?php 
    session_start();

    require 'database/db_connect.php';

    if (isset($_SESSION['email'])) {
        header("Location: index.php");
        exit();
    }
    
    if (isset($_POST['submit'])) {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            echo '<script>alert("Please fill in all fields!");</script>';
        }
        else {
            $result = $conn->query("SELECT `id`, `name`, `email`, `password`, `role`, `created_at` FROM `users` WHERE $email");
            if ($result->rowCount() > 0) {
                $row = $result->fetch();
    
                if ($password == $row['password']) {
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
    
                    if ($row['role'] == 'admin') {
                        header("Location: admin.php");
                    }
                    elseif ($row['role'] == 'agent') {
                        header("Location: agent.php");
                    }
                    else {
                        header("Location: index.php");
                    }
                    }
                }
                else {
                    echo '<script>alert("Incorrect password!");</script>';
                }
            }
    }
    
?>