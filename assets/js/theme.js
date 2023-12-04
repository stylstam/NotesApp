// Set button state in session storage
function setButtonState(state) {
    sessionStorage.setItem("darkModeState", JSON.stringify(state));
}

// Get button state from session storage
function getButtonState() {
    const storedState = sessionStorage.getItem("darkModeState");
    return storedState ? JSON.parse(storedState) : false; // Default to false if no state is stored
}

// Initialize button state
let isDarkMode = getButtonState();

// Function to update the button appearance based on its state
function updateButton() {
    const svgImage = document.getElementById('svg-image');
    const svgText = document.getElementById('svg-text');

    if (isDarkMode) {
        svgImage.src = '/assets/img/moon.svg';
        svgText.textContent = 'Dark Mode';
        document.documentElement.style.setProperty('--text-color', 'var(--text-color-light)');
        document.documentElement.style.setProperty('--background-color', 'var(--background-color-light)');
        document.documentElement.style.setProperty('--primary-color', 'var(--primary-color-light)');
        document.documentElement.style.setProperty('--secondary-color', 'var(--secondary-color-light)');
        document.documentElement.style.setProperty('--extra-color', 'var(--extra-color-light)');
    } else {
        svgImage.src = '/assets/img/sun.svg';
        svgText.textContent = 'Light Mode';
        document.documentElement.style.setProperty('--text-color', 'var(--text-color-main)');
        document.documentElement.style.setProperty('--background-color', 'var(--background-color-main)');
        document.documentElement.style.setProperty('--primary-color', 'var(--primary-color-main)');
        document.documentElement.style.setProperty('--secondary-color', 'var(--secondary-color-main)');
        document.documentElement.style.setProperty('--extra-color', 'var(--extra-color-main)');
    }
}

// Attach click event to the button
document.getElementById('svg-container').addEventListener('click', function () {
    // Toggle button state
    isDarkMode = !isDarkMode;

    // Update button appearance
    updateButton();

    // Save button state in session storage
    setButtonState(isDarkMode);
});

// Initialize button appearance
updateButton();