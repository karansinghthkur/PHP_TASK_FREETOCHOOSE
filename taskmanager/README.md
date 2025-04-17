# Task Manager — PHP + MariaDB (No Framework)

A secure and user-friendly task management app built using core PHP and MariaDB (No FrameWork), styled with Bootstrap 5. This app allows users to add tasks, view them in a list, mark them as completed, and delete them — all with proper validation, security, and clean UI.

---

##  Features Implemented

- Add new tasks with **title**, **description**, and **due date**
- View tasks sorted by due date (ascending)
- Mark tasks as  completed - Additional Feature
- Delete tasks with confirmation  - Additional Feature
- Show message when no tasks exist -Additional Feature
- Prevent past due dates (server + client side)
- Secure with PDO prepared statements (anti-SQL injection)
- Output escaped with `htmlspecialchars()` (anti-XSS)
- Styled using Bootstrap 5 for a modern UI

---

## Tech Stack & Versions

| Component  | Version             |
| ---------- | ------------------- |
| PHP        | 8.1.12              |
| MariaDB    | 10.4.28             |
| Bootstrap  | 5.3.0 (via CDN)     |
| Web Server | Apache (via XAMPP)  |
| OS Tested  | macOS (XAMPP)       |
| Tools Used | phpMyAdmin, VS Code |

---

## Project Structure

```
task-manager/
|___ add_task.php            # Form to add new tasks
|___ config.php              # DB connection using PDO
|___ delete_task.php         # Deletes a task
|___ list_tasks.php          # Task list with Bootstrap styling
|___ mark_complete.php       # Marks a task as completed
|___ db/
|   |___ schema.sql          # SQL to create the `tasks` table
|___ README.md
```

---

## Installation Steps

### 1. Start Apache & MariaDB

- Open XAMPP (or MAMP)
- Start **Apache** and **MySQL**
- Open `http://localhost/phpmyadmin`

### 2. Create the Database

1. Create a database named `task_db`
2. Import the following schema via SQL tab:

```sql

USE task_db;

 CREATE TABLE IF NOT EXISTS tasks (
          id INT AUTO_INCREMENT PRIMARY KEY,
          title VARCHAR(255) NOT NULL,
          description TEXT NOT NULL,
          due_date DATE NOT NULL,
          completed TINYINT(1) NOT NULL DEFAULT 0,
          INDEX idx_due_date (due_date)
);
```
or 
alternatively it will be automatically created with the config.php whenever you are adding the first task

### 3. Configure DB Connection

Update `config.php` if needed:

```php
$host = 'localhost';
$db   = 'task_db';
$user = 'root';
$pass = '';
```

### 4. Run the App

Place the project inside your web root:

- For XAMPP on macOS: `/Applications/XAMPP/xamppfiles/htdocs/`

Visit these pages:

- **Add Task**: `http://localhost/taskmanager/add_task.php`
- **View Tasks**: `http://localhost/taskmanager/list_tasks.php`

---

## UI Highlights (Bootstrap Styled)

- Form controls with `.form-control` and labels
- Error messages in Bootstrap `.alert-danger`
- Completed tasks shown with **green strike-through**
- Buttons:
  - `Add Task`: `.btn.btn-primary`
  - `View Tasks`: `.btn.btn-outline-secondary`
  - `Mark Completed`: `.btn.btn-success`
  - `Delete`: `.btn.btn-danger`

---

## Security Overview

| Risk Area     | Mitigation Method                        |
| ------------- | ---------------------------------------- |
| SQL Injection | PDO prepared statements                  |
| XSS Attacks   | Output escaped with `htmlspecialchars()` |
| Past Dates    | Checked with PHP + `<input min="...">`   |
| DB Failures   | Graceful error handling with `try/catch` |

---

## Assumptions

- No login or user management (single-user, local tool)
- Date format is `YYYY-MM-DD`
- Deletion is permanent (no soft delete yet)
- App is intended for learning/demo purposes


---

## 👨‍💻 Developed By

**Karan Singh Thakur**  
Passionate about building secure, full-stack applications with clean UIs and efficient code.  
Ready for real-world challenges 💪

Happy coding! 🎉
![image](https://github.com/user-attachments/assets/9c095ce8-3891-4fef-a9e1-ca015e6f4273)

