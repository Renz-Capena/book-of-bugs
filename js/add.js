const dateOutput = document.querySelector("input[name='date']")
const timeOutput = document.querySelector("input[name='time']")

const date = new Date

const months = ['January','February','March','April','May','June','July','Agust','September','October','November','December']

//=====Month
let month = months[date.getMonth()]
let day = date.getDate()
let year = date.getFullYear()

//=====Time
let dayTime = date.getHours() >= 12 ? "PM" : "AM";
let hrs = date.getHours() <= 12 ? date.getHours() : date.getHours() - 12;
let min = date.getMinutes() < 10 ? `0${date.getMinutes()}` : date.getMinutes();


dateOutput.value = `${month} ${day}, ${year}`;
timeOutput.value = `${hrs}:${min} ${dayTime}`;


const textarea = document.querySelector('#textarea');
const submitBtn = document.querySelector("button[name='submit']")

textarea.addEventListener('keyup',function(){
    let word = textarea.value + ""

    if(word.includes('<script') || word.includes('alert(')){
        textarea.classList.add('script_alert')
        alert("Please wag kang bobo wag mo lagyan ng script")
        submitBtn.disabled = true
    }else{
        submitBtn.disabled = false
        textarea.classList.remove('script_alert')
    }
})
