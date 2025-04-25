# PHP_CRUD

This project is a RESTful API built using **PHP** and **MySQL**, designed to manage **Products** and **Product Categories** with full **CRUD** (Create, Read, Update, Delete) functionality. The API uses **JWT (JSON Web Tokens)** for secure request authorization and is tested using **Postman**.

---

## 📁 Project Structure

```
/product_api
│
├── auth/
│   ├── login.php              # User login and token generation
│   ├── register.php           # User registration
│   └── jwt_validation.php     # JWT verification logic
│
├── config/
│   └── db.php                 # Database connection using PDO
│
├── api/
│   ├── category/
│   │   ├── create.php         # Create a new category
│   │   ├── read.php           # Fetch all categories
│   │   ├── update.php         # Update an existing category
│   │   └── delete.php         # Delete a category
│   │
│   ├── product/
│   │   ├── create.php         # Create a new product
│   │   ├── read.php           # Fetch products (with optional category filter)
│   │   ├── update.php         # Update product details
│   │   └── delete.php         # Delete a product
│   │
│   ├── init.php               # Loads DB, JWT, and middleware
│   ├── category.php           # Acts as router/controller for categories
│   ├── product.php            # Acts as router/controller for products
│   └── category_id.php        # Fetch products by category ID
│
├── composer.json              # Composer dependencies
├── composer.lock              # Locked composer dependencies
├── vendor/                    # Auto-loaded packages (e.g., firebase/php-jwt)
```

---

## 🌐 API Endpoints

### 🛂 Authentication

- `POST http://localhost/product-api/auth/login.php` - Login and receive JWT token
- `POST http://localhost/product-api/auth/register.php` - Register a new user

### 📦 Product APIs

(All methods use the same URL with different HTTP verbs)

- `GET/POST/PUT/DELETE http://localhost/product-api/api/product.php`

### 🗂 Category APIs

(All methods use the same URL with different HTTP verbs)

- `GET/POST/PUT/DELETE http://localhost/product-api/api/category.php`

---

## 🔧 Technologies Used

- PHP (Core)
- MySQL (Database)
- PDO (PHP Data Objects)
- Firebase PHP-JWT (JWT Handling)
- Postman (API testing)
- Apache (via XAMPP)

---

## 🛠 Installation Guide

### Step-by-Step:

1. **Install XAMPP** (if not already installed)

2. **Install Composer-Setup.exe** (dependency manager for PHP) 

3. **Clone this repository** or download the zip

4. **Copy the ************************************************************`product-api`************************************************************ folder** into the `htdocs` directory inside your XAMPP installation

5. Open terminal or CMD and cd to root directory for project and run this command for 'composer require firebase/php-jwt'

6. **Start Apache and MySQL** using the XAMPP Control Panel

7. **Open browser** and go to `localhost`, then open **phpMyAdmin**

8. **Create a database** (e.g., `product_db`) and import/create the necessary tables:

   - `users`
   - `category`
   - `product`

9. **Test using Postman** with the endpoints:

   - `http://localhost/product-api/auth/login.php`
   - `http://localhost/product-api/auth/register.php`
   - `http://localhost/product-api/api/product.php`
   - `http://localhost/product-api/api/category.php`

> All API requests (except register/login) require a **JWT token** in the headers:

```
Authorization: Bearer <your_token_here>
```

---

## 🧪 Testing with Postman

### Category APIs

1. **POST** `/api/category.php` to create a category.
2. **GET** `/api/category.php` to list categories.
3. **PUT** `/api/category.php` to update a category (provide fields in JSON).
4. **DELETE** `/api/category.php` to delete a category (pass ID in JSON).
5. **GET** `/api/category.php?category_id=1` to filter products by category.

### Product APIs

1. **POST** `/api/product.php` to add a product (provide fields in JSON).
2. **GET** `/api/product.php` to list products.
3. **PUT** `/api/product.php` to update product (provide fields in JSON).
4. **DELETE** `/api/product.php` to delete product (pass ID in JSON).

Make sure to pass the token in the `Authorization` header.

---

