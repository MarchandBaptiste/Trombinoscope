CREATE TABLE Level (
    level_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE Speciality (
    speciality_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE Class (
    class_id INT PRIMARY KEY AUTO_INCREMENT,
    start_date DATE,
    end_date DATE,
    name VARCHAR(255),
    level_id INT NOT NULL,
    speciality_id INT,
    FOREIGN KEY (level_id) REFERENCES Level(level_id),
    FOREIGN KEY (speciality_id) REFERENCES Speciality(speciality_id)
);

CREATE TABLE Teacher (
    teacher_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    photo_path VARCHAR(255) NOT NULL,
    subject VARCHAR(255),
    last_name VARCHAR(255)
);

CREATE TABLE Students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    first_name VARCHAR(255),
    slogan VARCHAR(255),
    photo_path VARCHAR(255) NOT NULL,
    is_delegate BOOLEAN,
    is_alternance BOOLEAN,
    last_name VARCHAR(255),
    class_id INT NOT NULL,
    FOREIGN KEY (class_id) REFERENCES Class(class_id)
);

CREATE TABLE Admin (
    admin_id INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255),
    role VARCHAR(255)
);

CREATE TABLE TEACHES (
    teacher_id INT NOT NULL,
    class_id INT NOT NULL,
    PRIMARY KEY (teacher_id, class_id),
    FOREIGN KEY (teacher_id) REFERENCES Teacher(teacher_id),
    FOREIGN KEY (class_id) REFERENCES Class(class_id)
);