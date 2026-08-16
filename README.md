# 🧸 KidzCare - E-Commerce Platform for Kid's Care & Products

![PHP](https://img.shields.io/badge/PHP-7.4%2B%20%2F%208.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-UI-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

**KidzCare** is a full-featured PHP and MySQL e-commerce web application designed for selling kids' apparel, toys, accessories, and baby care products. It includes a user-facing shopping storefront and a powerful admin control dashboard for inventory and order management.

---

## 📌 Features

### 🛍️ User Storefront
* **Product Catalog & Categorization**: Browse products by main categories and sub-categories with filtering and search capabilities.
* **Product Details**: Multi-image view, detailed description, pricing (MRP vs Discounted Price), and stock status.
* **Shopping Cart & Wishlist**: Real-time cart management, quantity updates, and user wishlist functionality.
* **User Authentication**: Secure user registration, login, profile management, and OTP verification via email.
* **Checkout & Payment Options**: Support for Cash on Delivery (COD) and PayU Payment Gateway integration.
* **Order History & Invoices**: View past orders, order status tracking, and downloadable PDF invoices.

### 🛡️ Admin Dashboard
* **Category & Sub-Category Management**: Add, edit, enable/disable categories and sub-categories.
* **Product Management**: Full CRUD operations for products including image uploads, pricing, inventory stock, and best-seller tagging.
* **Banner Management**: Dynamic promotional banner management for the homepage.
* **Order Management**: Monitor customer orders, update order fulfillment status (Pending, Processing, Shipped, Canceled, Complete), and view transaction details.
* **User & Review Management**: View registered users, customer inquiry messages, and product reviews.

---

## 🔑 Login Credentials

### 👨‍⚖️ Admin Panel Login
* **URL**: `http://localhost/kidzcare/admin/` or `http://localhost/kidzcare/admin/login.php`
* **Username**: `admin`
* **Password**: `admin`

### 👤 Sample User Credentials
* **URL**: `http://localhost/kidzcare/login.php`

| Role | Email | Password |
| :--- | :--- | :--- |
| **Demo User 1** | `jhav668@gmail.com` | `admin` |
| **Demo User 2** | `amir@gmail.com` | `amit` |

> 💡 *New users can also register freely on the storefront registration page.*

---

## 🛠️ Prerequisites & Requirements

Before setting up the project, make sure you have the following installed:
* **Web Server**: Apache Web Server (XAMPP, WAMP, MAMP, or LAMP stack)
* **PHP**: PHP 7.4 or PHP 8.x
* **Database**: MySQL / MariaDB Server (with phpMyAdmin recommended)
* **Git**: Installed on your system for repository cloning

---

## ⚙️ Installation & Setup Instructions

### Step 1: Clone the Repository
Clone the project into your web server's root directory (e.g., `htdocs` for XAMPP or `/var/www/html` for Linux Apache).

```bash
# Navigate to web root directory
cd /path/to/htdocs

# Clone the repository
git clone https://github.com/your-username/kidzcare.git kidzcare
```

---

### Step 2: Database Import
1. Start **Apache** and **MySQL** services in XAMPP / WAMP.
2. Open **phpMyAdmin** in your browser (`http://localhost/phpmyadmin`).
3. Create a new database named **`kidzCare`**.
4. Select the `kidzCare` database and go to the **Import** tab.
5. Choose the database dump file **`kidzCare.sql`** located in the root of the project folder.
6. Click **Go** / **Import** to execute the SQL file and create the required tables and sample data.

---

### Step 3: Configure Database & Path Settings
Open the database connection files and verify/update your MySQL credentials and site URL:

1. **Root Connection File**: [`connection.inc.php`](file:///home/vivek/Backend/kidzcare/connection.inc.php)
2. **Admin Connection File**: [`admin/connection.inc.php`](file:///home/vivek/Backend/kidzcare/admin/connection.inc.php)

Verify the credentials inside both files:

```php
<?php
session_start();

// Database Connection Settings
$db_host = "localhost";
$db_user = "root";
$db_pass = ""; // Enter your MySQL root password if any
$db_name = "kidzCare";

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Path Configurations
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/kidzcare/');
define('SITE_PATH', 'http://localhost/kidzcare/');

define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH . 'media/product/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . 'media/product/');

define('BANNER_SERVER_PATH', SERVER_PATH . 'media/banner/');
define('BANNER_SITE_PATH', SITE_PATH . 'media/banner/');
?>
```

---

### Step 4: Run the Application
Open your web browser and navigate to:
* **Storefront**: `http://localhost/kidzcare/`
* **Admin Dashboard**: `http://localhost/kidzcare/admin/`

---

## 📂 Project Directory Structure

```text
kidzcare/
├── admin/                      # Admin Panel Directory
│   ├── assets/                 # Admin CSS, JS, Fonts
│   ├── categories.php          # Manage categories
│   ├── connection.inc.php      # Admin database connection config
│   ├── functions.inc.php       # Admin helper functions
│   ├── index.php / login.php   # Admin authentication & dashboard
│   ├── manage_product.php      # Add / Edit products
│   └── order_master.php        # Manage customer orders
├── css/                        # Frontend Stylesheets
├── images/                     # UI Icons & Graphic assets
├── js/                         # Frontend JavaScript & jQuery scripts
├── media/                      # Uploaded Product & Banner images
│   ├── banner/
│   └── product/
├── smtp/                       # Mailer / SMTP components
├── vendor/                     # Third-party libraries (FPDF, PHPMailer)
├── connection.inc.php          # Main database connection file
├── ecom13.sql                  # Database SQL Dump script
├── functions.inc.php           # Common helper & SQL sanitization functions
├── index.php                   # Storefront Homepage
├── product.php                 # Product details page
├── cart.php / checkout.php     # Cart & Checkout processing
├── login.php                   # User login & registration
└── README.md                   # Project documentation
```

---

## 🧪 Tech Stack Summary

* **Backend**: PHP (Procedural with MySQLi)
* **Frontend**: HTML5, CSS3, JavaScript, jQuery, Bootstrap
* **Database**: MySQL / MariaDB
* **Integrations**: FPDF (Invoice generation), PayU Money (Payment Gateway), PHPMailer / SMTP (OTP & Order emails)

---

## 🤝 Contributing

Contributions are welcome! If you'd like to improve the project or report an issue:
1. Fork the Repository
2. Create a Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git checkout origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open-source under the [MIT License](LICENSE).
