# Taskito

Taskito is a simple yet powerful dashboard designed to manage an API exposed by a mobile application. The project aims to promote collaboration and productivity among team members, encouraging competition through task-based point systems. By breaking down larger projects into smaller, manageable tasks, Taskito helps teams work efficiently while staying motivated.

## Features

### Task Management
- **Task CRUD Operations:** Create, read, update, and delete tasks with ease.
- **Nested Tasks:** Break down big projects into smaller, actionable tasks.

### Task History
- Track task completion history.
- View details about who finished the task and when.

### Task Hints and Points
- **Hints System:** Each task can include hints. Opening a hint reduces the task's points by a specified amount set by the admin.
- **Points System:** Tasks are assigned points to encourage competition and reward effort.

### Task Assignment
- Tasks are not pre-assigned. Instead, team members can claim tasks they want to work on by confirming their choice.

### Real-Time Updates
- **Pusher Integration:** Real-time updates for task status and team activity, ensuring everyone is always up-to-date.

## Purpose

This project is part of a graduation initiative to motivate my graduation team members to excel by introducing a competitive yet collaborative environment. It enables:
1. Transparent task management and tracking.
2. Breaking down complex projects into smaller, achievable goals.
3. Encouraging self-driven task ownership.

## Technologies Used

- **Backend:** Laravel (or your preferred backend framework)
- **Frontend:** Tailwind CSS framework for styling
- **Database:** MySQL for data storage
- **Real-Time Updates:** Pusher for real-time notifications and updates
- **API Integration:** Facilitates seamless interaction between the dashboard and the mobile application.

## Installation and Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/Mig0o0/taskito.git
   cd taskito

2. Install dependencies:
   ```bash
   composer install
   npm install

3. Configure environment variables:
   Copy the `.env.example` file to `.env` and update the required settings, including your Pusher credentials and database configuration.

4. Run migrations:
   ```bash
   php artisan migrate

5. Start the development server:
   ```bash
   php artisan serve
   npm run dev

6. Access the application:
   Open your browser and navigate to `http://localhost:8000`.

## Usage

1. Log in as an admin to create and manage tasks.
2. Team members can view available tasks and claim ones they wish to complete.
3. Track the progress and history of tasks to ensure accountability and transparency.
4. Enjoy real-time updates on task progress via Pusher.

## Contributing

We welcome contributions to improve Taskito! To contribute:
1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Submit a pull request detailing your changes.

## License

This project is licensed under the MIT License.

---

Taskito is more than just a task manager—it's a motivational tool for teams to achieve their goals together. Let's build great things!
