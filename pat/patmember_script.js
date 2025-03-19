// Logout functionality
document.getElementById('logout-nav').addEventListener('click', function() {
    alert('Logging out...');
    // Redirect to login page or perform logout logic
});

// Function to load appointments dynamically
document.getElementById('appointments-nav').addEventListener('click', function() {
    loadAppointments();
});

// Example data for all appointments
const allAppointments = [


    
    {
        patientName: 'qqqqq',
        status: 'Confirmed',
        date: 'Today, March 11, 2025',
        time: '10:30 AM - 11:00 AM',
        type: 'Regular Checkup'
    },
    {
        patientName: 'sssss',
        status: 'Pending',
        date: 'Tomorrow, March 12, 2025',
        time: '2:00 PM - 2:30 PM',
        type: 'Consultation'
    },
    {
        patientName: 'wwwww',
        status: 'Confirmed',
        date: 'March 13, 2025',
        time: '9:00 AM - 9:30 AM',
        type: 'Follow-up'
    },
    {
        patientName: 'eeeee',
        status: 'Cancelled',
        date: 'March 14, 2025',
        time: '3:00 PM - 3:30 PM',
        type: 'Consultation'
    },
    {
        patientName: 'rrrrr',
        status: 'Confirmed',
        date: 'March 15, 2025',
        time: '11:00 AM - 11:30 AM',
        type: 'Follow-up'
    },
    {
        patientName: 'ttttt',
        status: 'Pending',
        date: 'March 16, 2025',
        time: '1:00 PM - 1:30 PM',
        type: 'Consultation'
    },
    {
        patientName: 'yyyyy',
        status: 'Confirmed',
        date: 'March 17, 2025',
        time: '10:00 AM - 10:30 AM',
        type: 'Regular Checkup'
    },
    {
        patientName: 'uuuuu',
        status: 'Pending',
        date: 'March 18, 2025',
        time: '2:00 PM - 2:30 PM',
        type: 'Consultation'
    }
];

// Function to load the last two appointments in the profile
function loadProfileAppointments() {
    const profileAppointmentsList = document.getElementById('profile-appointments-list');
    const lastTwoAppointments = allAppointments.slice(-2); // Get the last two appointments

    // Clear existing appointments
    profileAppointmentsList.innerHTML = '';

    // Populate the last two appointments
    lastTwoAppointments.forEach(appointment => {
        const appointmentCard = document.createElement('div');
        appointmentCard.className = 'appointment-card';
        appointmentCard.innerHTML = `
            <div class="appointment-header">
                <div class="patient-name">${appointment.patientName}</div>
                <div class="appointment-status status-${appointment.status.toLowerCase()}">${appointment.status}</div>
            </div>
            <div class="appointment-details">
                <div class="detail-item">
                    <i class="fas fa-calendar-day detail-icon"></i>
                    <div>${appointment.date}</div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-clock detail-icon"></i>
                    <div>${appointment.time}</div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-stethoscope detail-icon"></i>
                    <div>${appointment.type}</div>
                </div>
            </div>
        `;
        profileAppointmentsList.appendChild(appointmentCard);
    });
}

// Function to load additional appointments in the Appointments section (only 5 appointments)
function loadAppointments() {
    const appointmentsList = document.getElementById('appointments-list');

    // Clear existing appointments
    appointmentsList.innerHTML = '';

    // Populate only 5 appointments (excluding the last two)
    const appointmentsToShow = allAppointments.slice(0, -2).slice(0, 5); // Get the first 5 appointments (excluding the last two)

    appointmentsToShow.forEach(appointment => {
        const appointmentCard = document.createElement('div');
        appointmentCard.className = 'appointment-card';
        appointmentCard.setAttribute('onclick', `showAppointmentHistory('${appointment.patientName}')`);
        appointmentCard.innerHTML = `
            <div class="appointment-header">
                <div class="patient-name">${appointment.patientName}</div>
                <div class="appointment-status status-${appointment.status.toLowerCase()}">${appointment.status}</div>
            </div>
            <div class="appointment-details">
                <div class="detail-item">
                    <i class="fas fa-calendar-day detail-icon"></i>
                    <div>${appointment.date}</div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-clock detail-icon"></i>
                    <div>${appointment.time}</div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-stethoscope detail-icon"></i>
                    <div>${appointment.type}</div>
                </div>
            </div>
        `;
        appointmentsList.appendChild(appointmentCard);
    });
}

// Function to show appointment history (5 appointments)
function showAppointmentHistory(patientName) {
    const historyList = document.getElementById('history-list');
    const historySection = document.getElementById('appointment-history');

    // Example history data (5 appointments)
    const historyData = {
        qqqqq: [
            { date: 'March 10, 2025', time: '3:30 PM - 4:00 PM', type: 'Follow-up' },
            { date: 'March 5, 2025', time: '11:00 AM - 11:30 AM', type: 'Regular Checkup' },
            { date: 'March 1, 2025', time: '9:00 AM - 9:30 AM', type: 'Consultation' },
            { date: 'February 25, 2025', time: '2:00 PM - 2:30 PM', type: 'Follow-up' },
            { date: 'February 20, 2025', time: '10:00 AM - 10:30 AM', type: 'Regular Checkup' }
        ],
        sssss: [
            { date: 'March 8, 2025', time: '9:00 AM - 9:30 AM', type: 'Consultation' },
            { date: 'March 1, 2025', time: '2:00 PM - 2:30 PM', type: 'Follow-up' },
            { date: 'February 25, 2025', time: '11:00 AM - 11:30 AM', type: 'Regular Checkup' },
            { date: 'February 20, 2025', time: '3:00 PM - 3:30 PM', type: 'Consultation' },
            { date: 'February 15, 2025', time: '10:00 AM - 10:30 AM', type: 'Follow-up' }
        ]
    };

    // Clear previous history
    historyList.innerHTML = '';

    // Populate history (5 appointments)
    historyData[patientName].forEach(appointment => {
        const historyItem = document.createElement('div');
        historyItem.className = 'appointment-card';
        historyItem.innerHTML = `
            <div class="appointment-details">
                <div class="detail-item">
                    <i class="fas fa-calendar-day detail-icon"></i>
                    <div>${appointment.date}</div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-clock detail-icon"></i>
                    <div>${appointment.time}</div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-stethoscope detail-icon"></i>
                    <div>${appointment.type}</div>
                </div>
            </div>
        `;
        historyList.appendChild(historyItem);
    });

    // Show history section
    historySection.style.display = 'block';
}

// Load the last two appointments in the profile when the page loads
window.onload = function() {
    loadProfileAppointments();
};