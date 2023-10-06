function handleFormSubmit(form, button, buttonText) {
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        button.setAttribute('disabled', 'true');

        const loadingSpinner = document.createElement('i');
        loadingSpinner.className = 'mr-1 fa-solid fa-spinner fa-spin';

        button.insertBefore(loadingSpinner, button.querySelector('span'));
        button.querySelector('span').textContent = buttonText;

        this.submit();
    });
}


const forms = document.querySelectorAll('.form-submit');
const buttons = document.querySelectorAll('.btn-submit');

forms.forEach((form, index) => {
    const button = buttons[index];
    const buttonText = 'Loading..';
    handleFormSubmit(form, button, buttonText);
});