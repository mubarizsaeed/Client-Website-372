document.addEventListener('DOMContentLoaded', function() {
    let isLoginMode = true;
    const usernameHeader = document.getElementById('username-header');
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
        document.getElementById('authForm').style.display = 'none';
        signOutButton.style.display = 'inline';
    }

    document.getElementById('runScriptButton').addEventListener('click', function() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var resultDiv = document.getElementById('result');

        // Check username policy
        if (username.length < 3 || username.length > 20) {
            resultDiv.textContent = 'Username must be between 3 and 20 characters long.';
            resultDiv.style.color = 'red';
            return;
        }

        // Check password policy
        if (password.length < 6) {
            resultDiv.textContent = 'Password must be at least 6 characters long.';
            resultDiv.style.color = 'red';
            return;
        }

        if(isLoginMode) {
            var storedUsername = localStorage.getItem('username');
            var storedPassword = localStorage.getItem('password');

            if(username === storedUsername && password === storedPassword) {
                resultDiv.textContent = 'Welcome back, ' + username;
                resultDiv.style.color = 'green';
                localStorage.setItem('loggedInUser', username);
                usernameHeader.textContent = username;
                document.getElementById('authForm').style.display = 'none';
                signOutButton.style.display = 'inline';
            } else {
                resultDiv.textContent = 'Incorrect username or password.';
                resultDiv.style.color = 'red';
            }
        } else {
            localStorage.setItem('username', username);
            localStorage.setItem('password', password);
            resultDiv.textContent = 'Signup successful. You can now log in.';
            resultDiv.style.color = 'green';
        }
    });

    document.getElementById('toggleAuthMode').addEventListener('click', function() {
        isLoginMode = !isLoginMode;
        if (isLoginMode) {
            document.getElementById('runScriptButton').textContent = 'Login';
            document.getElementById('toggleAuthMode').textContent = 'Switch to Sign Up';
        } else {
            document.getElementById('runScriptButton').textContent = 'Sign Up';
            document.getElementById('toggleAuthMode').textContent = 'Switch to Login';
        }
    });

    signOutButton.addEventListener('click', function() {
        localStorage.removeItem('loggedInUser');
        usernameHeader.textContent = '';
        document.getElementById('authForm').style.display = 'block';
        signOutButton.style.display = 'none';
    });

    // Light/Dark Mode Toggle
    const toggleModeButton = document.getElementById('toggleModeButton');
    toggleModeButton.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('mode', document.body.classList.contains('dark-mode') ? 'dark-mode' : 'light-mode');
    });

    // Smooth login experience when pressing Enter
    document.getElementById('authForm').addEventListener('submit', function(event) {
        event.preventDefault();
        document.getElementById('runScriptButton').click();
    });
});