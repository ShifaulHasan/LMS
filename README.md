# 📚 Library Management System (LMS)

A web-based **Library Management System** built with **raw PHP and MySQL** (no frameworks) as a lab project for the **Database Management System** course. It lets library admins manage the book collection and lets registered users search, rent, and track books.

---

## ✨ Features

### 👤 User
- Register and log in
- Browse available books
- Search books
- Rent a book and view rented books
- View rent details
- View and edit profile, change password
- Logout

### 🛠️ Admin
- Separate admin login
- Add new books
- Manage books (edit / delete / update stock)
- View book rent details
- Admin profile and password management

---

## 🧰 Tech Stack

| Layer       | Technology                  |
|-------------|-----------------------------|
| Backend     | PHP (procedural, no framework) |
| Database    | MySQL / MariaDB             |
| Frontend    | HTML, CSS                   |
| Local server| XAMPP / WAMP / LAMP         |

---

## 📁 Project Structure

```
LMS/
├── lms_db.sql            # Database schema (import this first)
├── Home.php              # Landing / home page
├── aboutus.php           # About page
├── registration.php      # User registration
├── userlogin.php         # User login
├── AdminLogin.php        # Admin login
├── UserProfile.php       # User profile
├── AdminProfile.php      # Admin profile
├── EditProfile.php       # Edit profile form
├── update_profile.php    # Handles profile update
├── ChangePassword.php    # Change password
├── AddBook.php           # Admin: add a book
├── ManageBook.php        # Admin: manage books
├── AvailableBooks.php    # List of available books
├── SearchBook.php        # Search books
├── RentABook.php         # Rent a book
├── RentedBook.php        # Books rented by the user
├── BookRentDetails.php   # Rent details
├── logout.php            # User logout
└── logout2.php           # Admin logout
```

---

## 🚀 Getting Started

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) (or any Apache + PHP + MySQL stack)
- A web browser

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ShifaulHasan/LMS.git
   ```

2. **Move the project** into your server's web root
   - XAMPP: `C:/xampp/htdocs/LMS`

3. **Start Apache and MySQL** from the XAMPP Control Panel.

4. **Create the database**
   - Open [phpMyAdmin](http://localhost/phpmyadmin)
   - Create a new database (e.g. `lms_db`)
   - Go to **Import** and select `lms_db.sql`

5. **Check the database connection**
   Make sure the host, username, password, and database name used in the PHP files match your local setup (XAMPP default: host `localhost`, user `root`, empty password).

6. **Run the project**
   Open in your browser:
   ```
   http://localhost/LMS/Home.php
   ```

---

## 🗄️ Database

The full schema is in [`lms_db.sql`](lms_db.sql). It covers the tables for users, admins, books, and book rentals used by the system.


---

## 🔮 Future Improvements

- Password hashing and prepared statements (SQL injection protection)
- Return date / fine calculation for late returns
- Role-based access control
- Better responsive UI

---

## 👨‍💻 Author

**Md. Shifaul Hasan**
CSE, IUBAT
GitHub: [@ShifaulHasan](https://github.com/ShifaulHasan)

---

## 📄 License

This project was developed for educational purposes as part of a university lab course.
