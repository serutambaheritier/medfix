/**
 * Premium Interactions - MediFix UI
 * This script handles micro-animations, dynamic toast notifications, and interactive elements.
 */

document.addEventListener("DOMContentLoaded", () => {
    // 1. Staggered Entrance Animations
    // Add the class 'stagger-item' to any element you want to animate in sequentially
    const staggerItems = document.querySelectorAll('.stagger-item');
    staggerItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 100 * index); // Stagger by 100ms
    });

    // 2. Ripple Effect for Buttons
    const buttons = document.querySelectorAll('.btn-premium');
    buttons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            let x = e.clientX - e.target.getBoundingClientRect().left;
            let y = e.clientY - e.target.getBoundingClientRect().top;
            
            let ripples = document.createElement('span');
            ripples.style.left = x + 'px';
            ripples.style.top = y + 'px';
            ripples.classList.add('ripple');
            this.appendChild(ripples);
            
            setTimeout(() => {
                ripples.remove();
            }, 1000);
        });
    });

    // 3. Dynamic Alerts (Toast functionality for PHP error params)
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.has('success') || urlParams.has('error') || urlParams.has('invalid_login') || urlParams.has('please_login')) {
        let message = "Notification";
        let type = "info";

        if(urlParams.has('invalid_login')) {
            message = "Invalid username or password. Please try again.";
            type = "error";
        } else if (urlParams.has('please_login')) {
            message = "Please log in to access your dashboard.";
            type = "warning";
        } else if (urlParams.has('success')) {
            message = "Operation completed successfully!";
            type = "success";
        }

        showToast(message, type);
    }
});

/**
 * Displays a premium toast notification
 */
function showToast(message, type = 'info') {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();
    
    const toast = document.createElement('div');
    toast.className = `premium-toast toast-${type}`;
    
    // Icon based on type
    let iconSvg = '';
    if (type === 'error' || type === 'warning') {
        iconSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>`;
    } else if (type === 'success') {
        iconSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`;
    }

    toast.innerHTML = `
        <div class="toast-icon">${iconSvg}</div>
        <div class="toast-message">${message}</div>
        <div class="toast-close">&times;</div>
    `;

    toastContainer.appendChild(toast);

    // Trigger animation
    setTimeout(() => {
        toast.classList.add('show');
    }, 10);

    // Close button
    toast.querySelector('.toast-close').addEventListener('click', () => {
        removeToast(toast);
    });

    // Auto remove
    setTimeout(() => {
        removeToast(toast);
    }, 5000);
}

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    document.body.appendChild(container);
    return container;
}

function removeToast(toast) {
    toast.classList.remove('show');
    setTimeout(() => {
        toast.remove();
    }, 300); // Wait for transition
}
