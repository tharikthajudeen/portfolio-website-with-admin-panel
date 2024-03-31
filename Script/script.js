
// Image Slider Start

var slideIndex = 0;
var images = document.getElementsByClassName("slider-image");

// Function to show the next image
function showNextImage() {
  for (var i = 0; i < images.length; i++) {
    images[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex >= images.length) {
    slideIndex = 0;
  }
  images[slideIndex].style.display = "block";
}

// Set an interval to automatically show the next image every 5 seconds
setInterval(showNextImage, 5000);

// Image Slider End

// Smooth Scrolling Start
document.addEventListener("DOMContentLoaded", function() {
  var navLinks = document.querySelectorAll("nav a");

  navLinks.forEach(function(link) {
    link.addEventListener("click", smoothScroll);
  });

  function smoothScroll(e) {
    e.preventDefault();

    var targetId = this.getAttribute("href");
    var targetPosition = document.querySelector(targetId).offsetTop;
    var startPosition = window.pageYOffset;
    var distance = targetPosition - startPosition;
    var duration = 1000; // Adjust scrolling speed here

    var startTime = null;

    function animation(currentTime) {
      if (startTime === null) startTime = currentTime;
      var timeElapsed = currentTime - startTime;
      var run = ease(timeElapsed, startPosition, distance, duration);
      window.scrollTo(0, run);
      if (timeElapsed < duration) requestAnimationFrame(animation);
    }

    // Easing function to make the scrolling smoother
    function ease(t, b, c, d) {
      t /= d / 2;
      if (t < 1) return (c / 2) * t * t + b;
      t--;
      return (-c / 2) * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animation);
  }
});
// Smooth Scrolling End

// Event Handling Start

const portfolioItem = document.querySelector('.portfolio-item');

portfolioItem.addEventListener('click', () => {
  // Open pop-up or perform other actions
});

// Event Handling End

// Custom Animations Start
const spanElement = document.querySelector('#typing-effect');

// Wait for the DOM to load
document.addEventListener('DOMContentLoaded', () => {
  animateTypingEffect();
});

function animateTypingEffect() {
  // Hide the span element initially
  spanElement.style.display = 'none';

  // Delay before starting the typing animation
  setTimeout(() => {
    spanElement.style.display = 'inline-block';
  }, 10000);
}
// Custom Animations end
