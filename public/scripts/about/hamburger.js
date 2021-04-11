const hamburger = document.getElementById('hamburger');
const navList = document.getElementById('nav__list');
const body = document.getElementById('body');
const closeIcon = document.getElementById('close__icon');
const icon = document.getElementById('hamburger__icon');

const container = document.getElementById('nav__container');

hamburger.addEventListener('click', () => {
    navList.classList.toggle('show');
    body.classList.toggle('hide');
    closeIcon.classList.toggle('reveal');
    icon.classList.toggle('swap');
    container.classList.toggle('open__sesame');
});

navList.addEventListener('click', () => {
    navList.classList.toggle('show');
    body.classList.toggle('hide');
    closeIcon.classList.toggle('reveal');
    icon.classList.toggle('swap');
    container.classList.toggle('open__sesame');
});