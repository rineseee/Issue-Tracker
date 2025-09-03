# TrackLite – Mini Issue Tracker

A simple Laravel 11 application for managing **Projects, Issues, Tags, and Comments**.  
Designed for a small development team to:

- Create and manage projects
- Report and track issues
- Add tags and comments (AJAX)
- Filter issues by status, priority, and tags

---

## 🚀 Features

### Projects
- CRUD (list, create, edit, delete)
- Extra columns: `start_date`, `deadline`
- Show project with its related issues

### Issues
- CRUD with filters (status, priority, tag)
- Many-to-many with Tags
- Optional many-to-many with Users (assignment)
- Detailed view with tags and comments

### Tags
- CRUD + list
- Attach/detach to issues via **AJAX** (no page reload)
- Modal for quick selection

### Comments
- AJAX only
- Paginated list (lazy load with *Load more*)
- Validation with **FormRequest**
- Prepend new comments directly to the list after submit

---

## 🛠️ Bonus Features
- Policies → only project owners can edit/delete
- Assign multiple users to issues (many-to-many)
- Search issues (title/description) with debounce (AJAX)

---

## ⚡ Tech Stack
- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** Blade + Bootstrap 5 + CSS + JavaScript (AJAX)
- **Database:** SQLite / MySQL
- **Testing:** PHPUnit

---

## 📦 Setup

1. **Clone repository**
   ```bash
   git clone https://github.com/rineseee/Issue-Tracker
   cd tracklite
Install dependencies

bash
Copy code
composer install
npm install && npm run build
Configure environment

bash
Copy code
cp .env.example .env
php artisan key:generate
Update .env → set DB_CONNECTION to sqlite or mysql.

For SQLite:

bash
Copy code
touch database/database.sqlite
Run migrations + seeders

bash
Copy code
php artisan migrate --seed
Start server

bash
Copy code
php artisan serve
Open in browser: http://localhost:8000

🧪 Testing
Run feature and unit tests:

bash
Copy code
php artisan test
Covers:

CRUD Projects

Issue filtering

Tag attach/detach (AJAX)

Add Comments (AJAX)

👩‍💻 Contributors
Rinesa Krasniqi – Developer# Issue-Tracker
"# Issue-Tracker" 
