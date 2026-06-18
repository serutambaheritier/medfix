/**
 * Premium Interactions - MediFix UI
 * This script handles micro-animations, dynamic toast notifications, and interactive elements.
 */

document.addEventListener("DOMContentLoaded", () => {
    // Staggered Entrance Animations
    const staggerItems = document.querySelectorAll('.stagger-item');
    staggerItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 100 * index);
    });
});
