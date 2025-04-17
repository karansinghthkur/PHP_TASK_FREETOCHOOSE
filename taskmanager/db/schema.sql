-- Create the `tasks` table
USE task_db;
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    due_date DATE NOT NULL,
    completed TINYINT(1) NOT NULL DEFAULT 0,
    INDEX idx_due_date (due_date)
);
