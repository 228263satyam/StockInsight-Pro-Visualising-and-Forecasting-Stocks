document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-btn');
    const closeBtn = document.getElementById('close-btn');
    const sections = document.querySelectorAll('section');
    const homeBtn = document.querySelector('.home-btn');

    // Toggle sidebar open/close
    toggleBtn.addEventListener('click', () => {
        sidebar.style.width = '250px';
        document.body.classList.add('sidebar-open');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.style.width = '0';
        document.body.classList.remove('sidebar-open');
    });

    // Debounced Scroll-triggered animation
    let scrollTimeout;
    const isElementInViewport = (el) => {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
        );
    };

    const addScrollAnimations = () => {
        sections.forEach((section) => {
            if (isElementInViewport(section)) {
                section.classList.add('visible');
            }
        });
    };

    const debounceScroll = () => {
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        scrollTimeout = setTimeout(addScrollAnimations, 100);
    };

    // Run animation on scroll
    window.addEventListener('scroll', debounceScroll);
    addScrollAnimations();

    // Smooth scroll for the home button
    homeBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
