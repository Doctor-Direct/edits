// JavaScript for section switching
document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.sidebar li');
    const sections = document.querySelectorAll('.section');
    
    // Function to show a specific section
    function showSection(sectionId) {
        // Hide all sections
        sections.forEach(section => {
            section.classList.remove('active');
        });
        
        // Show the selected section
        const selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
            selectedSection.classList.add('active');
        }
        
        // Update navigation active state
        navItems.forEach(item => {
            item.classList.remove('active');
        });
        
        const activeNav = document.getElementById(sectionId + '-nav');
        if (activeNav) {
            activeNav.classList.add('active');
        }
    }
    
    // Add click event listeners to navigation items
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const sectionId = this.querySelector('a').getAttribute('href').substring(1);
            showSection(sectionId);
        });
    });
    
    // Handle hash changes for direct links
    window.addEventListener('hashchange', function() {
        const hash = window.location.hash.substring(1);
        if (hash) {
            showSection(hash);
        }
    });
    
    // Check for hash on page load
    if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        showSection(hash);
    }
    
    // Calendar functionality
    const calendarDays = document.querySelectorAll('.calendar-day');
    calendarDays.forEach(day => {
        if (!day.classList.contains('other-month')) {
            day.addEventListener('click', function() {
                // Update time slots heading
                const timeSlotsHeading = document.querySelector('.time-slots h3');
                if (timeSlotsHeading) {
                    timeSlotsHeading.textContent = `Available Time Slots for March ${this.textContent}, 2025`;
                }
            });
        }
    });
    
    // Time slot selection
    const timeSlots = document.querySelectorAll('.time-slot:not(.booked)');
    timeSlots.forEach(slot => {
        slot.addEventListener('click', function() {
            timeSlots.forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
});