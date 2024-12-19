<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Sign Up
    if (isset($_POST['signup'])) {
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Hash password
        $hashedPassword = md5($password);

        // Check if email already exists
        $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            echo "Email address already taken";
        } else {
            // Insert new user
            $insertQuery = "INSERT INTO users (firstName, lastName, email, password)
                            VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";
            if ($conn->query($insertQuery) === TRUE) {
                //Redirect to homepage
                header("Location: index.html");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    //Login
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Hash password
        $hashedPassword = md5($password);

        //Check for matching email and password
        $loginQuery = "SELECT * FROM users WHERE email='$email' AND password='$hashedPassword'";
        $result = $conn->query($loginQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];

            //Redirect to homepage
            header("Location: ../index.html");
            exit();
        } else {
            echo "Incorrect email or password.";
        }
    }
}

$conn->close();
?>