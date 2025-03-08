<?php
require_once 'db_connection.php'; // Database connection file
require_once 'tcpdf/tcpdf.php';   // Include TCPDF library

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];
$project_title = $_POST['project_title'] ?? 'N/A';
$description = $_POST['description'] ?? 'N/A';
$publication = $_POST['publication'] ?? 'N/A';

// Save Data to Database
$sql = "INSERT INTO previous_projects (user_id, project_title, description, publication) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $project_title, $description, $publication);
$stmt->execute();

// Fetch all user details for PDF generation
$query = "SELECT * FROM registration WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Create new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($user['full_name']);
$pdf->SetTitle('Resume');
$pdf->SetHeaderData('', 0, 'Resume', $user['full_name']);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();

// Set Font
$pdf->SetFont('helvetica', '', 12);

// Resume Content
$html = "
<h1>{$user['full_name']}</h1>
<p><strong>Email:</strong> {$user['email']}</p>
<p><strong>Contact:</strong> {$user['contact_no']}</p>
<p><strong>Bio:</strong> {$user['bio']}</p>

<h2>Skills</h2>
<p><strong>Soft Skills:</strong> {$user['soft_skills']}</p>
<p><strong>Technical Skills:</strong> {$user['technical_skills']}</p>

<h2>Education</h2>
<p><strong>Degree:</strong> {$user['degree']}</p>
<p><strong>Institute:</strong> {$user['institute']}</p>
<p><strong>Year:</strong> {$user['year']}</p>

<h2>Work Experience</h2>
<p><strong>Company Name:</strong> {$user['company_name']}</p>
<p><strong>Job Duration:</strong> {$user['job_duration']}</p>
<p><strong>Responsibilities:</strong> {$user['job_responsibilities']}</p>

<h2>Projects & Publications</h2>
<p><strong>Project Title:</strong> $project_title</p>
<p><strong>Description:</strong> $description</p>
<p><strong>Publication:</strong> $publication</p>
";

// Write HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Save PDF to server and output
$pdf_filename = "resumes/resume_" . $user['id'] . ".pdf";
$pdf->Output(__DIR__ . '/' . $pdf_filename, 'F');

// Redirect user to the generated PDF
header("Location: $pdf_filename");
exit();
?>
