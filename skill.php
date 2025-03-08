<?php
include 'db_connection.php';

// Get user ID from the URL
$user_id = $_GET['user_id'];

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $soft_skills = $_POST['soft_skills'];
    $technical_skills = $_POST['technical_skills'];

    // Insert data into skills table
    $sql = "INSERT INTO skills (user_id, soft_skills, technical_skills)
            VALUES ('$user_id', '$soft_skills', '$technical_skills')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to academy page
        header("Location: academy.php?user_id=$user_id");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- Example skills form -->
<form action="skill.php?user_id=<?php echo $user_id; ?>" method="post">
    <label for="soft_skills">Soft Skills:</label>
    <textarea name="soft_skills" required></textarea><br>

    <label for="technical_skills">Technical Skills:</label>
    <textarea name="technical_skills" required></textarea><br>

    <button type="submit">Next</button>
</form>
