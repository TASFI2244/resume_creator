<?php
require_once('tcpdf/tcpdf.php'); // Include TCPDF Library
session_start();

// Create new PDF instance
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Resume");

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Fetch user data (Modify as per your database/session storage)
$fullName = $_SESSION['full_name'];
$contact = $_SESSION['contact'];
$bio = $_SESSION['bio'];
$skills = $_SESSION['skills'];
$technicalSkills = $_SESSION['technical_skills'];
$education = $_SESSION['education'];
$experience = $_SESSION['experience'];
$projects = $_SESSION['projects'];

// Resume Layout
$html = "
<h2 style='text-align:center;'>Resume</h2>
<h3>Personal Information</h3>
<b>Full Name:</b> $fullName <br>
<b>Contact:</b> $contact <br>
<b>Bio:</b> $bio <br><br>

<h3>Skills</h3>
<b>Soft Skills:</b> $skills <br>
<b>Technical Skills:</b> $technicalSkills <br><br>

<h3>Education</h3>
$education <br><br>

<h3>Experience</h3>
$experience <br><br>

<h3>Projects & Publications</h3>
$projects
";

// Add HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF file (Download or View)
$pdf->Output("resume.pdf", "D");
?>
