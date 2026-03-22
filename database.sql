CREATE DATABASE kaufa_university;
USE kaufa_university;

-- =========================================
-- For login/signup system
-- =========================================
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'lecturer', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
-- For student registration details
-- =========================================
CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Other'),
    date_of_birth DATE,
    phone VARCHAR(20),
    email VARCHAR(100) NOT NULL UNIQUE,
    address TEXT,
    course_id INT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- =========================================
-- For lecturer admission / lecturer details
-- =========================================
CREATE TABLE lecturers (
    lecturer_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Other'),
    phone VARCHAR(20),
    email VARCHAR(100) NOT NULL UNIQUE,
    department VARCHAR(100),
    qualification VARCHAR(150),
    hired_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- =========================================
-- For course.html and LMS-related pages
-- =========================================
CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(20) NOT NULL UNIQUE,
    course_name VARCHAR(100) NOT NULL,
    course_description TEXT,
    credits INT DEFAULT 3,
    lecturer_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lecturer_id) REFERENCES lecturers(lecturer_id) ON DELETE SET NULL
);

-- =========================================
-- For stdadmission.html
-- =========================================
CREATE TABLE student_admissions (
    admission_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Other'),
    date_of_birth DATE,
    phone VARCHAR(20),
    email VARCHAR(100) NOT NULL,
    address TEXT,
    applied_course VARCHAR(100),
    admission_status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
-- For lecadmission.html
-- =========================================
CREATE TABLE lecturer_admissions (
    admission_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Other'),
    phone VARCHAR(20),
    email VARCHAR(100) NOT NULL,
    department VARCHAR(100),
    qualification VARCHAR(150),
    experience_years INT DEFAULT 0,
    admission_status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
-- Relationship between students and courses
-- =========================================
CREATE TABLE enrollments (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- =========================================
-- 8. SAMPLE COURSES
-- =========================================
INSERT INTO courses (course_code, course_name, course_description, credits)
VALUES
('CS101', 'Introduction to Computing', 'Basic concepts of computing and programming.', 3),
('CS102', 'Web Development', 'HTML, CSS, JavaScript, and backend basics.', 3),
('CS103', 'Database Management', 'Introduction to relational databases and SQL.', 3),
('CS104', 'Software Engineering', 'Principles of software development and system design.', 3);

-- =========================================
-- 9. SAMPLE ADMIN USER
-- Password stored as plain text for testing only
-- Change this later to hashed passwords in PHP
-- =========================================
INSERT INTO users (full_name, email, password, role)
VALUES ('Admin User', 'admin@kaufa.com', 'admin123', 'admin');
