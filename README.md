# TGSOKRI - Travel Booking System

A comprehensive airline and travel booking management system built with Laravel. This application provides an intuitive interface for managing airline schedules, flight bookings, and customer reservations.

## 🛫 Features

### For Administrators

-   **Flight Management**: Add, edit, and manage airplane information
-   **Schedule Management**: Create and manage flight schedules
-   **Booking Management**: View, accept, reject, and cancel customer bookings
-   **User Management**: Manage customer and admin accounts
-   **Dashboard**: Overview of all system activities

### For Customers

-   **Flight Search**: Browse available flights by airline and schedule
-   **Booking Management**: Book flights and manage reservations
-   **Booking History**: View past and current bookings
-   **Profile Management**: Update personal information and password

## 🚀 Technologies Used

-   **Backend**: Laravel 8.x
-   **Frontend**: Blade Templates with Bootstrap
-   **Database**: MySQL
-   **Authentication**: Laravel's built-in authentication system

## 📋 Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Configure `.env` file with your database settings
4. Import the database schema from `database/travel.sql`
5. Run the application: `php artisan serve`

## 🔧 Database Setup

### Using Navicat/MySQL Workbench

1. Create database named `travel` (or your preferred name)
2. Import `database/travel.sql` file
3. Update your `.env` file with database credentials

### Quick SQL Commands

```sql
-- Create database
CREATE DATABASE travel;

-- Import the SQL file or run the setup scripts provided
```

## 🔑 Admin Login

<details>
<summary><strong>👤 Click to reveal Admin Credentials</strong></summary>

| Field               | Value                        |
| ------------------- | ---------------------------- |
| **Username**        | `admin`                      |
| **Password**        | `okri123`                    |
| **Login URL**       | `/admin.php` or `/login.php` |
| **Admin Dashboard** | `/booking.php`               |

</details>

## 📂 Application Structure

```
├── app/Http/Controllers/
│   ├── UserController.php      # User authentication and management
│   ├── AirplaneController.php  # Flight management
│   ├── BookingController.php   # Booking operations
│   └── ScheduleAirplaneController.php # Flight scheduling
├── database/
│   ├── travel.sql              # Database schema and sample data
│   └── migrations/             # Laravel migrations
├── resources/views/
│   ├── admin/                  # Admin panel views
│   └── layouts/                # Application layouts
└── routes/web.php              # Application routes
```

## 🎯 Main Modules

### 1. Flight Management

-   Add/edit airline information
-   Manage flight details (capacity, type, etc.)
-   Track flight performance

### 2. Schedule Management

-   Create flight schedules
-   Set departure and arrival times
-   Manage recurring flights

### 3. Booking System

-   Customer flight booking
-   Real-time availability checking
-   Booking confirmation and management

### 4. User Management

-   Admin and customer roles
-   User registration and authentication
-   Profile management

## 🔐 Security Features

-   Role-based access control (Admin/Customer)
-   Password encryption using MD5 hashing
-   Session-based authentication
-   Input validation and sanitization

## 🌐 Access URLs

-   **Home Page**: `/`
-   **Admin Login**: `/admin.php` or `/login.php`
-   **Customer Registration**: `/register.php`
-   **Admin Dashboard**: `/booking.php` (requires admin login)
-   **Customer Bookings**: `/booking_customer_form.php` (requires customer login)
-   **Booking History**: `/history.php` (customers only)
-   **Password Change**: `/changePassword.php` (requires login)

**Note**: This is a custom travel booking system built on Laravel framework, not a standard Laravel application template.
