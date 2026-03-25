# Role-Based Authentication Implementation

## Project: Center Formation

## Date: March 9, 2026

---

## Overview

Added role-based authentication system to the Laravel Breeze project with three roles: **Formateur**, **Apprenant**, and **Administrateur**. Each role has a dedicated dashboard with role-based redirect logic.

---

## Layout Structure

### Available Layouts

#### 1. Guest Layout (`layouts.guest`)

**File:** `resources/views/layouts/guest.blade.php`

- Used for: Login, Register, Password Reset pages
- Features: Centered card layout, minimal navigation
- Components: Logo, authentication forms

#### 2. Public Layout (`layouts.PublicLayout`)

**File:** `resources/views/layouts/PublicLayout.blade.php`

- **Updated** to use eLearning template components and assets
- Uses proper template CSS/JS from `public/` folder
- Includes: navbar, footer, spinner, back-to-top components
- Features: Full eLearning template styling and functionality
- Components:
    - `front.components.navbar` - Navigation with Laravel routes
    - `front.components.footer` - Template footer
    - `front.components.spinner` - Loading spinner
    - `front.components.backTop` - Back to top button

#### 3. App Layout (`layouts.app`)

**File:** `resources/views/layouts/app.blade.php`

- Used for: Authenticated users (Formateur, Apprenant)
- Features: User navigation, page headers, footer
- Components: Navigation, user menu, content area

#### 4. Admin Layout (`components.admin-layout`)

**File:** `resources/views/components/admin-layout.blade.php`

- Used for: Administrator pages only
- Features: Sidebar navigation, admin-specific styling
- Components: Admin sidebar, user info, logout button

### Layout Usage

```blade
<!-- Guest pages (login/register) -->
@extends('layouts.guest')

<!-- Public pages (home, about) -->
@extends('layouts.PublicLayout')

<!-- Authenticated user pages -->
<x-app-layout>
    <x-slot name="header">Page Title</x-slot>
    <!-- content -->
</x-app-layout>

<!-- Admin pages -->
<x-admin-layout>
    @section('header', 'Admin Page Title')
    <!-- content -->
</x-admin-layout>
```

### Automatic Layout Selection

The application automatically selects layouts based on user authentication and role:

- **Guest users** → `layouts.guest`
- **Authenticated admin** → `components.admin-layout`
- **Authenticated users** → `layouts.app`
- **Public pages** → `layouts.PublicLayout`

---

## Steps Completed

### 1. Database Migration

**File:** `database/migrations/2026_03_09_104856_add_role_to_users_table.php`

- Added `role` column to users table with enum values: `formateur`, `apprenant`, `administrateur`
- Default role set to `apprenant`

### 2. User Model Update

**File:** `app/Models/User.php`

- Added `role` to the `$fillable` array to allow mass assignment
- Added `$casts` array to cast role as string
- Added role checking helper methods for improved code readability

### 3. Authentication Controller Modification

**File:** `app/Http/Controllers/Auth/RegisteredUserController.php`

- Updated registration logic to handle role assignment during user creation
- Role is determined from request input with default fallback to `apprenant`

### 4. View Files Created/Updated

#### Register View

**File:** `resources/views/auth/register.blade.php`

- Added role selection dropdown with three options:
    - Apprenant
    - Formateur
    - Administrateur
- Hidden field to pass selected role to controller

#### Admin Dashboard

**File:** `resources/views/admin/dashboard.blade.php`

- Display admin dashboard with statistics cards:
    - Total users count
    - Number of Formateurs
    - Number of Apprenants
    - Number of Administrateurs
- Quick access buttons:
    - "Gérer les Utilisateurs" - Link to user management
    - "Paramètres" - Link to settings
    - "Statistiques" - Placeholder for future statistics

#### Admin Users Management

**File:** `resources/views/admin/users.blade.php`

- Display all users in a responsive table
- Show columns: ID, Name, Email, Role, Created Date
- Role badge with color coding:
    - Red for Administrator
    - Blue for Formateur
    - Green for Apprenant
- "Create New User" button (green) at the top to navigate to creation form
- Action buttons for each user:
    - **Edit Button** - Redirects to edit user form
    - **Delete Button** - Deletes user with confirmation

#### Create User Form

**File:** `resources/views/admin/create-user.blade.php`

