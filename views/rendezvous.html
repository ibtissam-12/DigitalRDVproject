<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un rendez-vous</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .booking-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 550px;
            padding: 30px;
            transition: transform 0.3s ease;
        }
        
        .booking-container:hover {
            transform: translateY(-5px);
        }
        
        .booking-title {
            color: #00B8A9;
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }
        
        .form-input, .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border 0.3s, box-shadow 0.3s;
        }
        
        .form-input:focus, .form-select:focus {
            border-color: #00B8A9;
            box-shadow: 0 0 0 2px rgba(0, 184, 169, 0.2);
            outline: none;
        }
        
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
        }
        
        .submit-btn {
            background-color: #00B8A9;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 14px;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        
        .submit-btn:hover {
            background-color: #00a296;
        }
        
        /* Calendar section */
        .calendar {
            margin-bottom: 25px;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .calendar-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }
        
        .calendar-nav {
            display: flex;
            gap: 10px;
        }
        
        .calendar-nav-btn {
            width: 30px;
            height: 30px;
            background-color: #f5f5f5;
            border: none;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .calendar-nav-btn:hover {
            background-color: #e0e0e0;
        }
        
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
        }
        
        .calendar-day-header {
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            color: #777;
            padding: 5px 0;
        }
        
        .calendar-day {
            aspect-ratio: 1/1;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
            position: relative;
        }
        
        .calendar-day.empty {
            cursor: default;
        }
        
        .calendar-day.available:hover {
            background-color: #e0f7f5;
        }
        
        .calendar-day.selected {
            background-color: #00B8A9;
            color: white;
        }
        
        .calendar-day.disabled {
            color: #ccc;
            cursor: not-allowed;
        }
        
        /* Time slots section */
        .time-slots {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 25px;
        }
        
        .time-slot {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }
        
        .time-slot:hover {
            background-color: #e0f7f5;
            border-color: #00B8A9;
        }
        
        .time-slot.selected {
            background-color: #00B8A9;
            color: white;
            border-color: #00B8A9;
        }
        
        .time-slot.disabled {
            color: #ccc;
            cursor: not-allowed;
            background-color: #f9f9f9;
        }
        
        /* Summary section */
        .booking-summary {
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .summary-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .summary-label {
            color: #666;
        }
        
        .summary-value {
            font-weight: 500;
            color: #333;
        }
        
        /* Responsive adjustments */
        @media (max-width: 480px) {
            .booking-container {
                padding: 20px;
            }
            
            .booking-title {
                font-size: 20px;
            }
            
            .time-slots {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .section-title {
            color: #333;
            font-size: 18px;
            margin: 25px 0 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
        }
        
        .half {
            flex: 1;
        }
        
        textarea.form-input {
            resize: vertical;
            min-height: 80px;
        }
        
        @media (max-width: 480px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <h1 class="booking-title">Prendre un rendez-vous</h1>
        
        <form id="booking-form">
            <div class="form-group">
                <label for="service" class="form-label">Type de service</label>
                <select id="service" class="form-select" required>
                    <option value="" disabled selected>Sélectionnez un service</option>
                    <option value="consultation">Consultation</option>
                    <option value="checkup">Examen médical</option>
                    <option value="followup">Suivi médical</option>
                    <option value="other">Autre</option>
                </select>
            </div>
            
            <div class="calendar">
                <div class="calendar-header">
                    <div class="calendar-title" id="month-year">Avril 2025</div>
                    <div class="calendar-nav">
                        <button type="button" class="calendar-nav-btn" id="prev-month">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>
                        <button type="button" class="calendar-nav-btn" id="next-month">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="calendar-grid">
                    <div class="calendar-day-header">L</div>
                    <div class="calendar-day-header">M</div>
                    <div class="calendar-day-header">M</div>
                    <div class="calendar-day-header">J</div>
                    <div class="calendar-day-header">V</div>
                    <div class="calendar-day-header">S</div>
                    <div class="calendar-day-header">D</div>
                    <!-- Calendar days will be generated by JavaScript -->
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Heures disponibles</label>
                <div class="time-slots" id="time-slots">
                    <!-- Time slots will be generated by JavaScript -->
                </div>
            </div>
            
            <div class="booking-summary" id="booking-summary">
                <h3 class="summary-title">Récapitulatif</h3>
                <div class="summary-item">
                    <span class="summary-label">Service:</span>
                    <span class="summary-value" id="summary-service">--</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Date:</span>
                    <span class="summary-value" id="summary-date">--</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Heure:</span>
                    <span class="summary-value" id="summary-time">--</span>
                </div>
            </div>

            <div class="form-group">
                <h3 class="section-title">Vos informations</h3>

                <div class="form-row">
                    <div class="form-group half">
                        <label for="firstName" class="form-label">Prénom</label>
                        <input type="text" id="firstName" class="form-input" required>
                    </div>
                    <div class="form-group half">
                        <label for="lastName" class="form-label">Nom</label>
                        <input type="text" id="lastName" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="tel" id="phone" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="notes" class="form-label">Notes / Symptômes (optionnel)</label>
                    <textarea id="notes" class="form-input" rows="3"></textarea>
                </div>
            </div>

            <button type="submit" class="submit-btn">Confirmer le rendez-vous</button>
        </form>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
    // Variables
    let currentDate = new Date();
    let selectedDate = null;
    let selectedTime = null;
    let selectedService = '';
    
    // Elements
    const monthYearElement = document.getElementById('month-year');
    const calendarGrid = document.querySelector('.calendar-grid');
    const timeSlots = document.getElementById('time-slots');
    const serviceSelect = document.getElementById('service');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const summaryService = document.getElementById('summary-service');
    const summaryDate = document.getElementById('summary-date');
    const summaryTime = document.getElementById('summary-time');
    const bookingForm = document.getElementById('booking-form');
    
    // Month names in French
    const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    
    // Service options in French
    const serviceOptions = {
        'consultation': 'Consultation',
        'checkup': 'Examen médical',
        'followup': 'Suivi médical',
        'other': 'Autre'
    };
    
    // Generate time slots
    function generateTimeSlots() {
        // Clear existing time slots
        timeSlots.innerHTML = '';
        
        // Sample time slots (9:00 AM to 5:00 PM)
        const hours = ['9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00'];
        
        // Random unavailable slots for demo purposes
        const unavailableSlots = [];
        for (let i = 0; i < 3; i++) {
            unavailableSlots.push(Math.floor(Math.random() * hours.length));
        }
        
        // Create time slot elements
        hours.forEach((hour, index) => {
            const timeSlot = document.createElement('div');
            timeSlot.classList.add('time-slot');
            
            // Check if the slot is unavailable
            if (unavailableSlots.includes(index)) {
                timeSlot.classList.add('disabled');
                timeSlot.textContent = hour;
            } else {
                timeSlot.textContent = hour;
                timeSlot.addEventListener('click', () => selectTimeSlot(timeSlot, hour));
            }
            
            timeSlots.appendChild(timeSlot);
        });
    }
    
    // Select time slot
    function selectTimeSlot(element, time) {
        // Remove selected class from all time slots
        const allTimeSlots = document.querySelectorAll('.time-slot');
        allTimeSlots.forEach(slot => slot.classList.remove('selected'));
        
        // Add selected class to the clicked time slot
        element.classList.add('selected');
        
        // Update selected time
        selectedTime = time;
        
        // Update summary
        updateSummary();
    }
    
    // Update calendar display
    function updateCalendar() {
        // Update month and year display
        monthYearElement.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
        
        // Clear existing calendar days
        const calendarDays = document.querySelectorAll('.calendar-day');
        calendarDays.forEach(day => day.remove());
        
        // Get the first day of the month
        const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
        // Get the last day of the month
        const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
        
        // Get the day of the week of the first day (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
        let firstDayOfWeek = firstDay.getDay();
        // Adjust for Monday as the first day of the week
        firstDayOfWeek = firstDayOfWeek === 0 ? 6 : firstDayOfWeek - 1;
        
        // Create empty cells for the days before the first day of the month
        for (let i = 0; i < firstDayOfWeek; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('calendar-day', 'empty');
            calendarGrid.appendChild(emptyDay);
        }
        
        // Create cells for each day of the month
        const today = new Date();
        const currentYear = today.getFullYear();
        const currentMonth = today.getMonth();
        const currentDay = today.getDate();
        
        for (let day = 1; day <= lastDay.getDate(); day++) {
            const dayElement = document.createElement('div');
            dayElement.classList.add('calendar-day');
            dayElement.textContent = day;
            
            // Check if the day is in the past
            const isPast = 
                currentDate.getFullYear() < currentYear ||
                (currentDate.getFullYear() === currentYear && currentDate.getMonth() < currentMonth) ||
                (currentDate.getFullYear() === currentYear && currentDate.getMonth() === currentMonth && day < currentDay);
            
            // Check if the day is a weekend (Saturday or Sunday)
            const dayOfWeek = new Date(currentDate.getFullYear(), currentDate.getMonth(), day).getDay();
            const isWeekend = dayOfWeek === 0 || dayOfWeek === 6;
            
            // Disable past days and weekends
            if (isPast || isWeekend) {
                dayElement.classList.add('disabled');
            } else {
                dayElement.classList.add('available');
                
                // Add click event to select the day
                dayElement.addEventListener('click', () => {
                    // Remove selected class from all days
                    const allDays = document.querySelectorAll('.calendar-day');
                    allDays.forEach(d => d.classList.remove('selected'));
                    
                    // Add selected class to the clicked day
                    dayElement.classList.add('selected');
                    
                    // Update selected date
                    selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
                    
                    // Generate new time slots for the selected date
                    generateTimeSlots();
                    
                    // Reset selected time
                    selectedTime = null;
                    
                    // Update summary
                    updateSummary();
                });
            }
            
            calendarGrid.appendChild(dayElement);
        }
    }
    
    // Update summary
    function updateSummary() {
        // Format the date as DD/MM/YYYY
        const formattedDate = selectedDate ? 
            `${selectedDate.getDate().toString().padStart(2, '0')}/${(selectedDate.getMonth() + 1).toString().padStart(2, '0')}/${selectedDate.getFullYear()}` : 
            '--';
        
        // Update summary elements
        summaryService.textContent = selectedService ? serviceOptions[selectedService] : '--';
        summaryDate.textContent = formattedDate;
        summaryTime.textContent = selectedTime || '--';
    }
    
    // Navigate to previous month
    prevMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateCalendar();
    });
    
    // Navigate to next month
    nextMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateCalendar();
    });
    
    // Service selection change
    serviceSelect.addEventListener('change', () => {
        selectedService = serviceSelect.value;
        updateSummary();
    });
    
    // Form submission
    
bookingForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Validation
    if (!selectedService) {
        alert('Veuillez sélectionner un service.');
        return;
    }
    
    if (!selectedDate) {
        alert('Veuillez sélectionner une date.');
        return;
    }
    
    if (!selectedTime) {
        alert('Veuillez sélectionner une heure.');
        return;
    }
    
    // Enregistrer les détails du rendez-vous dans le localStorage
    localStorage.setItem('booking-service', serviceOptions[selectedService]);
    localStorage.setItem('booking-date', summaryDate.textContent);
    localStorage.setItem('booking-time', selectedTime);
    
    // Enregistrer les informations personnelles dans le localStorage
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const notes = document.getElementById('notes').value;
    
    localStorage.setItem('booking-firstName', firstName);
    localStorage.setItem('booking-lastName', lastName);
    localStorage.setItem('booking-email', email);
    localStorage.setItem('booking-phone', phone);
    localStorage.setItem('booking-notes', notes);
    
    // Rediriger vers la page de confirmation
    window.location.href = 'confirmation-rendez-vous.html';
});
    
    // Initialize calendar
    updateCalendar();
});
    </script>
</body>
</html>