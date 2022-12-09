//==========================DATE AND TIME===================
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


//=================================POST BTN==================

//--Layer
const layerOne = document.querySelector('#layerOne')


//============POST BG CHANGE==============
const textarea = document.querySelector("textarea[name='post_text']");
const inputBgColor = document.querySelector("input[name='color']");

inputBgColor.addEventListener('change',function(){
    textarea.style.background = this.value;
})
//========CHECK TEXT AREA INPUT IF VALID==========
textarea.addEventListener('keyup',function(){
    if(this.value.includes('<script')){
        this.value = this.value.replaceAll('<script','<******');
    }
})

//==========POST POP UP================
const postBtn = document.querySelector('#postBtn');
const createPostWrapper = document.querySelector('#create_post_wrapper');
const formPostCloseBtn = document.querySelector('#form_post_close_btn');

const post = function(){
    layerOne.classList.toggle('layerOne_display');
    createPostWrapper.classList.toggle('show');
    textarea.style.background = 'white';
    textarea.value = null;
    inputBgColor.value = '#000000';
}

postBtn.addEventListener('click',function(){
    post();
})

formPostCloseBtn.addEventListener('click',function(){
    post();
})

//======POST MODIFY========
const modifyPostBtn = document.querySelectorAll('#modify_post_btn');
const delete_and_edit_btn_wrapper = document.querySelectorAll('.delete_and_edit_btn_wrapper');


modifyPostBtn.forEach((btn,index)=>{
    btn.addEventListener('click',function(){
        layerOne.classList.add('layerOne_display');
        delete_and_edit_btn_wrapper[index].classList.toggle('delete_edit_btn_wrpper_toggle');
    })
})

//-----------------------iframe_edit_post
const iframeEditPost = document.querySelector('.iframe_edit_post_wrapper');
const editPostBtn = document.querySelectorAll('#edit_post_btn');


editPostBtn.forEach((btn,index)=>{
    btn.addEventListener('click',function(){
        iframeEditPost.classList.add('show');
        delete_and_edit_btn_wrapper[index].classList.remove('delete_edit_btn_wrpper_toggle');
        layerOne.classList.remove('layerOne_display');
    })
})

//---------- close edit form
const closeEditPostForm = document.querySelector('#close_edit_post_form');

closeEditPostForm.addEventListener('click',function(){
    location.reload();
})

//---Layer

layerOne.addEventListener('click',function(){
    createPostWrapper.classList.remove('show');
    layerOne.classList.remove('layerOne_display');
    // iframeEditPost.classList.remove('show');

    delete_and_edit_btn_wrapper.forEach(wrapper=>{
        wrapper.classList.remove('delete_edit_btn_wrpper_toggle');
    })
})
