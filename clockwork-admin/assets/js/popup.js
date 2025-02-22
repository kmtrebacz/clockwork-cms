const links = document.querySelectorAll('.popup-link');
const popups = document.querySelectorAll('.popup');
const closeButtons = document.querySelectorAll('.close-popup');

function openPopup(popupId) {
     const popup = document.getElementById(popupId);
     popup.style.display = 'block';
     document.body.classList.add('popup-active');
}

function closePopup() {
     popups.forEach(popup => popup.style.display = 'none');
     document.body.classList.remove('popup-active');
}

document.addEventListener('DOMContentLoaded', function() {
    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const popupId = this.getAttribute('data-popup');
            openPopup(popupId);
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            closePopup();
        });
    });
});

