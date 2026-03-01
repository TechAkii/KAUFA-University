<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Access denied.");
}

$conn = new mysqli("localhost", "root", "", "kaufa");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* FILE UPLOAD FIRST */
if (isset($_FILES['payslip']) && $_FILES['payslip']['error'] === 0) {

    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    $fileType = $_FILES['payslip']['type'];

    if (!in_array($fileType, $allowedTypes)) {
        die("Invalid file type.");
    }

    if ($_FILES['payslip']['size'] > 2 * 1024 * 1024) {
        die("File too large.");
    }

    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES['payslip']['name']);
    move_uploaded_file($_FILES['payslip']['tmp_name'], $uploadDir . $fileName);

} else {
   if (!isset($_FILES['payslip']) || $_FILES['payslip']['error'] !== 0) {
    header("Location: STDregister.html?error=payslip_required");
    exit();
}
}

/* GET DATA */
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];
$nationality = $_POST['nationality'];
$national_id = $_POST['national_id'];
$blood_group = $_POST['blood_group'];

$student_id = $_POST['student_id'];
$faculty = $_POST['faculty'];  // MUST match DB
$department = $_POST['department'];
$study_year = $_POST['study_year'];
$program_duration = $_POST['program_duration'];
$institutional_email = $_POST['institutional_email'];
$personal_email = $_POST['personal_email'];

$mobile = $_POST['mobile'];
$alternate_phone = $_POST['alternate_phone'];
$address = $_POST['address'];
$guardian_name = $_POST['guardian_name'];
$relationship = $_POST['relationship'];
$guardian_contact = $_POST['guardian_contact'];
$emergency_contact = $_POST['emergency_contact'];

$room_type = $_POST['roomType'];

$signature_name = $_POST['signature_name'];
$application_date = $_POST['application_date'];

/* INSERT */
$sql = "INSERT INTO hostel_registrations (
first_name, middle_name, last_name, birthdate, gender, nationality, national_id, blood_group,
student_id, faculty, department, study_year, program_duration, institutional_email, personal_email,
mobile, alternate_phone, address, guardian_name, relationship, guardian_contact, emergency_contact,
room_type, signature_name, application_date, payslip
) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssssssssssssssssssssssssss",
    $first_name,
    $middle_name,
    $last_name,
    $birthdate,
    $gender,
    $nationality,
    $national_id,
    $blood_group,
    $student_id,
    $faculty,
    $department,
    $study_year,
    $program_duration,
    $institutional_email,
    $personal_email,
    $mobile,
    $alternate_phone,
    $address,
    $guardian_name,
    $relationship,
    $guardian_contact,
    $emergency_contact,
    $room_type,
    $signature_name,
    $application_date,
    $fileName
);

if ($stmt->execute()) {
    header("Location: STDregister.html?success=1");
} else {
    header("Location: STDregister.html?error=1");
}

$stmt->close();
$conn->close();
?>