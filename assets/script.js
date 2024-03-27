/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById('nav-menu'),
    navToggle = document.getElementById('nav-toggle'),
    navClose = document.getElementById('nav-close')

    if(navToggle){
        navToggle.addEventListener('click', ()=>{
            navMenu.classList.add('show-menu');
        })
    }

    if(navClose) {
        navClose.addEventListener('click', ()=>{
            navMenu.classList.remove('show-menu');
        })
    }

/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll('.nav__link');

const linkAction = () => {
    const navMenu = document.getElementById('nav-menu');
    navMenu.classList.remove('show-menu');
}
navLink.forEach(n => n.addEventListener('click', linkAction));

/*=============== ADD BLUR TO HEADER ===============*/
const blurHeader = () =>{
    const header = document.querySelector('.header');
    this.scrollY >= 50 ? header.classList.add('blur-header')
                    : header.classList.remove('blur-header');
}
window.addEventListener('scroll', blurHeader);

/*=============== FORM EFFECT ===============*/

const inputBoxes = document.querySelectorAll('.input-box');

inputBoxes.forEach(inputBox => {
    const label = inputBox.querySelector('label');

    label.addEventListener('click', function() {
        inputBox.classList.add('clicked');
    });
});

document.addEventListener('click', function(event) {
    inputBoxes.forEach(inputBox => {
        if (!inputBox.contains(event.target)) {
            inputBox.classList.remove('clicked');
        }
    });
});

/*=============== PAY BUTTON ===============*/

const payerButton = document.querySelector("#payer");

if (payerButton) {
    payerButton.addEventListener('click', payConfirmation);
}

function payConfirmation(event) {
    var confirmation = confirm("Êtes-vous sûr de vouloir payer ?");
    if (!confirmation) {
        event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur clique sur "Annuler"
    }
}
