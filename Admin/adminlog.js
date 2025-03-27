document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const rememberMe = document.getElementById('remember-me');
    
    // Check for remembered email
    if (document.cookie.includes('remember_email')) {
        const email = getCookie('remember_email');
        document.getElementById('email').value = email;
        rememberMe.checked = true;
    }
    
    // Form submission handler
    loginForm.addEventListener('submit', function(e) {
        // Only validate client-side, don't prevent default
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        
        if (!email || !password) {
            e.preventDefault();
            alert('Please fill in all fields');
            return false;
        }
        
        // If validation passes, the form will submit normally to PHP
        return true;
    });
    
    // Helper function to get cookies
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
});