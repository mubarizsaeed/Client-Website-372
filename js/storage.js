document.addEventListener('DOMContentLoaded', function() {
    const usernameHeader = document.getElementById('username-header');
    const loginLink = document.getElementById('loginLink');
    const signOutButton = document.getElementById('signOutButton');

    // Check if a mode preference is stored in local storage
    const storedMode = localStorage.getItem('mode');
    if (storedMode) {
        document.body.classList.add(storedMode);
    }

    // Check if a user is logged in
    const loggedInUser = localStorage.getItem('loggedInUser');
    if (loggedInUser) {
        usernameHeader.textContent = loggedInUser;
        loginLink.style.display = 'none';
        signOutButton.style.display = 'inline-block';
    } else {
        usernameHeader.style.display = 'none';
        signOutButton.style.display = 'none';
    }

    signOutButton.addEventListener('click', function() {
        localStorage.removeItem('loggedInUser');
        usernameHeader.textContent = '';
        usernameHeader.style.display = 'none';
        loginLink.style.display = 'inline-block';
        signOutButton.style.display = 'none';
    });


});