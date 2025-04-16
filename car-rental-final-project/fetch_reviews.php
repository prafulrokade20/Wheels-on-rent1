<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

//Establishing Connection with Server
require 'connection.php';
$conn = Connect();

// SQL query to fetch reviews
$query = "SELECT customer_name, star_rating, review_note FROM reviews ORDER BY date_added DESC LIMIT 5";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($customer_name, $star_rating, $review_note);

$reviews = [];
while ($stmt->fetch()) {
    $reviews[] = [
        'customer_name' => $customer_name,
        'star_rating' => $star_rating,
        'review_note' => $review_note
    ];
}


$stmt->close();
mysqli_close($conn); // Closing Connection
?>