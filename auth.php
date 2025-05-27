<?php 
    session_start();

    require_once 'database/db_connect.php';
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = sha1($_POST['password']);

        $request = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $request->execute([$email, $password]);
        $user = $request->fetch();
        
    if($user){
        $_SESSION['user'] = $user;
        try {
           if ($user['role'] === 'admin') {
                header('Location: admin_dashboard.php');
            } 
            elseif ($user['role'] === 'agent') {
                header("Location: agent_dashboard.php");
            }
            elseif ($user['role'] === 'user') {
                header("Location: suivi_reclamation.php");
            } 
        } catch (Exception $th) {
            // Gérer l'erreur de redirection
            echo "Une erreur s'est produite lors de la redirection: " . $th->getMessage();
            exit();
        }
    } else {
        echo "Identifiants incorrects.";
    }
}    
?>