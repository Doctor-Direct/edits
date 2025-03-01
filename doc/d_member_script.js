document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll(".sidebar ul li");
    const sections = document.querySelectorAll(".section");

    navItems.forEach((item) => {
        item.addEventListener("click", function () {
            // Remove active class from all items
            navItems.forEach((nav) => nav.classList.remove("active"));
            this.classList.add("active");

            // Hide all sections
            sections.forEach((section) => section.classList.remove("active"));

            // Show the selected section
            const targetSection = this.textContent.toLowerCase();
            document.getElementById(targetSection).classList.add("active");
        });
    });
});
