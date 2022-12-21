const dateOutput = document.querySelector('#date');
const timeOutput = document.querySelector('#time');

const months = ['January','February','March','April','May','June','July','Agust','September','October','November','December']

const date = new Date

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



//----file upload show toggle
const fileUploadWrapper = document.querySelector('.file_upload_wrapper div');
const fileUploadBtn = document.querySelector('.file_upload_wrapper img');

fileUploadBtn.addEventListener('click',function(){
    fileUploadWrapper.classList.toggle('file_show');
})

