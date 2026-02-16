# 🍔 Food Strong Ecommerce API – Laravel Backend System

## 🚀 Project Overview
**Food Ecommerce API** is a **Back-End only** application built with **Laravel** that powers a complete food ordering platform similar to Uber Eats or Talabat.

The system supports:
- Multi-restaurant architecture
- Role-based access control
- Cart & checkout flow
- Fake payment simulation
- Wallet & transaction balance system

This API is designed to be:
- ⚡ Fast & scalable
- 🔐 Secure
- 🧠 Clean & maintainable
- 🔌 Frontend-agnostic (React / Next.js / Angular / Mobile Apps)
- 🧪 Fully testable using Postman

---

## 🏗 System Architecture
- RESTful API
- Laravel Sanctum Authentication
- Role & Permission Middleware
- PostgreSQL Database
- Clear separation of concerns (Models, Requests, Controllers)

---

## 👤 Authentication & Users
- User registration & login
- Token-based authentication (Laravel Sanctum)
- Get authenticated user profile
- Admin user management
- Role assignment & update

### User Roles
- `Customer`
- `Admin`
- `Restaurant Owner`
- `Delivery`

---

## 🏪 Restaurants
- Create restaurant (Restaurant Owner)
- Update restaurant
- Delete restaurant
- View all restaurants
- View single restaurant with details

---

## 🗂 Categories
- Create category per restaurant
- Update category
- Delete category
- Get restaurant categories

---

## 🍽 Products
- Create product
- Update product
- Delete product
- Get products by restaurant
- Get single product details

---

## ➕ Product Options
- Create product options (extras, sizes, add-ons)
- Update product options
- Delete product options
- Attach options to cart items & orders

---

## 🛒 Cart System
- One cart per restaurant per user
- Create cart
- View cart by restaurant
- Delete cart
- Add items to cart
- Update cart item quantity
- Remove cart items

### Cart Item Options
- Add options to cart item
- Remove options from cart item

---

## 📦 Orders
- Create order from cart
- Convert cart items into order items
- Get all orders (Admin / Customer)
- Get single order details
- Update order (Admin)
- Delete order (Admin)

---

## 📑 Order Items
- Create order items
- Update order item
- Delete order item
- Attach options to order items

---

## 💳 Payment System (Fake Payment)
- Simulated payment process
- Payment linked to order
- Prevent payment if balance is insufficient
- Store payment history
- Clear cart after successful payment

---

## 💰 Wallet & Transactions
- User wallet balance
- Recharge wallet (Fake transaction)
- Store transaction history
- Track:
  - Amount
  - Type (recharge / payment)
  - Balance before & after
  - Description

---

## 🏠 Addresses
- Create address
- Update address
- Delete address
- List user addresses
- Use address during order creation

---

## 🚚 Delivery
- Delivery role can update order status
- Status flow:
  - pending
  - preparing
  - on_the_way
  - delivered
  - cancelled

---

## 🛡 Role-Based Access Control

| Role              | Permissions |
|-------------------|------------|
| Customer          | Cart, Orders, Payments, Transactions |
| Restaurant Owner  | Restaurants, Categories, Products |
| Delivery          | Update order status |
| Admin             | Full system control |

Authorization handled using:
- Laravel Sanctum
- Role Middleware
- Route-level protection

---

## 🔗 API Routes Overview

### Auth
- `POST /auth/register`
- `POST /auth/login`
- `GET  /me`

---

### Cart
- `POST   /cart/create`
- `GET    /cart/{restaurant}`
- `DELETE /cart/delete/{restaurant}`

---

### Orders
- `POST /order/create`
- `GET  /orders`
- `GET  /order/{order}`

---

### Payment
- `POST /payment`
- `GET  /payment`

---

### Transactions
- `POST /transaction/recharge`
- `GET  /transactions`

---

## ⚙️ Installation & Setup

### Requirements
- PHP 8+
- Composer
- PostgreSQL
- Git

---

### Installation Steps

```bash
git clone https://github.com/ZenZN99/food-ecommerce-api
cd food-ecommerce-api
bash
Copy code
composer install
bash
Copy code
cp .env.example .env
php artisan key:generate
Configure your database in .env

bash
Copy code
php artisan migrate
php artisan serve
Server will run at:

cpp
Copy code
http://127.0.0.1:8000
🧪 Testing
Fully testable using Postman

Token-based authorization

Clean and predictable API responses

🔮 Future Enhancements
Real payment gateway integration

Order notifications

Restaurant analytics dashboard

Rating & reviews system

Coupons & promotions

API documentation (Swagger / OpenAPI)

👨‍💻 Author
Zen Allaham
Backend / Full-Stack Developer
Laravel • Node.js • NestJS • PostgreSQL

📜 License
MIT License © 2026 Zen Allaham
