# 🎓 KAUFA University – Learning Management System

A simple **University Learning Management System (LMS)** web application that simulates a digital academic platform for students and lecturers.

This project demonstrates how a university portal can be built using **HTML, CSS, JavaScript, and PHP** to manage academic information such as student registration, admissions, login systems, and course pages.

---

# 🌐 Live Demo

GitHub Pages:
```
https://techakii.github.io/KAUFA-University/
```
---

# 📌 Project Overview

KAUFA University is a web-based system designed to represent a basic **Learning Management System (LMS)** used in universities.

The platform includes several pages and features that allow users to explore course information, student admissions, and login functionality.

The goal of this project is to practice **web development concepts and system design for educational platforms.**

---

# ⚙️ Technologies Used

| Technology | Purpose |
|-----------|--------|
| HTML | Structure of the web pages |
| CSS | Styling and layout |
| JavaScript | Client-side interactivity |
| PHP | Backend form processing |
| Git | Version control |
| GitHub | Project hosting |

---

# 📁 Project Structure

```
KAUFA-University/
│
├── uploads/                # Folder for uploaded files
│
├── index.html              # Home page
├── login.html              # Login interface
├── signin.html             # Sign-in page
├── signup.php              # User registration backend
├── login.php               # Login backend
│
├── STDregister.html        # Student registration form
├── STD.php                 # Student registration backend
│
├── stdadmission.html       # Student admission page
├── lecadmission.html       # Lecturer admission page
│
├── course.html             # Course information page
├── blog.html               # Blog page
├── lms.html                # LMS main page
│
├── main.css                # Main stylesheet
├── main.js                 # JavaScript functionality
│
├── 1.png                   # Project image
├── 2.png                   # Project image
│
└── README.md               # Project documentation
```

---

# ✨ Key Features

### Student System
- Student registration page
- Student admission page
- Form submission using PHP

### Lecturer System
- Lecturer admission page

### Academic Pages
- Course information page
- LMS page
- Blog page

### Interface
- Clean university-style UI
- Simple navigation system
- Form-based interaction


---

## 🚀 Installation Guide

### 1️⃣ Clone the repository

```bash
git clone https://github.com/TechAkii/KAUFA-University.git
```

---

### 2️⃣ Move the project to local server

#### For WAMP

```
C:\wamp64\www\
```

#### For XAMPP

```
C:\xampp\htdocs\
```

---

### 3️⃣ Start server

Start:

- Apache  
- MySQL  

---

### 4️⃣ Open in browser

```
http://localhost/KAUFA-University
```

---

## 🗄️ Database Setup

### 1. Create database

Open **phpMyAdmin → SQL tab**, then run:

```sql
CREATE DATABASE kaufa_university;
USE kaufa_university;
```

---

### 2. Create tables

```sql
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE lecturers (
    lecturer_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    department VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

### 3. Database connection (PHP)

Create `db.php`:

```php
<?php
$conn = mysqli_connect("localhost", "root", "", "kaufa_university");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

---

# 🎯 Learning Objectives

This project helps developers understand:

- Web application structure
- Frontend and backend interaction
- LMS system architecture
- Form processing using PHP
- GitHub project deployment

---

# 👨‍💻 Author

**Akila Thikshana**

BSc Applied Science Undergraduate  
Rajarata University of Sri Lanka

GitHub:  
```
https://github.com/TechAkii
```
---

# ⭐ Support

If you like this project, please consider giving it a **star ⭐ on GitHub.

---

# 📜 License

This project is open-source**.
