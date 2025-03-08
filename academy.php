<?php
include 'db_connection.php';

// Get user ID from the URL
$user_id = $_GET['user_id'];

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $institute = $_POST['institute'];
    $degree = $_POST['degree'];
    $year = $_POST['year'];
    $grade = $_POST['grade'];

    // Insert data into academy table
    $sql = "INSERT INTO academy (user_id, institute, degree, year, grade)
            VALUES ('$user_id', '$institute', '$degree', '$year', '$grade')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to experience page
        header("Location: experience.php?user_id=$user_id");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- Example academy form -->
<form action="academy.php?user_id=<?php echo $user_id; ?>" method="post">
    <label for="institute">Institute:</label>
    <input type="text" name="institute" required><br>

    <label for="degree">Degree:</label>
    <select name="degree" required>
        <option value="Diploma">Diploma</option>
        <option value="Bachelor's Degree">Bachelor's Degree</option>
        <option value="Master's Degree">Master's Degree</option>
        <option value="Professional Degree">Professional Degree</option>
        <option value="Doctoral Degree">Doctoral Degree</option>
        <option value="Higher Secondary">Higher Secondary Education</option>
        <option value="Undergraduate">Undergraduate</option>
        <option value="Secondary Education">Secondary Education</option>
    </select><br>

    <label for="year">Year:</label>
    <input type="number" name="year" required><br>

    <label for="grade">Grade:</label>
    <input type="text" name="grade" required><br>

    <button type="submit">Next</button>
</form>
