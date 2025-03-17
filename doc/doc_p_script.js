document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons and panes
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Show corresponding tab pane
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Modal functionality
    const modal = document.getElementById('appointmentModal');
    const bookBtn = document.getElementById('bookBtn');
    const closeBtn = document.querySelector('.close');
    const appointmentForm = document.getElementById('appointmentForm');
    
    bookBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });
    
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // Form submission
    appointmentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;
        const reason = document.getElementById('reason').value;
        
        // In a real application, you would send this data to a server
        // For this example, we'll just show an alert
        alert(`Thank you, ${name}! Your appointment request for ${date} at ${time} has been submitted. We will contact you shortly to confirm.`);
        
        // Close the modal and reset form
        modal.style.display = 'none';
        appointmentForm.reset();
    });
    
    // Set minimum date for appointment to today
    const dateInput = document.getElementById('date');
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const formattedToday = `${yyyy}-${mm}-${dd}`;
    dateInput.setAttribute('min', formattedToday);
    
    // Add some animation to reviews for visual interest
    const reviews = document.querySelectorAll('.review');
    reviews.forEach((review, index) => {
        review.style.opacity = '0';
        review.style.transform = 'translateY(20px)';
        review.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        
        // Stagger the animations
        setTimeout(() => {
            review.style.opacity = '1';
            review.style.transform = 'translateY(0)';
        }, 100 * index);
    });
});