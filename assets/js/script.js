//password check js
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('passwordField');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });


    $('#myTab a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
    
