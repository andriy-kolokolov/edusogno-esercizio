const formSubmit = document.getElementById('form-submit');
const btnSubmit = document.getElementById('btn-submit');

// can use if more than 1 form in page
const formSubmit1 = document.getElementById('form-submit-1');
const btnSubmit1 = document.getElementById('btn-submit-1');

formSubmit.addEventListener('submit', function (event) {
    event.preventDefault();

    btnSubmit.setAttribute('disabled', 'true');

    const loadingSpinner = document.createElement('i');
    loadingSpinner.className = 'mr-1 fa-solid fa-spinner fa-spin';

    btnSubmit.insertBefore(loadingSpinner, btnSubmit.querySelector('span'));
    btnSubmit.querySelector('span').textContent = 'Loading...';

    this.submit();
});

if (formSubmit1) {
    formSubmit1.addEventListener('submit', function (event) {
        event.preventDefault();

        btnSubmit1.setAttribute('disabled', 'true');

        const loadingSpinner = document.createElement('i');
        loadingSpinner.className = 'mr-1 fa-solid fa-spinner fa-spin';

        btnSubmit1.insertBefore(loadingSpinner, btnSubmit1.querySelector('span'));
        btnSubmit1.querySelector('span').textContent = 'Loading...';

        this.submit();
    });
}
