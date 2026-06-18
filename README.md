# MediFix - Healthcare Intelligence & Equipment Management

![Masaka Hospital Logo](MediFix/assets/images/logos/masaka-logo.png)

**MediFix** is a high-performance, intelligent platform designed for **Masaka Hospital** to streamline medical equipment maintenance, technical support, and infrastructure management. It combines traditional management workflows with state-of-the-art **AI Diagnostics** to ensure hospital equipment stays operational when it matters most.

---

## 🚀 How It Works

MediFix operates through a structured collaboration between three main hospital roles, ensuring every technical issue is tracked from detection to resolution.

### 1. The Triage Phase (Doctors)
- **Reporting**: Doctors identify faulty medical equipment and log a "Job Request" through their dashboard.
- **AI Intelligence**: Before involving a technician, doctors can use the **Ask AI** feature. The AI provides immediate troubleshooting steps and potential causes based on the equipment type and symptoms.
- **Escalation**: If the AI triage doesn't resolve the issue, the request is escalated to the Administration team.

### 2. The Coordination Phase (Administrators)
- **Review**: Admins oversee all pending requests from various hospital wings.
- **Assignment**: Admins select a qualified **Technician** and assign the job.
- **Notification**: The system automatically sends an **SMS and Email alert** to the technician via the *Mista.io* API, ensuring zero delays in communication.

### 3. The Resolution Phase (Technicians)
- **Diagnostics**: Technicians receive the job on their dashboard, complete with AI-generated technical insights to speed up the repair.
- **Execution**: Technicians log their actions, spare parts used, and time spent.
- **Closure**: Once verified, the case is marked as "Maintained," and the doctor is notified of the resolution.

---

## 🛠️ Key Technical Features

### 🧠 Intelligent Diagnostics (Ask AI)
A dedicated module that leverages AI to provide medical hardware troubleshooting. It helps reduce "simple" call-outs by empowering doctors with immediate technical guidance.

### 🌓 Premium User Interface
- **Modern Aesthetics**: Built with a "premium-theme" featuring glassmorphism and smooth micro-animations.
- **Unified Dark Mode**: A system-wide dark mode toggle ensuring comfort during night shifts.
- **Interactive Analytics**: Visual data tracking for equipment status using *ApexCharts*.

### 📱 Integrated Communication
- **Real-time Alerts**: SMS integration for urgent technical assignments.
- **Email Dispatcher**: Automated HTML emails for reporting and logging.

---

## 💻 Tech Stack
- **Core**: Vanilla PHP & MySQL.
- **Frontend**: HTML5, CSS3 (Custom Design System), JavaScript (jQuery, Bootstrap).
- **APIs**: AI Proxy, Mista.io SMS API.

---

## ⚙️ Installation & Setup

1. **Database Setup**:
   - Create a database named `medifix` in your MySQL environment (XAMPP/MAMP).
   - Import the `medifix.sql` file located in the `MediFix/db/` directory.

2. **Configuration**:
   - Update `MediFix/run/connector.php` with your local database credentials.

3. **Web Server**:
   - Place the project folder in your `htdocs` or `www` directory.
   - Access the platform via `http://localhost/MediFix/`.

---

## 🏥 Hospital Branding
This instance is exclusively branded for **Masaka Hospital**. All UI elements, logos, and system references are tailored to the hospital's specific operational needs.

---
*Designed & Developed for Visual Excellence and Operational Efficiency.*