- Form to create new user with:
    - Name field
    - Email field (unique validation)
    - Password field (minimum 8 characters)
    - Password confirmation field
    - Role dropdown (formateur, apprenant, administrateur)
- Submit and back buttons
- Password hashing handled on submission
- Form validation and error display
- Old values preserved on validation errors

#### Edit User Form

**File:** `resources/views/admin/edit-user.blade.php`

- Form to edit user details:
    - Name field
    - Email field (unique validation)
    - Role dropdown (formateur, apprenant, administrateur)
- Submit and back buttons
- Form validation and error display

#### Formateur Dashboard

**File:** `resources/views/formateur/dashboard.blade.php`

- Created dedicated dashboard for Formateur role
- Displays formateur-specific content and tools
- Shows "Formateur Dashboard"

#### Apprenant Dashboard

**File:** `resources/views/apprenant/dashboard.blade.php`

- Created dedicated dashboard for Apprenant role
- Displays apprenant-specific content
- Shows "Apprenant Dashboard"

### 5. Controllers Created

#### AdminController

**File:** `app/Http/Controllers/AdminController.php`

- `dashboard()` - Returns admin dashboard view with statistics
- `users()` - Display list of all users with edit/delete buttons
- `createUser()` - Show form to create a new user
- `storeUser($request)` - Create and save new user with password hashing
- `editUser($id)` - Show form to edit user details
- `updateUser($request, $id)` - Update user name, email, and role
- `deleteUser($id)` - Delete a user from the system
- `settings()` - Settings management page

#### FormateurController

**File:** `app/Http/Controllers/FormateurController.php`

- `dashboard()` - Returns formateur dashboard view
- `courses()` - Manage courses
- `students()` - View enrolled students
- `materials()` - Manage course materials

#### ApprenantController

**File:** `app/Http/Controllers/ApprenantController.php`

- `dashboard()` - Returns apprenant dashboard view
- `courses()` - View enrolled courses
- `progress()` - Track learning progress
- `materials()` - Access course materials

### 6. Route Configuration

**File:** `routes/web.php`

- Imported all three controllers
- Created role-based middleware protection with `'auth', 'verified'`
- Added routes for each controller:
    - **Admin routes:**
        - `GET /admin/dashboard` - Admin dashboard
        - `GET /admin/users` - List all users
        - `GET /admin/users/create` - Create user form
        - `POST /admin/users` - Store new user
        - `GET /admin/users/{id}/edit` - Edit user form
        - `PUT /admin/users/{id}` - Update user
        - `DELETE /admin/users/{id}` - Delete user
        - `GET /admin/settings` - Settings page
    - **Formateur routes:**
        - `GET /formateur/dashboard`, `/formateur/courses`, `/formateur/students`, `/formateur/materials`
    - **Apprenant routes:**
        - `GET /apprenant/dashboard`, `/apprenant/courses`, `/apprenant/progress`, `/apprenant/materials`
- Dashboard route redirects based on user role:
    - If role is `administrateur` → redirect to `admin.dashboard`
    - If role is `formateur` → redirect to `formateur.dashboard`
    - If role is `apprenant` → redirect to `apprenant.dashboard`

### 7. Middleware (Optional)

**File:** `app/Http/Middleware/CheckRole.php` (if created)

- Can be used to protect routes by specific role
- Syntax: `middleware(['auth', 'checkRole:administrateur'])`

---

## Key Features Implemented

✅ **Three User Roles:**

- Formateur (Instructor)
- Apprenant (Student/Learner)
- Administrateur (Administrator)

✅ **Role-Based Registration:**

- Users can select their role during registration

✅ **Role-Based Dashboard Routing:**

- After login, users are automatically redirected to their role-specific dashboard
- Each dashboard is customized for the role's needs

✅ **Admin User Management Panel:**

- **Create User:** Form to add new users with password setup (minimum 8 chars)
- **List Users:** Display all users with details (ID, Name, Email, Role, Created Date)
- **Edit User:** Update name, email, and role
- **Delete User:** Remove users from system with confirmation
- User statistics dashboard showing:
    - Total users count
    - Count by role (Formateur, Apprenant, Administrator)
- Color-coded role badges for visual organization
- Responsive table with Bootstrap styling
- Password hashing for security

