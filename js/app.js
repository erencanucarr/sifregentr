// Initialize particles.js
particlesJS('particles-js', {
    particles: {
        number: {
            value: 80,
            density: {
                enable: true,
                value_area: 800
            }
        },
        color: {
            value: '#a259ff'
        },
        shape: {
            type: 'circle'
        },
        opacity: {
            value: 0.5,
            random: false
        },
        size: {
            value: 3,
            random: true
        },
        line_linked: {
            enable: true,
            distance: 150,
            color: '#00ccff',
            opacity: 0.4,
            width: 1
        },
        move: {
            enable: true,
            speed: 2,
            direction: 'none',
            random: false,
            straight: false,
            out_mode: 'out',
            bounce: false
        }
    },
    interactivity: {
        detect_on: 'canvas',
        events: {
            onhover: {
                enable: true,
                mode: 'repulse'
            },
            onclick: {
                enable: true,
                mode: 'push'
            },
            resize: true
        }
    },
    retina_detect: true
});

// Password Generator Functionality
document.addEventListener('DOMContentLoaded', () => {
    const passwordOutput = document.getElementById('passwordOutput');
    const lengthSlider = document.getElementById('lengthSlider');
    const lengthValue = document.getElementById('lengthValue');
    const generateBtn = document.getElementById('generateBtn');
    const copyBtn = document.getElementById('copyBtn');
    const lowercaseCheck = document.getElementById('lowercase');
    const uppercaseCheck = document.getElementById('uppercase');
    const numbersCheck = document.getElementById('numbers');
    const symbolsCheck = document.getElementById('symbols');

    let isGenerating = false;

    // Helper to update password and strength
    const updatePassword = async () => {
        if (isGenerating) return;
        
        isGenerating = true;
        try {
            const password = await generatePassword();
            passwordOutput.value = password;
            analyzePassword(password);
        } finally {
            isGenerating = false;
        }
    };

    // Update length value display and password immediately
    lengthSlider.addEventListener('input', () => {
        lengthValue.textContent = lengthSlider.value;
        updatePassword();
    });

    // Update password when character type checkboxes change
    [lowercaseCheck, uppercaseCheck, numbersCheck, symbolsCheck].forEach(checkbox => {
        checkbox.addEventListener('change', updatePassword);
    });

    // Generate password using backend
    const generatePassword = async () => {
        const length = parseInt(lengthSlider.value);
        const data = new URLSearchParams();
        data.append('length', length);
        data.append('useLowercase', lowercaseCheck.checked);
        data.append('useUppercase', uppercaseCheck.checked);
        data.append('useNumbers', numbersCheck.checked);
        data.append('useSymbols', symbolsCheck.checked);

        try {
            const response = await fetch('src/generate.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: data.toString(),
            });
            const result = await response.json();
            if (result.password) {
                return result.password;
            } else {
                console.error(result.error || 'Failed to generate password.');
                return passwordOutput.value; // Keep existing password on error
            }
        } catch (error) {
            console.error('Error connecting to password generator.');
            return passwordOutput.value; // Keep existing password on error
        }
    };

    // Generate button click handler
    generateBtn.addEventListener('click', async () => {
        if (!isGenerating) {
            await updatePassword();
            // Add animation effect
            generateBtn.classList.add('clicked');
            setTimeout(() => {
                generateBtn.classList.remove('clicked');
            }, 200);
        }
    });

    // Copy button click handler
    copyBtn.addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(passwordOutput.value);
            
            // Show success feedback
            const originalIcon = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check"></i>';
            setTimeout(() => {
                copyBtn.innerHTML = originalIcon;
            }, 1500);
        } catch (err) {
            console.error('Failed to copy password:', err);
        }
    });

    // Analyze password strength
    const analyzePassword = (password) => {
        let strength = 0;
        
        // Length check
        if (password.length >= 12) strength += 25;
        if (password.length >= 16) strength += 10;
        
        // Character variety checks
        if (/[a-z]/.test(password)) strength += 15;
        if (/[A-Z]/.test(password)) strength += 15;
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^A-Za-z0-9]/.test(password)) strength += 20;
        
        // Update password input border color based on strength
        const passwordDisplay = document.querySelector('.password-display');
        
        if (strength >= 90) {
            passwordDisplay.style.borderColor = '#1ea885';
        } else if (strength >= 70) {
            passwordDisplay.style.borderColor = '#4caf50';
        } else if (strength >= 50) {
            passwordDisplay.style.borderColor = '#ffc107';
        } else {
            passwordDisplay.style.borderColor = '#f44336';
        }
    };

    // Generate initial password
    updatePassword();
});

// Smooth scroll for navigation
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        
        // Only handle internal links that start with #
        if (href.startsWith('#')) {
            e.preventDefault();
            const targetId = href.substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        }
    });
});
