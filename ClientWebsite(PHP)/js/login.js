document.addEventListener('DOMContentLoaded', function() {
    let isLoginMode = true;

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

    // Light/Dark Mode Toggle
    const toggleModeButton = document.getElementById('toggleModeButton');
    toggleModeButton.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        const mode = document.body.classList.contains('dark-mode') ? 'dark-mode' : 'light-mode';
        document.cookie = `mode=${mode}; path=/`;
    });
});