const hamburger = document.getElementById('hamburger');
const navList = document.getElementById('nav__list');

hamburger.addEventListener('click', () => {
    navList.classList.toggle('show');
});