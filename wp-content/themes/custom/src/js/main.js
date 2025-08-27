/**
 * Main JavaScript file for custom theme
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Custom theme loaded');
    
    // Mobile menu toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const primaryMenu = document.querySelector('#primary-menu');
    
    if (mobileMenuToggle && primaryMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            primaryMenu.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
});