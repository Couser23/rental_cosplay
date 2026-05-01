# Rental Costum Cosplay 🎭

A modern, full-stack web application for managing cosplay costume rentals. Built with a premium "Glassmorphism" design system and a fully responsive architecture.

## 🚀 Features

### 👤 User Side

- **Premium Catalog**: Modern grid display for costume collections.
- **Identity Verification**: Secure KTP/ID card upload system for rental eligibility.
- **Dynamic Booking**: Integrated booking system with real-time stock availability check.
- **Rental History**: Personal dashboard to track rent status and payments.
- **Responsive Layout**: Fully optimized for mobile with an off-canvas hamburger sidebar.

### ⚙️ Admin Side

- **Modern Dashboard**: Overview of system statistics and management shortcuts.
- **Inventory Management**: Full CRUD (Create, Read, Update, Delete) for costumes.
- **Order Management**: Handle rental transactions (Accept/Reject orders).
- **User Management**: Monitor registered customers and their verification status.
- **Professional Sidebar**: Fixed navigation system for efficient administrative workflow.

## 🛠️ Technology Stack

- **Backend**: PHP Native (MVC Pattern)
- **Database**: MySQL (PDO)
- **Frontend**: Vanilla HTML5, Modern CSS3 (Flexbox/Grid), Glassmorphism UI.
- **Icons**: Emoji-based for lightweight performance.

## 🧪 Testing

To ensure the application runs correctly, perform the following tests:

1. **Authentication Test**: Verify user registration, login, and session persistence.
2. **Authorization Test**: Ensure normal users cannot access `/admin_dashboard` routes.
3. **Rental Flow Test**:
   - Register a new user.
   - Upload KTP (Admin must verify first).
   - Once verified, rent a costume from the catalog.
   - Verify transaction status in both User and Admin panels.
4. **Responsive Test**: Inspect the element in Chrome/Firefox and toggle Device Toolbar to mobile mode (max-width 768px) to verify the Hamburger Sidebar behavior.

## 📦 Installation

1. Clone the repository to your local server (e.g., Laragon/XAMPP).
2. Import the provided SQL file into your MySQL database.
3. Configure `config/database.php` with your local credentials.
4. Access via `localhost/rental_costum/index.php`.

## 📄 License

This project is for educational and portfolio purposes. Feel free to modify and use it for your own rental business projects.

---

_Created with by Pradipta Adiya Ananta_
