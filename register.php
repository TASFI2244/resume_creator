<?php
include 'db_connection.php'; // Include database connection

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $contact_info = $_POST['contact_info'];
    $photo = $_FILES['photo']['name'];
    $bio = $_POST['bio'];

    // Save photo
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo);
    move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);

    // Insert data into the registration table
    $sql = "INSERT INTO registration (full_name, contact_info, photo, short_bio)
            VALUES ('$full_name', '$contact_info', '$photo', '$bio')";

    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id; // Get the last inserted ID

        // Redirect to skills page with the user ID
        header("Location: skill.php?user_id=$user_id");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- Example registration form -->
<form action="register.php" method="post" enctype="multipart/form-data">
    <label for="full_name">Full Name:</label>
    <input type="text" name="full_name" required><br>

    <label for="contact_info">Contact Information:</label>
    <input type="text" name="contact_info" required><br>

    <label for="photo">Upload Photo:</label>
    <input type="file" name="photo" required><br>

    <label for="bio">Short Bio:</label>
    <textarea name="bio" required></textarea><br>

    <button type="submit">Submit</button>
</form>
