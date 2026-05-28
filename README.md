# elo

A fashion e-commerce platform built with Laravel. Features product catalog, shopping cart, COD checkout, user authentication, and a full admin panel.

## Features

### Public
- Landing page with hero section, category grid, featured products, and sale promotions
- Product catalog with search, category filtering, and pagination
- Product detail pages with gallery images, sale badges, and related products
- Session-based shopping cart (add, update, remove, clear)
- Checkout with Cash on Delivery (COD) payment, stock validation, and database transactions
- User registration, login, and logout
- Email verification and password reset
- Customer dashboard with order history

### Admin Panel (`/admin`)
- Dashboard with stats (total products, categories, users, orders, low stock alerts)
- Product CRUD with image upload, gallery images, and sale pricing
- Category CRUD with multi-level hierarchy (parent/child)
- Order management with status updates (pending, processing, shipped, delivered, cancelled)
- User management with admin role toggling

### General
- Multi-level subcategories with hierarchical display
- Sale prices with discount percentage badges
- Pakistani Rupee (Rs) currency throughout
- Low stock alerts on dashboard

## Requirements

- PHP ^8.2
- MySQL
- Composer
- Node.js & NPM (for frontend assets)

## Installation

1. Clone the repository
   ```bash
   git clone <repo-url> elo-app
   cd elo-app
   ```

2. Install PHP dependencies
   ```bash
   composer install
   ```

3. Copy the environment file and edit database credentials
   ```bash
   cp .env.example .env
   ```

4. Set your database connection in `.env`:
   ```
   DB_DATABASE=elo_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Generate the application key
   ```bash
   php artisan key:generate
   ```

6. Run migrations and seeders
   ```bash
   php artisan migrate --seed
   ```

7. Create the storage symlink (for product images)
   ```bash
   php artisan storage:link
   ```

8. Install and build frontend assets
   ```bash
   npm install
   npm run build
   ```

9. Start the development server
   ```bash
   php artisan serve
   ```

10. Visit `http://localhost:8000` in your browser.

## Email Configuration

By default, emails (verification, password reset) are written to `storage/logs/laravel.log` instead of being sent. To use a real email service:

1. Set your SMTP credentials in `.env`:
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your@email.com
   MAIL_PASSWORD=your-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your@email.com
   MAIL_FROM_NAME="${APP_NAME}"
   ```

2. For Gmail, generate an App Password (requires 2-factor authentication enabled) at https://myaccount.google.com/apppasswords
3. For other providers (Mailgun, SendGrid, Postmark), use their SMTP settings.

After configuring, test with:
```bash
php artisan tinker --execute="Mail::raw('Test', function(\$msg) { \$msg->to('your@email.com')->subject('Test'); });"
```

## Default Accounts

After seeding, the following accounts are available:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@elo.com | password |
| User | user@elo.com | password |

The admin panel is at `/admin`. Admin users only — regular users get a 403 if they try to access it.

## License

MIT
