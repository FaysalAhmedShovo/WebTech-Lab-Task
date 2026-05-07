CREATE DATABASE student_db;

USE student_db;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    department VARCHAR(100),
    email VARCHAR(255),
    cgpa FLOAT
);