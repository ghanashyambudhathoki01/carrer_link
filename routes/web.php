<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\SubscriptionController;
    // Add subscription selection route
    Route::post('/subscriptions/select/{plan}', [SubscriptionController::class, 'select'])->name('subscription.select');
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\SeekerProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboard;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register-super-admin', [App\Http\Controllers\Auth\SuperAdminRegisterController::class, 'create'])->name('super-admin.register');
Route::post('/register-super-admin', [App\Http\Controllers\Auth\SuperAdminRegisterController::class, 'store'])->name('super-admin.register.post');

// Jobs
Route::get('/jobs', [JobListingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobListingController::class, 'show'])->name('jobs.show');
Route::get('/internships', [JobListingController::class, 'internships'])->name('internships');

// Events (Eventify)
Route::get('/eventify', [EventController::class, 'index'])->name('events.index');
Route::get('/eventify/{id}', [EventController::class, 'show'])->name('events.show');

// Subscriptions (public pricing page)
Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');

// Legal
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms-of-service', 'pages.terms')->name('terms');

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Job Seeker Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:job_seeker'])->prefix('seeker')->name('seeker.')->group(function () {
    Route::get('/dashboard', [SeekerProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [SeekerProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [SeekerProfileController::class, 'update'])->name('profile.update');
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/apply/{jobId}', [ApplicationController::class, 'store'])->name('apply');
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved-jobs.index');
    Route::post('/saved-jobs/toggle/{jobId}', [SavedJobController::class, 'toggle'])->name('saved-jobs.toggle');

    // Resume Builder
    Route::get('/resume-builder', [\App\Http\Controllers\ResumeBuilderController::class, 'index'])->name('resume.builder');
    Route::post('/resume-builder/experience', [\App\Http\Controllers\ResumeBuilderController::class, 'storeExperience'])->name('resume.experience.store');
    Route::delete('/resume-builder/experience/{experience}', [\App\Http\Controllers\ResumeBuilderController::class, 'deleteExperience'])->name('resume.experience.delete');
    Route::post('/resume-builder/education', [\App\Http\Controllers\ResumeBuilderController::class, 'storeEducation'])->name('resume.education.store');
    Route::delete('/resume-builder/education/{education}', [\App\Http\Controllers\ResumeBuilderController::class, 'deleteEducation'])->name('resume.education.delete');
    
    Route::post('/resume-builder/certification', [\App\Http\Controllers\ResumeBuilderController::class, 'storeCertification'])->name('resume.certification.store');
    Route::delete('/resume-builder/certification/{certification}', [\App\Http\Controllers\ResumeBuilderController::class, 'deleteCertification'])->name('resume.certification.delete');
    
    Route::post('/resume-builder/language', [\App\Http\Controllers\ResumeBuilderController::class, 'storeLanguage'])->name('resume.language.store');
    Route::delete('/resume-builder/language/{language}', [\App\Http\Controllers\ResumeBuilderController::class, 'deleteLanguage'])->name('resume.language.delete');

    Route::post('/resume-builder/social', [\App\Http\Controllers\ResumeBuilderController::class, 'storeSocial'])->name('resume.social.store');
    Route::delete('/resume-builder/social/{social}', [\App\Http\Controllers\ResumeBuilderController::class, 'deleteSocial'])->name('resume.social.delete');
    
    Route::get('/resume-builder/preview', [\App\Http\Controllers\ResumeBuilderController::class, 'preview'])->name('resume.preview');
});

