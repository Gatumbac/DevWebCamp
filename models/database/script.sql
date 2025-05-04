CREATE DATABASE DEVWEBCAMP;
USE DEVWEBCAMP;

CREATE TABLE USERS (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL,
	confirmed TINYINT DEFAULT 0,
    admin TINYINT DEFAULT 0,
	token VARCHAR(15) DEFAULT NULL
); 

CREATE TABLE SPEAKERS ( 
	id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(40) NOT NULL,
    lastname VARCHAR(40) NOT NULL,
    city VARCHAR(20) NOT NULL,
    country VARCHAR(20) NOT NULL,
    image VARCHAR(32) DEFAULT NULL,
    tags VARCHAR(120) DEFAULT NULL,
    networks TEXT DEFAULT NULL
);

CREATE TABLE CATEGORIES (
  id int AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(45) NOT NULL
);

INSERT INTO CATEGORIES (name) VALUES ('Conferencia'), ('Workshop');

CREATE TABLE DAYS (
  id int AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(15) NOT NULL
);

INSERT INTO DAYS (name) VALUES ('Viernes'), ('Sábado');

CREATE TABLE HOURS (
  id int AUTO_INCREMENT PRIMARY KEY,
  hour VARCHAR(13) NOT NULL
);

INSERT INTO HOURS (hour) VALUES
('10:00 - 10:55'),
('11:00 - 11:55'),
('12:00 - 12:55'),
('13:00 - 13:55'),
('16:00 - 16:55'),
('17:00 - 17:55'),
('18:00 - 18:55'),
('19:00 - 19:55');

CREATE TABLE EVENTS (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  seat_quantity INT NOT NULL DEFAULT 50,
  category_id INT NOT NULL,
  day_id INT NOT NULL,
  hour_id INT NOT NULL,
  speaker_id INT NOT NULL,
  INDEX idx_events_category (category_id),
  INDEX idx_events_day (day_id),
  INDEX idx_events_hour (hour_id),
  INDEX idx_events_speaker (speaker_id),
  CONSTRAINT fk_events_categories FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE RESTRICT,
  CONSTRAINT fk_events_days FOREIGN KEY (day_id) REFERENCES days (id) ON DELETE RESTRICT,
  CONSTRAINT fk_events_hours FOREIGN KEY (hour_id) REFERENCES hours (id) ON DELETE RESTRICT,
  CONSTRAINT fk_events_speakers FOREIGN KEY (speaker_id) REFERENCES speakers (id) ON DELETE RESTRICT,
  CONSTRAINT unique_event_schedule UNIQUE (day_id, hour_id, category_id),
  CONSTRAINT chk_seat_quantity CHECK (seat_quantity >= 0)
);
