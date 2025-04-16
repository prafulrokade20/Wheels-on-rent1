<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['customer_name']) || empty($_POST['star_rating']) || empty($_POST['review_note'])) {
        $error = "All fields are required.";
    } else {
        // Define variables
        $customer_name = $_POST['customer_name'];
        $star_rating = $_POST['star_rating'];
        $review_note = $_POST['review_note'];

        // Establishing Connection with Server
        require 'connection.php';
        $conn = Connect();

        // SQL query to insert review into the database
        $query = "INSERT INTO reviews (customer_name, star_rating, review_note) VALUES (?, ?, ?)";

        // To protect MySQL injection for Security purpose
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sis", $customer_name, $star_rating, $review_note);

        if ($stmt->execute()) {
            // Review submitted successfully
            $_SESSION['review_submitted'] = true;
            header("location: index.php"); // Redirect to homepage or thank-you page
        } else {
            $error = "Failed to submit review. Please try again.";
        }

        $stmt->close();
        mysqli_close($conn); // Closing Connection
    }
}
?>