# Payment Gateway Simulation System

## Overview

This project is a Laravel 12 based payment gateway simulation system that demonstrates a simplified real-world payment processing workflow.

The application allows customers to submit payment requests through a web interface or REST API. Payment processing is handled asynchronously using Laravel Queues, while administrators can monitor transactions through a secure dashboard.

---

# Features

## Customer Portal

- Submit payment requests
- Client-side and server-side validation
- Payment acknowledgement page
- Transaction reference generation
- Loading indicator during submission

## REST API

- Create payment transactions
- JSON responses
- Request validation
- Idempotency support

Endpoint:

```
POST /api/transactions
```

## Payment Processing

- Queue-based asynchronous processing
- Simulated payment provider
- Automatic transaction status updates
- Provider response logging

## Admin Dashboard

Authenticated administrators can:

- View dashboard statistics
- Monitor recent transactions
- Browse transaction history
- View transaction details

Dashboard statistics include:

- Total Transactions
- Successful Transactions
- Failed Transactions
- Pending Transactions
- Processing Transactions
- Total Payment Volume
- Successful Payment Volume
- Today's Transactions

---

# Technology Stack

- PHP 8.2
- Laravel 12
- MySQL
- Bootstrap 5
- Laravel Breeze
- Laravel Queue
- Laravel Cache

---

# Installation

Clone the repository

```bash
git clone <repository-url>
```

Install dependencies

```bash
composer install
```

Copy environment file

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Update database credentials in `.env`.

Run migrations

```bash
php artisan migrate
```

---

# Database

The submission includes a sample database export.

File:

```
pay_flow.sql
```

Import the SQL file into MySQL if you wish to use the provided sample data.

---

# Queue Worker

Start the queue worker

```bash
php artisan queue:work
```

---

# Run Application

```bash
php artisan serve
```

Customer Portal

```
http://127.0.0.1:8000
```

Admin Login

```
http://127.0.0.1:8000/login
```

---

# API

## Create Transaction

```
POST /api/transactions
```

Example Request

```json
{
    "customer_name": "John Doe",
    "customer_email": "john@example.com",
    "amount": 1500,
    "currency": "INR"
}
```

Optional Header

```
Idempotency-Key: unique-request-key
```

---

# Project Structure

```
app/
    Enums/
    Http/
    Jobs/
    Models/
    Services/

resources/
    views/
        admin/
        payment/
        transactions/

routes/
    api.php
    web.php
```

---

# Design Decisions

- Thin Controllers
- Service Layer Architecture
- Queue-based asynchronous processing
- Dashboard statistics caching
- Enum-based transaction status management
- Shared business logic between Web and API
- Idempotency support for payment requests

---

# Assumptions

- Payment provider is simulated.
- Queue worker is running.
- Only administrators require authentication.
- Customers can submit payment requests without registration.

---

# Future Enhancements

- Multiple payment providers
- Customer authentication
- UUID based transaction URLs
- Email notifications
- Advanced search and filters
- Export reports
- Role-based access control

---

# Additional Files

The submission includes:

- `README.md`
- `AI_CONTEXT.md`
- `.env.example`
- `pay_flow.sql`

---

# Author

Ashwini