<?php
session_start(); // Start the session (if needed)
require 'fetch_reviews.php'; // Include the file to fetch reviews
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- Add Bootstrap CSS (if using Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Welcome to Car Rental</h1>

        <!-- Review Submission Form -->
        <div class="card my-4 shadow">
            <div class="card-body">
                <h3 class="card-title">Leave a Review</h3>
                <form action="submit_review.php" method="POST">
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="star_rating" class="form-label">Rating</label>
                        <select class="form-control" id="star_rating" name="star_rating" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="review_note" class="form-label">Your Review</label>
                        <textarea class="form-control" id="review_note" name="review_note" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>

        <!-- Display Reviews -->
        <div class="review-section">
            <h3 class="text-center my-4">Customer Reviews</h3>
            <?php if (!empty($reviews)): ?>
                <div class="row">
                    <?php foreach ($reviews as $review): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($review['customer_name']); ?></h5>
                                    <p class="card-text">
                                        <?php echo str_repeat('⭐', $review['star_rating']); ?>
                                    </p>
                                    <p class="card-text"><?php echo htmlspecialchars($review['review_note']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center">No reviews yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add Bootstrap JS (if using Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>