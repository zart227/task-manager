-- Заполнение таблицы пользователей
INSERT INTO users (username, email, password, created_at)
VALUES
('JohnDoe', 'john@example.com', '$2y$10$w8R9s4uzhRyOZgFGzxdXSOoaRX2WztPl74De.ML', NOW()), -- пароль зашифрован
('JaneDoe', 'jane@example.com', '$2y$10$eDo62xlOEe7xRPg7R7VqsuopmxxWXtfYqg', NOW()), -- пароль зашифрован
('SamSmith', 'sam@example.com', '$2y$10$uFRRqgp/NKc8X1HFuZ9g.MxzmFYJ5wPlK7Fv', NOW()), -- пароль зашифрован
('AlexJohnson', 'alex@example.com', '$2y$10$PdJTYWIXEDc7SJNa2BZ.EY6uJNzAdg5', NOW()), -- пароль зашифрован
('ChrisLee', 'chris@example.com', '$2y$10$MYxPlUZFAKxjGMSJNTZJVE7pOjEKbA', NOW()); -- пароль зашифрован

-- Заполнение таблицы задач
INSERT INTO tasks (name, description, user_id, parent_id, status, created_at, updated_at)
VALUES
-- Задачи для JohnDoe (user_id = 1)
('Task 1', 'This is the first task for JohnDoe', 1, NULL, 'in_progress', NOW(), NOW()),
('Subtask 1.1', 'This is a subtask of Task 1', 1, 1, 'completed', NOW(), NOW()),
('Subtask 1.2', 'Another subtask of Task 1', 1, 1, 'in_progress', NOW(), NOW()),
('Subtask 1.1.1', 'Nested subtask of Subtask 1.1', 1, 2, 'in_progress', NOW(), NOW()),

-- Задачи для JaneDoe (user_id = 2)
('Task 2', 'This is the first task for JaneDoe', 2, NULL, 'in_progress', NOW(), NOW()),
('Subtask 2.1', 'Subtask of Task 2 for JaneDoe', 2, 5, 'completed', NOW(), NOW()),
('Subtask 2.1.1', 'Deeply nested task for JaneDoe', 2, 6, 'in_progress', NOW(), NOW()),
('Task 3', 'This is another task for JaneDoe', 2, NULL, 'completed', NOW(), NOW()),

-- Задачи для SamSmith (user_id = 3)
('Task 4', 'This is the first task for SamSmith', 3, NULL, 'in_progress', NOW(), NOW()),
('Subtask 4.1', 'Subtask of Task 4', 3, 9, 'in_progress', NOW(), NOW()),
('Task 5', 'Another task for SamSmith', 3, NULL, 'completed', NOW(), NOW()),

-- Задачи для AlexJohnson (user_id = 4)
('Task 6', 'Main task for AlexJohnson', 4, NULL, 'in_progress', NOW(), NOW()),
('Subtask 6.1', 'Subtask of Task 6', 4, 12, 'completed', NOW(), NOW()),
('Subtask 6.1.1', 'Subtask of Subtask 6.1', 4, 13, 'in_progress', NOW(), NOW()),
('Task 7', 'Second main task for AlexJohnson', 4, NULL, 'completed', NOW(), NOW()),

-- Задачи для ChrisLee (user_id = 5)
('Task 8', 'First task for ChrisLee', 5, NULL, 'in_progress', NOW(), NOW()),
('Subtask 8.1', 'Subtask for Task 8', 5, 16, 'completed', NOW(), NOW()),
('Task 9', 'Another task for ChrisLee', 5, NULL, 'in_progress', NOW(), NOW()),
('Subtask 9.1', 'Subtask of Task 9', 5, 18, 'in_progress', NOW(), NOW()),
('Subtask 9.1.1', 'Nested subtask of Subtask 9.1', 5, 19, 'in_progress', NOW(), NOW());
