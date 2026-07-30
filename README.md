# 🛒 FreshBazar - Premium Organic Grocery Platform

**FreshBazar** is a high-end eCommerce solution built with Laravel (Laravel 12), featuring a premium Emerald Green design and an integrated advanced admin dashboard.

---

## 🚀 Full Setup Guide

### Step 1: Install Required Software
Make sure the following software is installed on your PC:

1. **XAMPP** (PHP 8.1+ required)  
Download: https://www.apachefriends.org/index.html

2. **Composer**  
Download: https://getcomposer.org/download/

3. **Node.js**  
Download: https://nodejs.org/

---

### Step 2: Open the Project Folder and Terminal
After downloading the project, open the project folder (for example: `package`) in your code editor (VS Code recommended).

Then open the integrated terminal inside the editor.

---

### Step 3: Install PHP and JavaScript Dependencies
Run the following commands one by one:

```bash
# Install all Laravel dependencies
composer install

# Install frontend and CSS packages
npm install
```

---

### Step 4: Configure Environment File (.env)
In the root project folder, you will find a file named `.env.example`.

Copy it and create a new file named `.env`

Or run:

```bash
cp .env.example .env

# Generate application security key
php artisan key:generate
```

---

### Step 5: Database Setup (SQLite)
This project uses **SQLite** by default, so no separate MySQL setup is required.

Run:

```bash
# Create database tables
php artisan migrate

# Seed admin and test data (very important)
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=ProductSeeder

# Create storage link for product images (required)
php artisan storage:link
```

---

### Step 6: Run the Project

```bash
# Start development server
php artisan serve
```

Then open:

`http://127.0.0.1:8000`

---

## 🔐 Login Credentials (Test Accounts)

If everything is configured correctly, use the following test accounts:

### 1. Admin Account (Admin Access)

**URL:**  
http://127.0.0.1:8000/login

**Email:**  
admin@grocery.com

**Password:**  
password

**Features:**
- Admin Dashboard Access  
- Product Management  
- Sales Reports  
- Order Management

---

### 2. Customer Account (Customer Access)

**Email:**  
user@grocery.com

**Password:**  
password

**Features:**
- Online Shopping  
- Cart Access  
- Personal Dashboard  
- Order Tracking

---

## 🛠️ Troubleshooting

### Images Not Showing?
Make sure you ran:

```bash
php artisan storage:link
```

---

### Design/Styles Not Loading Properly?
Run:

```bash
npm run dev
```

Or build assets once:

```bash
npm run build
```

---

### Database Error?
Make sure your `.env` file contains:

```env
DB_CONNECTION=sqlite
```

---

## ✨ Core Features

- **Emerald Green UI**  
Premium modern look with glassmorphism effects

- **Order Tracking**  
Track orders from customer dashboard

- **Admin Control**  
Invoice printing, status updates, and CSV export

- **Responsive Design**  
Optimized for both mobile and desktop

---
