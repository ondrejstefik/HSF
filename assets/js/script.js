document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const navList = document.getElementById('navList');

    if (menuToggle && navList) {
        menuToggle.addEventListener('click', function () {
            navList.classList.toggle('show');
        });
    }

    const stainInputs = document.querySelectorAll('input[name="moridlo"]');
    const selectedMoridlo = document.getElementById('selectedMoridlo');

    if (stainInputs.length > 0 && selectedMoridlo) {
        stainInputs.forEach(input => {
            input.addEventListener('change', function () {
                selectedMoridlo.textContent = this.value;
            });
        });
    }
});