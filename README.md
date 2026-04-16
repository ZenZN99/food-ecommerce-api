# 🍔 Food Strong – Ecommerce API (Laravel Backend System)

![Project Preview](https://res.cloudinary.com/dgagbheuj/image/upload/v1776327537/gegnrdkkgcb6c1lej4ym.png)

A **scalable backend-only ecommerce API** built with Laravel that powers a full food ordering platform similar to Uber Eats / Talabat.

This system is designed with **clean architecture principles**, role-based access control, and production-ready structure for real-world applications.

---

## 🧠 Overview

Food Strong API is a **multi-restaurant backend system** where users can:

- Browse restaurants and products
- Add items to cart
- Place orders and simulate payments
- Manage wallet balance and transactions
- Track delivery status in real-time flow

It is fully **frontend-agnostic** and can be integrated with:
React, Next.js, Angular, or Mobile apps.

---

## ⚙️ Tech Stack

- **Backend Framework:** Laravel
- **Authentication:** Laravel Sanctum
- **Database:** PostgreSQL
- **Architecture:** RESTful API
- **Security:** Middleware + Role-based access control
- **Testing:** Postman

---

## 🔐 Authentication & Roles

The system supports **role-based access control (RBAC)**:

- `CUSTOMER`
- `ADMIN`
- `RESTAURANT_OWNER`
- `DELIVERY`

### Features

- Secure registration & login
- Token-based authentication (Sanctum)
- Profile management
- Role-based route protection
- Admin user control

---

## 🏪 Restaurant System

- Create / Update / Delete restaurant (Owner)
- View all restaurants
- View restaurant details
- Multi-restaurant support

---

## 🍽 Product System

- Create / Update / Delete products
- Assign products to restaurants
- View products per restaurant
- Product details page

---

## 🗂 Categories System

- Create categories per restaurant
- Manage categories (CRUD)
- Filter products by category

---

## 🛒 Cart System

- One cart per restaurant per user
- Add / update / remove items
- Manage item quantities
- Attach product options (extras, sizes)

---

## 📦 Order System

- Create order from cart
- Convert cart → order items
- View order history
- Admin order management
- Delivery status tracking

### Order Status Flow

- `PENDING`
- `PREPARING`
- `ON_THE_WAY`
- `DELIVERED`
- `CANCELLED`

---

## 💳 Payment System (Fake Payment)

- Simulated payment processing
- Payment linked to orders
- Wallet balance validation
- Cart auto-clear after successful payment
- Payment history tracking

---

## 💰 Wallet & Transactions

- User wallet system
- Recharge wallet (fake transactions)
- Track transaction history
- Store:
  - Amount
  - Type (recharge / payment)
  - Balance before / after
  - Description

---

## 🏠 Address System

- Add / update / delete addresses
- Multiple addresses per user
- Select address during checkout

---

## 🚚 Delivery System

- Delivery role updates order status
- Real-time delivery lifecycle:
  - Preparing → On the way → Delivered

---

## 🛡 Role-Based Access Control

| Role              | Permissions |
|------------------|-------------|
| CUSTOMER         | Cart, Orders, Payments, Wallet |
| RESTAURANT_OWNER | Manage restaurants, products, categories |
| DELIVERY         | Update order status |
| ADMIN            | Full system control |

---

## 🔗 API Structure

```bash id="lf3k9a"
POST   /auth/register
POST   /auth/login
GET    /me

POST   /cart/create
GET    /cart/{restaurant}
DELETE /cart/delete/{restaurant}

POST   /order/create
GET    /orders
GET    /order/{id}

POST   /payment
GET    /payment

POST   /transaction/recharge
GET    /transactions
```

## ⚙️ Installation & Setup
### Requirements
- PHP 8+
- Composer
- PostgreSQL
- Laravel CLI
---
### 1. Clone Repository
```bash
git clone https://github.com/ZenZN99/food-ecommerce-api
cd food-ecommerce-api
```
---
### 2. Install Dependencies
```bash
composer install
```
---
### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```
---
### 4. Run Migrations
```bash
php artisan migrate
```
---
### 5. Run Server
```bash
php artisan serve
```
---
## 🧪 Testing
This project was tested using Postman to ensure full API reliability.

## 🔹 Tools Used
- Postman (API testing)
- PostgreSQL (Database verification)
- Laravel Logs (Debugging)

## 🔹 Tested Modules
- Authentication system (Sanctum)
- Restaurant management
- Product & category system
- Cart operations
- Order lifecycle
- Wallet & payment simulation
- Delivery status flow

## 🔹 Notes
- All endpoints tested with Bearer Token authentication
- Edge cases handled (invalid cart, empty orders, insufficient balance)
- API responses are consistent and structured
---
## 🚀 Future Improvements
- 💳 Real payment gateway integration (Stripe / PayPal)
- 📊 Admin analytics dashboard
- ⭐ Rating & review system
- 🔔 Order notifications system
- 🎟 Coupons & discount system
- 📦 Advanced delivery tracking (real-time GPS)
---

## 📌 Notes
- Built with scalable Laravel architecture
- Fully RESTful API design
- Clean separation of concerns
- Ready for frontend/mobile integration
- Production-ready backend system

## 👨‍💻 Author
Zen Allaham
Backend / Full-Stack Developer
Laravel • NestJS • Node.js • PostgreSQL

📜 License

MIT License © 2026 Zen Allaham
