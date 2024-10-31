document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            const inputs = this.querySelectorAll('input[required]');
            let valid = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    valid = false;
                    input.style.borderColor = '#E83A3A'; // Red border for invalid input
                } else {
                    input.style.borderColor = '#ddd'; // Default border color
                }
            });
            if (!valid) {
                event.preventDefault(); // Prevent form submission if not valid
                alert('Please fill in all required fields.');
            }
        });
    });

    // GSAP Animations
    gsap.from('.hero h1', { duration: 1, y: -50, opacity: 0 });
    gsap.from('.hero p', { duration: 1, y: 50, opacity: 0, delay: 0.5 });
    gsap.from('.cta-btn', { duration: 1, scale: 0, delay: 1 });
    gsap.from('.hero-images img', { duration: 1, x: -100, opacity: 0, stagger: 0.3 });

    gsap.utils.toArray('.feature-item').forEach(function(item) {
        gsap.from(item, {
            duration: 1, 
            y: 100, 
            opacity: 0, 
            scrollTrigger: {
                trigger: item,
                start: 'top 80%',
                end: 'bottom 20%',
                scrub: true,
            }
        });
    });

    // Example: Load additional content with AJAX
    document.querySelector('.load-more-btn').addEventListener('click', function() {
        fetch('load_more.php')
            .then(response => response.text())
            .then(data => {
                document.querySelector('.content').innerHTML += data;
            });
    });
});
