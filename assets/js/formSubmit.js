const formSubmit = document.getElementById('form-submit');
const btnSubmit = document.getElementById('btn-submit');


formSubmit.addEventListener('submit', function (event) {
    event.preventDefault();

    btnSubmit.setAttribute('disabled', 'true');

    const loadingSpinner = document.createElement('i');
    loadingSpinner.className = 'fa-solid fa-spinner fa-spin';

    btnSubmit.insertBefore(loadingSpinner, btnSubmit.querySelector('span'));
    btnSubmit.querySelector('span').textContent = 'Loading...';

    this.submit();
});

