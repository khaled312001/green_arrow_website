# Laravel Deployment Guide

## Vercel Deployment Issues

Vercel has limited PHP support and the `@vercel/php` package is no longer available. For Laravel applications, consider these alternatives:

## Alternative Hosting Options

### 1. Heroku (Recommended for Laravel)
```bash
# Install Heroku CLI
# Create Procfile
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile

# Deploy
heroku create your-app-name
git push heroku main
```

### 2. DigitalOcean App Platform
- Connect your GitHub repository
- Select PHP as runtime
- Set build command: `composer install --no-dev --optimize-autoloader`
- Set run command: `php artisan serve --host=0.0.0.0 --port=$PORT`

### 3. AWS Elastic Beanstalk
- Create PHP environment
- Upload your Laravel application
- Configure environment variables

### 4. Laravel Forge + DigitalOcean
- Use Laravel Forge for easy deployment
- Connect to DigitalOcean droplets

## Environment Variables Required

Make sure to set these environment variables in your hosting platform:

- `APP_KEY` (generate with `php artisan key:generate`)
- `APP_ENV=production`
- `APP_DEBUG=false`
- Database credentials
- Mail configuration
- Any other service credentials

## Database Setup

For production, use a managed database service:
- AWS RDS
- DigitalOcean Managed Databases
- Heroku Postgres
- PlanetScale (MySQL)

## File Storage

For file uploads, use cloud storage:
- AWS S3
- DigitalOcean Spaces
- Cloudinary

## Current Vercel Configuration

The current `vercel.json` is configured for basic PHP support, but Vercel's PHP runtime is limited and may not work properly with Laravel's requirements. 