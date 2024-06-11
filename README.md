# Hackers Poulette

A simple mail sender with contact form. Built with **PHP**, **SASS** and **PHP Mailer**.

## About the project

![alt text](image.png)

This project is a simple contact form built using PHP, designed for the fictional company "Hackers Poulette". The form allows users to submit their inquiries, which are then processed and validated by the server-side PHP script.

## Features

- Secure form submission with server-side validation
- Error handling and user feedback
- Basic CSS styling for a clean and user-friendly interface
- Sanitization of user input to prevent XSS and SQL injection attacks
- SMTP configuration for sending emails

## Requirements

- PHP 7.0 or higher
- Web server (e.g., Apache, Nginx)
- Composer (for dependency management)
- Optional: SMTP server details for email functionality

## Prerequisites

- PHP Mailer

``` sh
composer require phpmailer/phpmailer
```

- Phpdotenv

``` sh
composer require vlucas/phpdotenv
```

## Installation

1. Clone the repository

```sh
git clone https://github.com/Justine-Frigo/hackers-poulette.git
```

2. Install dependencies

```sh
composer install
```

3. Create .env file

```sh
SMTP_HOST=smtp.example.com
SMTP_PORT=587
SMTP_USER=your-email@example.com
SMTP_PASS=your-email-password
```

## Usage

1. Access the form

Open your web browser and navigate to the URL where your project is hosted. You should see the contact form.

2. Submit the form

Fill in the required fields and submit the form. The PHP script will handle the input, perform validation, and provide feedback.

3. Check for emails (optional)

If email notifications are enabled, check the configured email inbox for submissions.

## Author

[Justine Frigo](https://github.com/Justine-Frigo)






