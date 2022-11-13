//==============burgerMenu
const burgerMenu = document.querySelector('#burgerMenu');

const nav_btns = document.querySelector('.nav_btns')
const closeNavBtn = document.querySelector('#close_nav')

const layer = document.querySelector('.layer_black')


const closeNav = function(){
    closeNavBtn.style.transform = 'rotate(360deg)'
    setTimeout(function(){
        closeNavBtn.style.transform = 'rotate(0deg)';
    },1500)
    setTimeout(function(){
        nav_btns.style.left = '-200px'
    },500)
    layer.style.display = 'none'
}

layer.addEventListener('click',closeNav)
closeNavBtn.addEventListener('click',closeNav)

burgerMenu.addEventListener('click',function(){
    burgerMenu.style.transform = 'rotate(360deg)';

    setTimeout(function(){
        burgerMenu.style.transform = 'rotate(0deg)';
    },500)

    nav_btns.style.left = '0px'
    layer.style.display = 'block'
})

const form_wrapper_info = document.querySelector('.form_wrapper_info div');
const signInBtn = document.querySelector('#signInBtn');
const signUpBtn = document.querySelector('#signUpBtn');

signUpBtn.addEventListener('click',function(){
    form_wrapper_info.classList.add('signin_signup_move')
    signInBtn.classList.remove('active')
    signUpBtn.classList.add('active')
})
signInBtn.addEventListener('click',function(){
    form_wrapper_info.classList.remove('signin_signup_move')
    signUpBtn.classList.remove('active')
    signInBtn.classList.add('active')
})

//==============form popup

const formContainer = document.querySelector('.form_wrapper');
const signInNav = document.querySelector('#signIn_Nav');

const closeForm = document.querySelector('#close_form_btn')

signInNav.addEventListener('click',function(){
    formContainer.style.transform = 'scale(1)'
    closeNav()
})

closeForm.addEventListener('click',function(){
    formContainer.style.transform = 'scale(0)'
})

// const formLogin = document.querySelector('#form_login')

// formLogin.addEventListener('submit',function(e){
//     e.preventDefault();
//     console.log(e.target.email.value)
//     console.log(e.target.password.value)
// })

