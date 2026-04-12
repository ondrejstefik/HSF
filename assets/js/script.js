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

document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openMoridlaModal');
    const closeBtn = document.getElementById('closeMoridlaModal');
    const modal = document.getElementById('moridlaModal');

    if (openBtn && closeBtn && modal) {
        openBtn.addEventListener('click', function () {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeBtn.addEventListener('click', function () {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
});