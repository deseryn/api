CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        type VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE IF NOT EXISTS medications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    name VARCHAR(255) NOT NULL,
    dosage INT NOT NULL,
    started_at DATE NOT NULL,
    note TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (name, type) VALUES
('Alice', 'admin'),
('Bob', 'user'),
('Charlie', 'user'),
('David', 'user'),
('Eve', 'admin');

INSERT INTO medications (user_id, name, dosage, started_at, note) VALUES
(1, 'Aspirin', 100, '2023-01-01', 'Take one daily'),
(2, 'Ibuprofen', 200, '2023-02-01', 'Take after meals'),
(3, 'Paracetamol', 500, '2023-03-01', 'Take when needed'),
(4, 'Amoxicillin', 250, '2023-04-01', 'Complete the course'),
(5, 'Metformin', 850, '2023-05-01', 'Take twice daily');
