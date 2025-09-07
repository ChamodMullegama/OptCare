# Optcare - AI-Powered Web Application for Retinal Disease Diagnosis via OCT Scan Analysis with Vision Health Education

OptCare is an AI-powered web platform that analyzes OCT scans using deep learning to detect four conditions (DME, CNV, Drusen, Normal) and generates detailed reports. It also integrates telemedicine for online ophthalmologist consultations, an e-commerce platform for eye care products, and an educational portal for vision health awareness. Built with Flask (Python) for AI and Laravel (PHP) for the web application, OptCare provides a unified solution bridging AI-driven diagnostics with healthcare services.

## Demo Images
<div align="center">
  <table>
    <tr>
      <td><img src="/Documents/Demo Images/patient1.png" width="300" alt="Home Page"></td>
      <td><img src="/Documents/Demo Images/patient12.png" width="300" alt="Home Page"></td>
      <td><img src="/Documents/Demo Images/patient13.png" width="300" alt="Home Page"></td>
    </tr>
    <tr>
       <td><img src="/Documents/Demo Images/doctor1.png" width="300" alt="Home Page"></td>
       <td><img src="/Documents/Demo Images/doctor2.png" width="300" alt="Home Page"></td>
       <td><img src="/Documents/Demo Images/doctor3.png" width="300" alt="Home Page"></td>
    </tr>
      <tr>
            <td><img src="/Documents/Demo Images/admin1.png" width="300" alt="Home Page"></td>
            <td><img src="/Documents/Demo Images/admin2.png" width="300" alt="Home Page"></td>
            <td><img src="/Documents/Demo Images/admin3.png" width="300" alt="Home Page"></td>
    </tr>
  </table>
</div>

## Technologies Used

**Frameworks & Languages**
- Laravel (PHP) – Web application & backend logic  
- Flask (Python) – AI backend & OCT scan analysis  
- Python – Machine learning & CNN model development  

**Frontend Tools**
- Laravel Blade – Dynamic templating  
- Bootstrap 5 – Responsive design  
- jQuery – Interactive client-side features  
- Toaster.js – User notifications  
- FontAwesome – Scalable vector icons  

**APIs & Integrations**
- Google Gemini API – AI-based recommendations  
- REST API – Communication between web & AI services  
- Mailtrap – Email testing & notifications  
- Twilio – SMS notifications & reminders  
- Stripe – Secure payment gateway  
- Laravel Socialite – Social authentication (Google login)  
- Chatbase – Chatbot integration for vision health guidance  
- Google Maps API – Location services  

**Database**
- MySQL – Data storage (patients, appointments, orders, scan reports)  
- phpMyAdmin – Database management  

## Installation
1. Clone the project  
2. Navigate to the project's root directory using terminal  
3. Create `.env` file - `cp .env.example .env`  
4. Execute `composer install`  
5. Execute `npm install`  
6. Set application key - `php artisan key:generate --ansi`  
7. Execute migrations and seed data - `php artisan migrate --seed`  
8. Start Artisan server - `php artisan serve`  
