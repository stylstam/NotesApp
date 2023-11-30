function changeContent() {

    // ADD FUNCTION TO SAVE AND RETAIN BUTTON STATE

    var svgContainer = document.getElementById('svg-container');
    var svgImage = document.getElementById('svg-image');
    var svgText = document.getElementById('svg-text');
    var navaElements = document.querySelectorAll('.nava');

    if (svgImage.src.endsWith('img/sun.svg')) {
        svgImage.src = 'img/moon.svg';
        svgText.textContent = 'Dark Mode';
        document.documentElement.classList.add('light');
        navaElements.forEach(function(element) {
            element.classList.add('light');
        });



    } else {
        svgImage.src = 'img/sun.svg';
        svgText.textContent = 'Light Mode';
        document.documentElement.classList.remove('light');
        navaElements.forEach(function(element) {
            element.classList.remove('light');
        });

    }


    function changeAttributes() {
        var paragraph = document.getElementById('my-paragraph');

        paragraph.style.backgroundColor = '#e74c3c';
    }

}