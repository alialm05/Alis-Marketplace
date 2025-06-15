<?php

function checkExists($email, &$pdo){
    // This function checks if the email already exists in the database
    try {

        $query = "SELECT * FROM users WHERE email = :email";
        
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return (!empty($res));
    
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: /Website/home/");
    die();
}else {
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phonenum = $_POST['phone'];

    try {
        require_once '../includes/dbh.inc.php';


        $exists = checkExists($email, $pdo);
        if ($exists) {
            echo "Email already exists in the database.";
            //header("Location: /Website/signup/?error=email_exists");
            die();
        }

        $query = "INSERT INTO users (email, pwd, firstname, lastname, address, phonenumber) VALUES
        (?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$email, $password, $fname, $lname, $address, $phonenum]);

        $pdo = null;
        $stmt = null;
        header("Location: /Website/login/");

        die();

    }catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }


}