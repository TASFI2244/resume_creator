CREATE DATABASE user_data;

USE user_data;

-- Table for Registration Information
CREATE TABLE registration (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(255),
  contact_info VARCHAR(255),
  photo VARCHAR(255),
  short_bio TEXT
);

-- Table for Skills
CREATE TABLE skills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  soft_skills TEXT,
  technical_skills TEXT,
  FOREIGN KEY (user_id) REFERENCES registration(id)
);

-- Table for Academic Background
CREATE TABLE academy (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  institute VARCHAR(255),
  degree VARCHAR(255),
  year INT,
  grade VARCHAR(50),
  FOREIGN KEY (user_id) REFERENCES registration(id)
);

-- Table for Work Experience
CREATE TABLE experience (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  company_name VARCHAR(255),
  job_duration VARCHAR(255),
  job_responsibilities TEXT,
  FOREIGN KEY (user_id) REFERENCES registration(id)
);

-- Table for Previous Projects or Publications
CREATE TABLE previous_projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  project_title VARCHAR(255),
  publication_title VARCHAR(255),
  description TEXT,
  FOREIGN KEY (user_id) REFERENCES registration(id)
);
