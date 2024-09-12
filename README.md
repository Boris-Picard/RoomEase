# RoomEase

RoomEase is a room booking application built with Symfony, Doctrine, and EasyAdmin. It provides two main user roles: Guests who can book rooms, and Hosts who can create and manage rooms.

## Features

- **Guest and Host Forms**:
  - Guests can search and book rooms.
  - Hosts can create rooms with capacity, equipment, and images.
- **Data Validation**:

  - Uses Symfony Form Types and Doctrine assertions for validation.
  - Role management using enums.
  - Secure login and access control via Symfony's security system.

- **Admin Dashboard**:
  - EasyAdmin-based dashboard for managing users, rooms, and reservations.

## Installation

1. Clone the project:

```bash
git clone https://github.com/your-repo/roomease.git
cd roomease
```

Install dependencies:

```bash
composer install
```

Configure your database in .env:

```bash
DATABASE_URL="postgresql://username:password@127.0.0.1:5432/roomease"
```

Create the database and run migrations:

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

Run the Symfony server:

```bash
symfony server:start
```

## Key Entities

- **Reservation**: Manages room bookings with date, time, and related users and rooms.
- **Room**: Defines room properties (name, capacity, equipment, etc.).
- **User**: Represents guests and hosts with distinct roles.

## Tech Stack

- **Backend**: Symfony, Doctrine ORM
- **Database**: PostgreSQL
- **Administration**: EasyAdmin for backend management
