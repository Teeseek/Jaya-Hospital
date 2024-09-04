    // Typing effect for header text
    const firstLineElement = document.getElementById('typedTextFirstLine');
    const secondLineElement = document.getElementById('typedTextSecondLine');
    const textFirstLine = "Welcome To";
    const textSecondLine = "Jaya Hospital";
    const typingDelay = 100; // Delay between each character typing (in milliseconds)

    function typeHeaderText() {
        let i = 0;
        const typingInterval = setInterval(function() {
            if (i < textFirstLine.length) {
                firstLineElement.textContent += textFirstLine[i];
            } else {
                secondLineElement.textContent += textSecondLine[i - textFirstLine.length];
            }
            i++;
            if (i === textFirstLine.length + textSecondLine.length) {
                clearInterval(typingInterval);
            }
        }, typingDelay);
    }

    // Call the typing function when the DOM content is loaded
    typeHeaderText();
    document.addEventListener("DOMContentLoaded", function() {
        let interval = 4000;
        let valueDisplays = document.querySelectorAll(".num");
        valueDisplays.forEach((valueDisplay) => {
          let startValue = 0;
          let endValue = parseInt(valueDisplay.getAttribute("data-val"));
          let suffix = valueDisplay.getAttribute("data-suffix");
          let duration = Math.floor(interval / endValue);
          let counter = setInterval(function () {
            startValue += 1;
            valueDisplay.textContent = startValue + suffix;
            if (startValue === endValue) {
              clearInterval(counter);
            }
          }, duration);
        });
      });
      
      document.addEventListener('DOMContentLoaded', function() {
        const timelineItems = document.querySelectorAll('.timeline-item');
        const buffer = 100; // Adjust this value to set the buffer in pixels
    
        const isInViewport = el => {
            const rect = el.getBoundingClientRect();
            return (
                rect.top >= -buffer &&
                rect.left >= -buffer &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) + buffer &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth) + buffer
            );
        };
    
        const run = () => timelineItems.forEach(item => {
            if (isInViewport(item)) {
                item.classList.add('in-view');
            } else {
                item.classList.remove('in-view');
            }
        });
    
        // Events to run the animation
        window.addEventListener('load', run);
        window.addEventListener('resize', run);
        window.addEventListener('scroll', run);
    });
    
    