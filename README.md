# 🔐 Online Library Management System (OLMS) – Secure Edition

This is a **hardened and security-improved** version of the [original OLMS project by DudhagaraJay](https://github.com/DudhagaraJay/Online-Library-Management-System-PHP). The system is built with PHP and MySQL and designed for educational institutions to manage library operations for students, teachers, and librarians.

> 📌 **Security-focused fork by [Prageeth Fernando](https://github.com/prageeth-fndo) [Sachithra Subasingha](https://github.com/SSaschi)**  
> ✅ Fixed 8 major vulnerabilities identified via OWASP ZAP  
> 🔒 Integrated secure login using Google OAuth  

---

## ✨ Key Enhancements in This Fork

- ✅ Replaced raw SQL with **mysqli prepared statements** (protection against SQLi)
- ✅ Added **CSRF tokens** to all critical forms
- ✅ Implemented a **strict Content Security Policy (CSP)**
- ✅ Added secure headers (X-Frame-Options, X-Content-Type-Options)
- ✅ Disabled **directory browsing**
- ✅ Removed **vulnerable JavaScript libraries**
- ✅ Patched cookie security attributes
- ✅ Integrated **Google OAuth 2.0** authentication

---

## ⚙️ Original Features (Retained)

- Book issue and return for students & teachers
- Role-based login and dashboards
- Book request and messaging system
- Fine management and book stock tracking
- Librarian control panel for user management

---

## 🚀 Getting Started

1. Clone the repository  
   ```bash
   git clone https://github.com/prageeth-fndo/OLMS.git

## ⚙️ Setup Instructions

1. Import the `project.sql` file into your MySQL server.
2. Update the database connection settings in `inc/connection.php`.
3. Configure your Google OAuth credentials in the `auth/google/callback` script.
4. Host the project using XAMPP or any similar PHP development environment.

## 🔐 OAuth Integration

This fork includes secure Google OAuth integration using the official OAuth 2.0 Authorization Code Flow.  
Only registered users (verified by email in the database) are allowed to authenticate successfully.

## 👤 Credits

- **Original Author**: [Dudhagara Jay](https://github.com/DudhagaraJay/Online-Library-Management-System-PHP)
- **Security Fork**: [Prageeth Fernando](https://github.com/prageeth-fndo)

## 📜 License

This project inherits the license of the original repository and is shared **strictly for academic and educational purposes**.
