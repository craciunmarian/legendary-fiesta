const hamburger = document.getElementById('hamburger');
const navList = document.getElementById('nav__list');
const body = document.getElementById('body');
const whiteIcon = document.getElementById('hamburger__icon__white');
const icon = document.getElementById('hamburger__icon');

const container = document.getElementById('nav__container');

hamburger.addEventListener('click', () => {
    navList.classList.toggle('show');
    body.classList.toggle('hide');
    whiteIcon.classList.toggle('reveal');
    icon.classList.toggle('swap');
    container.classList.toggle('idk');
});

navList.addEventListener('click', () => {
    navList.classList.toggle('show');
    body.classList.toggle('hide');
    whiteIcon.classList.toggle('reveal');
    icon.classList.toggle('swap');
    container.classList.toggle('idk');
});