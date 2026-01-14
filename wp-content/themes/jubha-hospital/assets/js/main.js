var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 0, 
  centeredSlides: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
});

window.addEventListener('scroll', function() {
    const header = document.querySelector('.site-header');
    
    if (window.scrollY > 50) {
        header.classList.add('header-scrolled');
    } else {
        header.classList.remove('header-scrolled');
    }
});

function initSlider(containerSelector, cardsAtOnce = 3) {
    const container = document.querySelector(containerSelector);
    if (!container) return;

    const wrapper = container.querySelector('.slider-wrapper');
    const cards = container.querySelectorAll('.slider-card');
    
    const section = container.closest('section');
    const nextBtn = section.querySelector('.slide-next');
    const prevBtn = section.querySelector('.slide-prev');

    let index = 0;
    const gap = 20;

    function layout() {
        let visibleCards = window.innerWidth < 768 ? 1 : (window.innerWidth < 1024 ? 2 : cardsAtOnce);
        
        const containerWidth = container.offsetWidth;
        const cardWidth = (containerWidth - (visibleCards - 1) * gap) / visibleCards;

        cards.forEach(card => {
            card.style.width = `${cardWidth}px`;
            card.style.marginRight = `${gap}px`;
        });

        wrapper.style.transform = `translateX(${-index * (cardWidth + gap)}px)`;
    }

    nextBtn.addEventListener('click', () => {
        let visibleCards = window.innerWidth < 768 ? 1 : (window.innerWidth < 1024 ? 2 : cardsAtOnce);
        if (index < cards.length - visibleCards) {
            index++;
        } else {
            index = 0;
        }
        layout();
    });

    prevBtn.addEventListener('click', () => {
        if (index > 0) {
            index--;
        }
        layout();
    });

    window.addEventListener('resize', layout);
    layout();
}

initSlider('.media-container', 3);
initSlider('.branch-container', 3);