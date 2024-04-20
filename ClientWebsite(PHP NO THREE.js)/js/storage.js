document.addEventListener('DOMContentLoaded', function() {
    const toggleModeButton = document.getElementById('toggleModeButton');
    toggleModeButton.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
});