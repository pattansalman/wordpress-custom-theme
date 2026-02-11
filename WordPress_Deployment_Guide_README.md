
# WordPress Deployment Guide
## Local to Production (Apache & Nginx)

---

# Table of Contents

1. Project Overview
2. Architecture Overview
3. Local Development Setup
4. Production Deployment – Apache
5. Production Deployment – Nginx
6. Database Migration
7. Theme & ACF Deployment Strategy
8. Email Configuration
9. Security Hardening
10. Common Errors & Fixes
11. Professional Workflow Recommendation

---

# 1. Project Overview

Project Name: MyServices WordPress Website  
Environments:
- Local (Development)
- Production (Live Server)

Stacks Supported:
- Apache + PHP + MySQL
- Nginx + PHP-FPM + MySQL

---

# 2. Architecture Overview

## Apache Architecture

Browser → Apache → PHP → MySQL → WordPress

Uses `.htaccess` for rewrite rules and permalinks.

## Nginx Architecture

Browser → Nginx → PHP-FPM → MySQL → WordPress

Uses `try_files` directive instead of `.htaccess`.

---

# 3. Local Development Setup

Requirements:
- XAMPP / MAMP
- PHP 8+
- MySQL
- WordPress
- ACF Plugin

Steps:
1. Install WordPress locally
2. Create database: myservices_db
3. Install theme
4. Install ACF
5. Enable ACF JSON sync
6. Develop pages (Home, About, Contact)

ACF JSON Setup in functions.php:

```php
add_filter('acf/settings/save_json', function() {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});
```

Create folder:
my_service/acf-json/

---

# 4. Production Deployment – Apache

## Step 1 – Install LAMP

```bash
sudo apt update
sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql -y
```

Enable rewrite:

```bash
sudo a2enmod rewrite
```

Edit:
/etc/apache2/apache2.conf

Set:
AllowOverride All

Restart:
```bash
sudo systemctl restart apache2
```

---

## Step 2 – Install WordPress

```bash
cd /var/www/html
sudo wget https://wordpress.org/latest.tar.gz
sudo tar -xzf latest.tar.gz
sudo chown -R www-data:www-data wordpress
```

---

## Step 3 – Database Setup

```sql
CREATE DATABASE myservices_db;
CREATE USER 'wpuser'@'localhost' IDENTIFIED BY 'StrongPassword123!';
GRANT ALL PRIVILEGES ON myservices_db.* TO 'wpuser'@'localhost';
FLUSH PRIVILEGES;
```

---

## Step 4 – Configure wp-config.php

```php
define('DB_NAME', 'myservices_db');
define('DB_USER', 'wpuser');
define('DB_PASSWORD', 'StrongPassword123!');
define('DB_HOST', 'localhost');
```

---

# 5. Production Deployment – Nginx

Install Nginx and PHP-FPM:

```bash
sudo apt install nginx php-fpm php-mysql -y
```

Create site config:

```nginx
server {
    listen 80;
    server_name YOUR_DOMAIN_OR_IP;

    root /var/www/wordpress;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
    }
}
```

Enable and restart:

```bash
sudo ln -s /etc/nginx/sites-available/wordpress /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

---

# 6. Database Migration

Export local database via phpMyAdmin.

Upload:

```bash
scp -i key.pem myservices_db.sql ubuntu@SERVER_IP:/home/ubuntu/
```

Import:

```bash
mysql -u wpuser -p myservices_db < myservices_db.sql
```

Update URLs:

```sql
UPDATE wp_options 
SET option_value='http://SERVER_IP'
WHERE option_name IN ('siteurl','home');
```

---

# 7. Theme & ACF Deployment

Upload only theme folder:

wp-content/themes/my_service

Use ACF JSON sync instead of re-importing database.

---

# 8. Email Configuration

Install WP Mail SMTP plugin.

Use:
- Hostinger SMTP
- Amazon SES
- Gmail SMTP

---

# 9. Security Hardening

Enable SSL:

Apache:
```bash
sudo certbot --apache
```

Nginx:
```bash
sudo certbot --nginx
```

Disable directory listing:

Apache:
Options -Indexes

Correct permissions:

```bash
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 /var/www/html
```

---

# 10. Common Errors & Fixes

Blank Page:
- Enable WP_DEBUG
- Check DB credentials
- Ensure ACF installed

404 on Permalinks:
- Enable rewrite (Apache)
- Add try_files (Nginx)
- Save permalinks

Image Upload Fails:
- Create wp-content/uploads
- Fix permissions

MySQL Access Denied:
- Recreate user properly

---

# 11. Professional Workflow Recommendation

DO:
- Use Git for theme
- Use ACF JSON
- Separate DB from code
- Backup regularly
- Use staging server

DO NOT:
- Re-import DB daily
- Hardcode URLs
- Expose SSH keys

---

END OF DOCUMENTATION
