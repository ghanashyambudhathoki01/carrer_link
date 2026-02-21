# CareerLink – Nepal's Premier Job Portal 🚀

CareerLink is a modern, high-performance job board platform built with Laravel 11. It connects job seekers with top employers across Nepal, featuring a premium user experience, real-time notifications, and robust moderation tools.

![CareerLink Preview](https://via.placeholder.com/1200x600/2563EB/FFFFFF?text=CareerLink+-+Premium+Job+Portal)

## ✨ Key Features

### 👥 For Job Seekers
- **Premium Profile**: Create a stunning professional profile with custom headlines and CV uploads.
- **Smart Job Search**: Filter internships and jobs by category, location, and salary.
- **Real-time Notifications**: Get notified in your dashboard and via email when your application status changes.
- **Job Tracker**: Save interesting jobs and track all your applications in one place.

### 🏢 For Employers
- **Unified Applicant Management**: A centralized "All Applicants" dashboard to manage candidates across all listings.
- **Direct Contact**: Contact applicants directly via one-click email integration.
- **Status Moderation**: Move candidates through stages (Reviewed, Shortlisted, Interviewed, Hired, Rejected).
- **Subscription Plans**: Choose between Free, Pro, and Enterprise tiers to unlock featured listings and higher job limits.

### 🛡️ For Administrators
- **Global Moderation**: Moderate users, job listings, events, and applicants from a dedicated system dashboard.
- **Financial Oversight**: Verify subscription payments via QR code screenshot verification.
- **Analytics**: Overview of platform growth, active users, and pending approvals.

## 🛠️ Tech Stack

- **Backend**: [Laravel 11](https://laravel.com/)
- **Frontend**: [Tailwind CSS](https://tailwindcss.com/), [Alpine.js](https://alpinejs.dev/)
- **Database**: MySQL / PostgreSQL
- **Asset Bundling**: Vite
- **UI Icons**: Heroicons

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ghanashyambudhathoki01/Code-IT-Internship-Job-Portal.git
   cd Code-IT-Internship-Job-Portal
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your database settings in `.env`*

4. **Database & Seeding**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Run Development Server**
   ```bash
   npm run dev
   php artisan serve
   ```

## 📸 Screenshots

| Login Page | Register Page |
| :---: | :---: |
| ![Login](https://via.placeholder.com/400x300/1E293B/FFFFFF?text=Premium+Login) | ![Register](https://via.placeholder.com/400x300/1E293B/FFFFFF?text=Role+Selection) |

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---
Developed with ❤️ by [Ghanashyam Budhathoki](https://github.com/ghanashyambudhathoki01)
