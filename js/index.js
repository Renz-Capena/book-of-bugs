const formWrapper = document.querySelector('.form_wrapper_info div');

const signInBtn = document.querySelector('#signInBtn');
const signUpBtn = document.querySelector('#signUpBtn');

signUpBtn.addEventListener('click',function(){
    formWrapper.classList.add('signin_signup_move')
})
signInBtn.addEventListener('click',function(){
    formWrapper.classList.remove('signin_signup_move')
})

