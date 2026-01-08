# Candidate Management System

A comprehensive Laravel-based web application for managing job candidate applications with role-based access control, interview scheduling, and Excel import/export functionality.

## Project Overview

This system streamlines the recruitment process by providing:
- Bulk candidate import via Excel
- Multi-stage interview management
- Role-based access control (Admin, Staff, Candidate)
- Automated interview tracking
- Status management throughout hiring pipeline

## Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage Guide](#usage-guide)
- [User Roles](#user-roles)
- [Testing](#testing)
- [Design Decisions](#design-decisions)
- [Troubleshooting](#troubleshooting)

## ✨ Features

### Core Functionality
- **Excel Import/Export**: Bulk upload candidates with validation
- **CRUD Operations**: Full candidate management
- **Interview Scheduling**: 
  - By selection (checkboxes)
  - By range (e.g., candidates 2-10)
  - First and second round interviews
- **Automatic Status Updates**: Interviews auto-complete when date passes
- **Phone Number Export**: Download contact list for upcoming interviews
- **Status Tracking**: Complete candidate journey from application to hire
- **Role-Based Access Control**: Three distinct user roles
- **Responsive Design**: Works on desktop, tablet, and mobile

### Advanced Features
- Real-time status updates
- Comprehensive candidate profiles
- Interview history tracking
- Separate lists (All, Hired, Rejected)
- Data validation and error handling
- Secure authentication

## 🛠️ Technology Stack

- **Framework**: Laravel 12.x
- **PHP**: 8.2+
- **Database**: MySQL 8.0+
- **Frontend**: 
  - Blade Templates
  - Tailwind CSS
  - Alpine.js (via Laravel Breeze)
- **Authentication**: Laravel Breeze
- **Excel Processing**: Maatwebsite/Laravel-Excel
- **Version Control**: Git

## 💻 System Requirements

- PHP >= 8.2
- Composer >= 2.6
- MySQL >= 8.0 or MariaDB >= 10.11 || Using MySQL
- Node.js >= 18.x & NPM >= 9.x
- Git

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd candidate-management
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Database

Edit `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=candidate_management
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. Create Database

```bash
# MySQL Command Line
mysql -u root -p
CREATE DATABASE candidate_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

Or using phpMyAdmin, create database named `candidate_management`.

### 7. Run Migrations & Seeders

```bash
php artisan migrate --seed
```

This creates:
- Database tables
- Default users (Admin, Staff, Candidate)

### 8. Build Frontend Assets

```bash
npm run build
```

For development with hot reload:
```bash
npm run dev
```

### 9. Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Configuration

### Default User Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Staff | staff@example.com | password |
| Candidate | candidate@example.com | password |

**Important**: Change these passwords in production!

### File Storage

Uploaded files are stored in `storage/app/public`. 

Link storage to public directory:
```bash
php artisan storage:link
```

### Excel File Format

Required columns in Excel file:

| Column | Type | Description | Example |
|--------|------|-------------|---------|
| name | String | Full name | John Doe |
| email | Email | Unique email | john@example.com |
| phone | String | Phone number | 01712345678 |
| experience_years | Integer | Years of experience | 5 |
| previous_experience | String | Format: "Company:Position,Company:Position" | ABC Corp:Developer,XYZ:Senior Dev |
| age | Integer | Age (18+) | 28 |

**Sample Excel File**: Check `storage/sample_candidates.xlsx`

## Usage Guide

### For Admin Users

#### 1. Upload Candidates
1. Navigate to Dashboard
2. Click "Upload Excel File"
3. Select your Excel file
4. Click "Upload & Import"
5. View imported candidates in "All Candidates"

#### 2. Schedule Interviews

**Method A: By Selection**
1. Go to "Schedule Interview"
2. Check candidates you want to interview
3. Select date & time
4. Choose interview type (First/Second)
5. Click "Schedule Selected"

**Method B: By Range**
1. Go to "Schedule Interview"
2. Enter start position (e.g., 2)
3. Enter end position (e.g., 10)
4. Select date & time
5. Click "Schedule Range"

#### 3. Manage Interviews
1. **Upcoming**: View scheduled interviews
   - Download phone numbers
   - Mark as complete manually
2. **Completed**: Process results
   - Click "Pass" to approve
   - Click "Reject" to decline
3. **Second Round**: Schedule for passed candidates

#### 4. View Reports
- All Candidates
- Hired Candidates
- Rejected Candidates

### For Staff Users

Staff can:
- Upload Excel files
- View all candidates
- View interview schedules
- Download phone numbers

Staff cannot:
- Edit candidates
- Delete candidates
- Schedule interviews
- Mark interview results

### For Candidates

Candidates can:
- Login to their account
- View application status
- See interview schedule
- Check if hired/rejected

## User Roles

### Admin (Full Access)
```
Create, Read, Update, Delete candidates
Upload Excel files
Schedule interviews (both types)
Mark interview results
Hire/Reject candidates
View all reports
Export data
```

### Staff (Read & Upload)
```
Upload Excel files
View all candidates
View all interviews
Download phone numbers
Cannot edit/delete
Cannot schedule interviews
Cannot mark results
```

### Candidate (Own Status Only)
```
View own application status
View interview schedule
Check hiring status
Cannot access admin panel
Cannot see other candidates
```

## 🧪 Testing

### Manual Testing

Run through `TESTING_CHECKLIST.md` for comprehensive testing.

### Quick Test Scenarios

#### Scenario 1: Complete Hiring Process
1. Login as Admin
2. Upload sample Excel file
3. Schedule first interview for 2-3 candidates
4. Mark interview as complete
5. Pass one candidate
6. Schedule second interview
7. Pass to hire

#### Scenario 2: Role Testing
1. Login as each role (Admin, Staff, Candidate)
2. Try accessing restricted pages
3. Verify appropriate errors/redirects

#### Scenario 3: Data Validation
1. Try uploading invalid Excel file
2. Try creating candidate with duplicate email
3. Try invalid data types
4. Verify error messages

### Test Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Reset database
php artisan migrate:fresh --seed

# Check routes
php artisan route:list
```

## Design Decisions

### Database Structure

**Candidates Table**
- Stores all candidate information
- JSON field for previous experience (flexible structure)
- Status enum for workflow tracking

**Interviews Table**
- Links to candidates (foreign key)
- Tracks interview type (first/second)
- Auto-completion based on date

**Status Flow**
```
pending → first_interview_scheduled → first_interview_completed 
→ passed_first/rejected_first → second_interview_scheduled 
→ second_interview_completed → hired/rejected_final
```

### Architecture Decisions

1. **Separate Controllers**: Clear separation of concerns
   - CandidateController: CRUD operations
   - InterviewController: Scheduling & tracking
   - DashboardController: Overview statistics

2. **Middleware-Based Authorization**: 
   - AdminMiddleware: Full access
   - StaffMiddleware: Read + Upload access
   - Protects routes at application level

3. **Excel Import/Export**:
   - Using Maatwebsite/Excel for reliability
   - Row-by-row validation
   - Batch processing for performance

4. **Frontend Approach**:
   - Server-side rendering (Blade)
   - Tailwind CSS for responsive design
   - Minimal JavaScript (Alpine.js)
   - Progressive enhancement

### Assumptions

1. Email addresses are unique per candidate
2. Interview dates are in the future when scheduled
3. Only one active interview per candidate at a time
4. Automatic status progression based on date
5. Previous experience format: "Company:Position,Company:Position"

##  Troubleshooting

### Common Issues

#### Issue: Migration fails
```bash
# Solution 1: Drop all tables and retry
php artisan migrate:fresh --seed

# Solution 2: Check database connection
php artisan config:cache
```

#### Issue: Excel import fails
```bash
# Check file format (must be .xlsx, .xls, or .csv)
# Verify column names match exactly
# Check for duplicate emails in file
```

#### Issue: Permission denied errors
```bash
# Fix storage permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# On Linux/Mac
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
```

#### Issue: Assets not loading
```bash
# Rebuild assets
npm run build

# Clear view cache
php artisan view:clear
```

#### Issue: 404 on routes
```bash
# Clear route cache
php artisan route:clear
php artisan optimize:clear
```

### Debug Mode

Enable detailed errors in `.env`:
```env
APP_DEBUG=true
APP_ENV=local
```

**Disable in production!**

## Project Structure

```
candidate-management/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CandidateController.php
│   │   │   ├── InterviewController.php
│   │   │   └── DashboardController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── StaffMiddleware.php
│   ├── Models/
│   │   ├── Candidate.php
│   │   ├── Interview.php
│   │   └── User.php
│   ├── Imports/
│   │   └── CandidatesImport.php
│   └── Exports/
│       ├── PhonesExport.php
│       ├── InterviewsExport.php
│       └── CandidatesExport.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── candidates/
│       │   └── interviews/
│       └── candidate/
├── routes/
│   └── web.php
└── README.md
```

## Security Considerations

- CSRF protection enabled on all forms
- Password hashing using bcrypt
- SQL injection prevention via Eloquent ORM
- XSS protection via Blade escaping
- File upload validation and restrictions
- Role-based access control via middleware

## Deployment

### Production Checklist

- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Change default passwords
- [ ] Set strong `APP_KEY`
- [ ] Configure proper database credentials
- [ ] Set up HTTPS
- [ ] Configure email settings
- [ ] Set up backup strategy
- [ ] Configure queue workers
- [ ] Set up monitoring

### Optimization

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

## Support

For issues or questions:
- Check `TESTING_CHECKLIST.md`
- Review Laravel documentation: https://laravel.com/docs
- Check Tailwind CSS docs: https://tailwindcss.com/docs

## License

This project is developed as part of a technical assessment.

## Acknowledgments

- Laravel Framework
- Tailwind CSS
- Maatwebsite Laravel-Excel
- Laravel Breeze

---

**Last Updated**: January 2025
**Version**: 1.0.0
**Developed By**: [Your Name]