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

//============form switch
const formLogin = document.querySelector('.form_login')
const formSignup = document.querySelector('.form_sign_up')
const signInBtn = document.querySelector('#signInBtn');
const signUpBtn = document.querySelector('#signUpBtn');

signUpBtn.addEventListener('click',function(){
    formSignup.classList.remove('form_not_active')
    formLogin.classList.add('form_not_active')

    signInBtn.classList.remove('active')
    signUpBtn.classList.add('active')
})
signInBtn.addEventListener('click',function(){
    formSignup.classList.add('form_not_active')
    formLogin.classList.remove('form_not_active')

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




//===============Detect if the user input script
const form = document.querySelectorAll(".form_sign_up input")

const signUpBtn_form = document.querySelector("button[name='signupBtn']")

const detectScript = function(){
    let allText = form[0].value+form[1].value+form[2].value+form[3].value

    allText.includes('script') ? signUpBtn_form.disabled = true :  signUpBtn_form.disabled = false
}

form.forEach((input)=>{
    input.addEventListener('keyup',function(){
        
        if(this.value.includes('script')){
            this.classList.add('script_alert')
        }else{
            this.classList.remove('script_alert')
        }

        detectScript()
    })
})



