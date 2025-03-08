<?php
include 'db_connection.php';

// Get user ID from the URL
$user_id = $_GET['user_id'];

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['company_name'];
    $job_duration = $_POST['job_duration'];
    $job_responsibilities = $_POST['job_responsibilities'];

    // Insert data into experience table
    $sql = "INSERT INTO experience (user_id, company_name, job_duration, job_responsibilities)
            VALUES ('$user_id', '$company_name', '$job_duration', '$job_responsibilities')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to previous projects page
        header("Location: previous.php?user_id=$user_id");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- Example experience form -->
<form action="experience.php?user_id=<?php echo $user_id; ?>" method="post">
    <label for="company_name">Company Name:</label>
    <input type="text" name="company_name" required><br>

    <label for="job_duration">Job Duration:</label>
    <input type="text" name="job_duration" required><br>

    <label for="job_responsibilities">Job Responsibilities:</label>
    <textarea name="job_responsibilities" required></textarea><br>

    <button type="submit">Next</button>
</form>
