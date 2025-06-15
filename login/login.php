<?php

// check if user exists in database
function checkExists($email, $pwd, &$pdo){
    try {

        $query = "SELECT * FROM users WHERE email = :email AND pwd = :pwd";
        
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->execute();
        
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //$userid = $res[0]['id'];
        //echo "User ID: " . $userid . "<br>";

        return (!empty($res));
    
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: /Website/home/");
    die();
}else {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        require_once '../includes/dbh.inc.php';

        $exists = checkExists($email, $password, $pdo);
        if (!$exists) {
            echo "Account does not exist!";
            die();
        }

        echo "Login successful! Redirecting to home page...";
        
        header("Location: /Website/home/");
        
        session_start();
        $_SESSION['email'] = $email;

        die();

    }catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }

}
 
exit;