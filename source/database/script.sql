CREATE TABLE Level (
    level_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE Speciality (
    speciality_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE Class (
    class_id INT PRIMARY KEY AUTO_INCREMENT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    name VARCHAR(100) NOT NULL,
    level_id INT NOT NULL,
    speciality_id INT NOT NULL,
    FOREIGN KEY (level_id) REFERENCES Level(level_id),
    FOREIGN KEY (speciality_id) REFERENCES Speciality(speciality_id)
);

CREATE TABLE Teacher (
    teacher_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    photo_path VARCHAR(255),
    subject VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL
);

CREATE TABLE teaches (
    teacher_id INT NOT NULL,
    class_id INT NOT NULL,
    PRIMARY KEY (teacher_id, class_id),
    FOREIGN KEY (teacher_id) REFERENCES Teacher(teacher_id),
    FOREIGN KEY (class_id) REFERENCES Class(class_id)
);

CREATE TABLE Admin (
    admin_id INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL,
    role VARCHAR(50) NOT NULL
);

CREATE TABLE Students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(150) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    slogan VARCHAR(255),
    photo_path VARCHAR(255),
    is_delegate BOOLEAN DEFAULT FALSE,
    is_alternance BOOLEAN DEFAULT FALSE,
    last_name VARCHAR(100) NOT NULL,
    class_id INT NOT NULL,
    admin_id INT NOT NULL,
    FOREIGN KEY (class_id) REFERENCES Class(class_id),
    FOREIGN KEY (admin_id) REFERENCES Admin(admin_id)
);