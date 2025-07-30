🌐 This documentation is available in the following languages: [English🇬🇧](README.md) | [日本語🇯🇵](README.ja.md)

# Warwick Vocaloid Society WEB Project

<div align="center">
    <a href="https://www.warwicksu.com/societies-sports/societies/vocaloid/" target="_blank">
    <img src="https://www.warwicksu.com/asset/Organisation/72239/logo-noBG.png?thumbnail_width=300&thumbnail_height=300&resize_type=ResizeFitAllFill" width="200" alt="WVS Logo">
    </a> with
    <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Laravel Logo">
    </a>
</div>

<div align="center">
  <img src="https://img.shields.io/badge/PHP-8.2-indigo?style=for-the-badge" alt="PHP"/>
  <img src="https://img.shields.io/badge/MySQL-5.7-orange?style=for-the-badge" alt="MySQL"/>
  <img src="https://img.shields.io/badge/Laravel-11.x-red?style=for-the-badge" alt="Laravel"/>
  <img src="https://img.shields.io/badge/Composer-2.7-blue?style=for-the-badge" alt="Composer"/>
  <img src="https://img.shields.io/badge/npm-10.5-green?style=for-the-badge" alt="Laravel"/>
</div>

## Project Overview

This project is for developing the official website of Warwick Vocaloid Society (WVS).

The website has two main components:

The first is the **main website**, a (partially dynamic) static site for both members and non-members, providing general information about WVS, event announcements, showcases, contact info, etc.

The second is the **WVS Platform**, a dynamic platform for members only. It includes interactive features like equipment rentals, a jukebox, and showcase submissions.

You can navigate between the two by first registering via the static site (shown on the landing page), which then grants access to the dynamic platform. Once signed in, you can freely move between the two from the navbar.

## Main Features

* Secure user registration and authentication

  * Google Authenticator 2FA supported. After verifying your email, scan the QR code generated on this website with your Google Authenticator app to receive a one-time passcode.
  * You can disable 2FA from your profile page.
* Equipment Rental Service

  * Members can specify the quantity and rental period for items, add them to the cart, and confirm the order to borrow them. Return dates can be checked on the “Dashboard”. You can filter items by search, category, or favorites.
  * Admins can add/edit/delete items in the catalog and edit/cancel orders from the "Rental Log".
* Jukebox

  * Members can submit their favorite songs via YouTube.
  * Admins can play/stop/skip/delete submitted songs from the “Setlist” during in-person events.
* Showcase

  * Members can submit their works to be showcased.
  * Admins can approve or reject from “Showcase Candidates.” Approved entries appear in the main website’s “Showcase” section. Admins can also edit/delete works from “Showcase Info” in the WVS Platform.
* Contact Form

  * Members can send inquiries after agreeing to the terms of use.
  * Admins can view, edit, and delete these inquiries as needed.
* User Information

  * Admins can view all member information.
  * Admins can also delete users or edit names, emails, Warwick IDs, and roles.
* Multilingual Support (Japanese and English)

  * Both the main website and WVS Platform allow switching languages from the navbar.
* Dark Mode

  * Users can switch between light and dark mode on the WVS Platform.
* Profile Information

  * All users can manage their personal info, profile picture, and 2FA settings from their profile page.
* Responsive Design

  * All pages are responsive by default.

## Setup

Follow these steps to set up the project in your local environment.

### Requirements

* PHP >= 8.2.17
* MySQL >= 5.7.39
* Laravel = 11.x
* Composer >= 2.7.2
* npm >= 10.5.0

This project has been tested on systems with the above versions.

### Installation Steps

1. Clone the repository:

   ```bash
   git clone https://github.com/Tatsunori-Ono/laravel-wvs.git
   cd laravel-wvs
   ```

2. Install dependencies:

   ```bash
   composer install
   npm install
   npm run dev
   ```

3. Create the `.env` file and configure environment variables:

   ```bash
   cp .env.example .env
   ```

   Set the required variables:

   ```env
   APP_NAME=WVS
   APP_ENV=local
   # APP_KEY is generated in Step 4
   APP_KEY=
   # For developers: toggle Laravel Debugbar (true/false)
   APP_DEBUG=false
   APP_TIMEZONE=UTC
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   # Fill in the following 3 values
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password

   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   # Fill in the following 2 values
   MAIL_USERNAME=your_email@gmail.com
   # Generate Gmail App Password from: https://myaccount.google.com/apppasswords
   MAIL_PASSWORD=your_email_password
   MAIL_ENCRYPTION=tls
   # Fill in the following value
   MAIL_FROM_ADDRESS="your_email@gmail.com"
   MAIL_FROM_NAME="Warwick Vocaloid Society"
   ```

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Migrate the database and seed it with sample data:

   ```bash
   php artisan migrate:fresh --seed
   ```

6. Create a symbolic link for storage:

   ```bash
   php artisan storage:link
   ```

7. Start the local server:

   ```bash
   php artisan serve
   ```

8. Open your browser and go to `http://127.0.0.1:8000/about` to use the website! To switch to Japanese, select “JA” from the navbar.

## Developer Information

### Login Credentials

* Admin Account

  * Email: `tatsunorionoastroid@gmail.com`
  * Password: `admin`
* Member Account

  * Email: `tatsunori.no1@gmail.com`
  * Password: `user`

These accounts are seeded as already email-verified, so you can skip the registration step.
If you’d like to test the email verification feature, please try registering with your own email address.

## Directory Structure

* `app`: Main controllers and models
* `config`: Configuration files
* `database`: Migrations and seed files
* `lang`: Language files
* `public`: Publicly accessible files (logos, seed images, etc.)
* `resources`: View files and uncompiled assets
* `routes`: Route definitions

## Maintenance

To enable maintenance mode, run:

```bash
php artisan down
```

To disable maintenance mode, run:

```bash
php artisan up
```

---

Thank you for checking out Warwick Vocaloid Society’s website! We appreciate your continued support. For any questions or feedback, feel free to contact us at [tatsunorionoastroid@gmail.com](mailto:tatsunorionoastroid@gmail.com).
