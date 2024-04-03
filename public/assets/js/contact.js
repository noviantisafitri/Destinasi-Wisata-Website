const contactForm = document.getElementById('contactForm');

function saveToHistory(firstName, lastName, emailAddress, message) {
    let history = JSON.parse(localStorage.getItem('contactHistory')) || [];
    history.push({ firstName, lastName, emailAddress, message });
    localStorage.setItem('contactHistory', JSON.stringify(history));
}

window.addEventListener('DOMContentLoaded', function () {
    const storedHistory = JSON.parse(localStorage.getItem('contactHistory'));
    if (storedHistory) {
        storedHistory.forEach(item => {
            console.log(`First Name: ${item.firstName}, Last Name: ${item.lastName}, Email: ${item.emailAddress}, Message: ${item.message}`);
        });
    }
});

contactForm.addEventListener('submit', function (event) {
    event.preventDefault();
    const firstName = document.getElementById('first-name').value;
    const lastName = document.getElementById('last-name').value;
    const emailAddress = document.getElementById('emailAddress').value;
    const message = document.getElementById('message').value;

    saveToHistory(firstName, lastName, emailAddress, message);

    document.getElementById('first-name').value = '';
    document.getElementById('last-name').value = '';
    document.getElementById('emailAddress').value = '';
    document.getElementById('message').value = '';

    localStorage.setItem('contactFirstName', firstName);
    localStorage.setItem('contactLastName', lastName);
    localStorage.setItem('contactEmailAddress', emailAddress);
    localStorage.setItem('contactMessage', message);
    
    alert('Thank you for contacting us!');
});
