<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Sign Up
    if (isset($_POST['signup'])) {
        $firstName = $conn->real_escape_string($_POST['fName']);
        $lastName = $conn->real_escape_string($_POST['lName']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        //Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //Check if email already exists
        $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            echo "Email address already taken";
        } else {
            //Insert new user
            $insertQuery = "INSERT INTO users (firstName, lastName, email, password)
                            VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";
            if ($conn->query($insertQuery) === TRUE) {
                //Redirect
                header("Location: index.html");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    //Login
    if (isset($_POST['login'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];

        //Check matching email
        $loginQuery = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($loginQuery);

        if ($result->num_rows > 0) {
            //Verify password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                //Redirect
                $_SESSION['email'] = $row['email'];
                header("Location: .//index.html");
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "Email not registered.";
        }
    }
}

$conn->close();
?>