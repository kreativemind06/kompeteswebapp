var carousel = document.querySelector('.container');
var wrapper = document.querySelector('.itemsNext');
var items = document.querySelectorAll('.itm');
var nextArrow = document.querySelector('.nex');
var previousArrow = document.querySelector('.previou');
var currentSlide = 0;

// switch slides and set active
var switchSlides = function switchSlides(next) {
    var isNext = next > currentSlide;
    currentSlide = Math.max(0, Math.min(items.length - 1, next));
    nextArrow.dataset.disabled = currentSlide >= items.length - 1;
    previousArrow.dataset.disabled = currentSlide <= 0;
    items.forEach(function (item, i) {
        item.dataset.current = i === currentSlide;
        item.dataset.direction = isNext ? 'next' : 'previous';
    });
    wrapper.style.transform = 'translate3d(-' + currentSlide * window.innerWidth + 'px, 0, 0)';
};

// window resize listener
window.addEventListener('resize', function () {
    wrapper.style.transform = 'translate3d(-' + currentSlide * window.innerWidth + 'px, 0, 0)';
});

// next arrow click listener
nextArrow.addEventListener('click', function (e) {
    e.preventDefault();
    switchSlides(currentSlide + 1);
});

// previous arrow click listener
previousArrow.addEventListener('click', function (e) {
    e.preventDefault();
    switchSlides(currentSlide - 1);
});