/*
|--------------------------------------------------------------------------
| Employer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:employer', 'subscription.required'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [EmployerController::class, 'profile'])->name('profile');
    Route::post('/profile', [EmployerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/jobs', [EmployerController::class, 'jobs'])->name('jobs.index');
    Route::get('/jobs/create', [EmployerController::class, 'createJob'])->name('jobs.create');
    Route::post('/jobs', [EmployerController::class, 'storeJob'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [EmployerController::class, 'editJob'])->name('jobs.edit');
    Route::put('/jobs/{id}', [EmployerController::class, 'updateJob'])->name('jobs.update');
    Route::delete('/jobs/{id}', [EmployerController::class, 'destroyJob'])->name('jobs.destroy');
    Route::get('/applicants', [EmployerController::class, 'allApplicants'])->name('applicants.all');
    Route::get('/jobs/{id}/applicants', [EmployerController::class, 'applicants'])->name('applicants.index');
    Route::post('/applications/{id}/status', [EmployerController::class, 'updateApplicationStatus'])->name('applicants.update');

    // Events
    Route::get('/events/create', [EmployerController::class, 'createEvent'])->name('events.create');
    Route::post('/events/store', [EmployerController::class, 'storeEvent'])->name('events.store');
});

/*
|--------------------------------------------------------------------------
| Subscription / Payment Routes (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/subscriptions/{planId}/checkout', [SubscriptionController::class, 'checkout'])->name('subscriptions.checkout');
    Route::post('/subscriptions/{planId}/submit', [SubscriptionController::class, 'submit'])->name('subscriptions.submit');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
    // Users
    Route::get('/users', [AdminDashboard::class, 'users'])->name('users.index');
    Route::put('/users/{id}/status', [AdminDashboard::class, 'updateUserStatus'])->name('users.status');
    // Jobs
    Route::get('/jobs', [AdminDashboard::class, 'jobs'])->name('jobs.index');
    Route::put('/jobs/{id}/status', [AdminDashboard::class, 'updateJobStatus'])->name('jobs.status');
    Route::put('/jobs/{id}/category', [AdminDashboard::class, 'updateJobCategory'])->name('jobs.category');
    Route::put('/jobs/{id}/feature', [AdminDashboard::class, 'toggleFeatureJob'])->name('jobs.feature');
    // Subscriptions
    Route::get('/subscriptions', [AdminDashboard::class, 'subscriptions'])->name('subscriptions.index');
    Route::put('/subscriptions/{id}/verify', [AdminDashboard::class, 'verifySubscription'])->name('subscriptions.verify');
    Route::put('/subscriptions/{id}/reject', [AdminDashboard::class, 'rejectSubscription'])->name('subscriptions.reject');
    // Applicants
    Route::get('/applicants', [AdminDashboard::class, 'applicants'])->name('applicants.index');
    Route::post('/applicants/{id}/status', [AdminDashboard::class, 'updateApplicantStatus'])->name('applicants.update');
    // Internships
    Route::get('/internships/create', [AdminDashboard::class, 'createInternship'])->name('internships.create');
    Route::post('/internships/store', [AdminDashboard::class, 'storeInternship'])->name('internships.store');

    // Events
    Route::get('/events', [AdminDashboard::class, 'events'])->name('events.index');
    Route::get('/events/create', [AdminDashboard::class, 'createEvent'])->name('events.create');
    Route::post('/events/store', [AdminDashboard::class, 'storeEvent'])->name('events.store');
    Route::put('/events/{id}/approve', [AdminDashboard::class, 'approveEvent'])->name('events.approve');
});

/*
|--------------------------------------------------------------------------
| Super Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:super_admin'])->prefix('super-admin')->name('super-admin.')->group(function () {
    Route::get('/', [SuperAdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/admins', [SuperAdminDashboard::class, 'admins'])->name('admins.index');
    Route::get('/admins/create', [SuperAdminDashboard::class, 'createAdmin'])->name('admins.create');
    Route::post('/admins', [SuperAdminDashboard::class, 'storeAdmin'])->name('admins.store');
    
    // Subscriptions / Payments
    Route::get('/subscriptions', [SuperAdminDashboard::class, 'subscriptions'])->name('subscriptions.index');
    Route::put('/subscriptions/{id}/verify', [SuperAdminDashboard::class, 'verifySubscription'])->name('subscriptions.verify');
    Route::put('/subscriptions/{id}/reject', [SuperAdminDashboard::class, 'rejectSubscription'])->name('subscriptions.reject');

    // Internships
    Route::get('/internships/create', [SuperAdminDashboard::class, 'createInternship'])->name('internships.create');
    Route::post('/internships/store', [SuperAdminDashboard::class, 'storeInternship'])->name('internships.store');

    // Events
    Route::get('/events/create', [SuperAdminDashboard::class, 'createEvent'])->name('events.create');
    Route::post('/events/store', [SuperAdminDashboard::class, 'storeEvent'])->name('events.store');
});

/*
|--------------------------------------------------------------------------
| Dashboard redirect by role
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    return match (true) {
        $user->isSuperAdmin() => redirect()->route('super-admin.dashboard'),
        $user->isAdmin()      => redirect()->route('admin.dashboard'),
        $user->isEmployer()   => redirect()->route('employer.dashboard'),
        default               => redirect()->route('seeker.dashboard'),
    };
    // Notifications
    Route::post('/notifications/mark-as-read', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markAsRead');
})->middleware('auth')->name('dashboard');