✅ **Database Persistence:**

- Role stored in users table
- Persists across sessions

---

## Testing Checklist

- [ ] Register new user as Apprenant
    - Verify: Redirected to `/apprenant/dashboard`
- [ ] Register new user as Formateur
    - Verify: Redirected to `/formateur/dashboard`
- [ ] Register new user as Administrateur
    - Verify: Redirected to `/admin/dashboard`
- [ ] Login as Administrator
    - Verify: Redirected to `/admin/dashboard`
    - Verify: Dashboard shows user statistics
    - Verify: "Gérer les Utilisateurs" button is visible
- [ ] Access Users Management Page
    - Verify: Click "Gérer les Utilisateurs" from admin dashboard
    - Verify: All users are displayed in a table
    - Verify: "Créer un Nouvel Utilisateur" button is visible at top
    - Verify: Edit and Delete buttons appear for each user

- [ ] Create New User
    - Verify: Click "Créer un Nouvel Utilisateur" button
    - Verify: Create user form opens
    - Verify: Can enter name, email, password, role
    - Verify: Password confirmation required and checked
    - Verify: Email uniqueness validated
    - Verify: Password minimum 8 characters enforced
    - Verify: Success message appears after creation
    - Verify: New user appears in users list
    - Verify: New user has correct role assigned
- [ ] Edit User
    - Verify: Click Edit button for a user
    - Verify: User form opens with current data (except password)
    - Verify: Can update name, email, and role
    - Verify: Success message appears after update
    - Verify: User data is updated in the list
- [ ] Delete User
    - Verify: Click Delete button for a user
    - Verify: Confirmation dialog appears
    - Verify: User is deleted after confirmation
    - Verify: Success message appears
    - Verify: User is removed from the list
- [ ] Role Change
    - Verify: Create user as apprenant role
    - Verify: User redirected to apprenant dashboard on login
    - Verify: Edit user and change role to formateur
    - Verify: User receives new role
    - Verify: User redirected to formateur dashboard on next login

- [ ] Check database
    - Verify: User role is correctly stored in users table
    - Verify: Password is hashed
    - Verify: Deleted users are removed from database

---

## Files Modified/Created

```
✓ database/migrations/2026_03_09_104856_add_role_to_users_table.php
✓ app/Models/User.php
✓ app/Http/Controllers/Auth/RegisteredUserController.php
✓ app/Http/Controllers/AdminController.php (CREATE/READ/UPDATE/DELETE operations)
✓ app/Http/Controllers/FormateurController.php
✓ app/Http/Controllers/ApprenantController.php
✓ resources/views/layouts/guest.blade.php
✓ resources/views/layouts/PublicLayout.blade.php (CREATED - public pages)
✓ resources/views/layouts/app.blade.php (UPDATED - authenticated users)
✓ resources/views/components/admin-layout.blade.php (CREATED - admin pages)
✓ resources/views/layouts/navigation.blade.php
✓ resources/views/front/components/navbar.blade.php (UPDATED - Laravel routes)
✓ resources/views/home.blade.php (UPDATED - eLearning template content)
✓ resources/views/auth/register.blade.php
✓ resources/views/admin/dashboard.blade.php (with statistics)
✓ resources/views/admin/users.blade.php (with create button)
✓ resources/views/admin/create-user.blade.php (NEW - user creation form)
✓ resources/views/admin/edit-user.blade.php (user edit form)
✓ resources/views/formateur/dashboard.blade.php
✓ resources/views/apprenant/dashboard.blade.php
✓ routes/web.php (with create/store routes)
```

---

## Migration Commands

Run the following commands to apply the changes:

```bash
# Create the migration
php artisan migrate

# Rollback if needed
php artisan migrate:rollback
```

---

## Next Steps (Future Enhancements)

- [ ] Add role-based permissions system (Spatie Permissions)
- [ ] Create admin panel for user role management
- [ ] Add role-specific features and content
- [ ] Implement activity logging
- [ ] Add email verification with role-based templates
- [ ] Create role-specific navigation menus

---

## Notes

- All three dashboards are accessible only to authenticated users
- Each role has a dedicated view file for customization
- The default role for new registrations is "apprenant"
- Users can be manually updated to different roles via database or admin panel

---

**Implementation Status:** ✅ COMPLETE
