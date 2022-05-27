import Fileman from './modules/fileman';
import Textman from './modules/textman';
import Blockman from './modules/blockman';
import MyAccount from './modules/myaccount';

import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"

import slugify from 'slugify'
import Tagify from '@yaireo/tagify'

document.querySelectorAll(".textman").forEach(textarea => { 
    new Textman(textarea); 
})

 
document.querySelectorAll(".fileman").forEach(div => { 
    new Fileman(div);
})
 
document.querySelectorAll(".blockman").forEach(div => { 
    new Blockman(div);
})

 
 
document.querySelectorAll(".toast").forEach(div => {  
    let type = div.getAttribute("data-type");
    let message = div.getAttribute("data-message");
    let style = {
        background: "#16a34a",
        color : '#fff',
    }
    if(type == "error"){
        style.background = "#d9534f";
    }
    if(type == "warning"){
        style.background = "#fbbf24";
        style.color = "#000";
    } 
    if(type == "info"){
        style.background = "#3b82f6"; 
    } 
    Toastify({
        text: message,
        duration: 3000,   
        gravity: "top", 
        position: "right", 
        stopOnFocus: true, 
        style: style, 
    }).showToast();
})


document.querySelectorAll(".selecting").forEach(div => {   
    const label = div.children[0]; 
    const value_input = label.nextElementSibling; 
    const select_element = value_input.nextElementSibling;
    const list_element  = select_element.nextElementSibling;
    const list_search_input = list_element.querySelector('input')
    const list_search_input_clearer = list_search_input.nextElementSibling; 
    const options = []

    list_element.classList.add("hidden"); 
    list_element.setAttribute("style", "");

    select_element.addEventListener("click", function(){
        list_element.classList.toggle("hidden");  
        list_search_input.focus();
    })
    document.addEventListener('click', function(e){  
        if(!div.contains(e.target)  ){
            list_element.classList.add('hidden');
        } 
    });

    list_search_input_clearer.addEventListener('click', function(){
        list_search_input.value = "";
        list_search_input.dispatchEvent(new Event('input'));
    })
    list_search_input.addEventListener('input', function(){
        const search_value = slugify(list_search_input.value.toLowerCase(),'');
        if(search_value.length > 0){
            list_search_input_clearer.classList.remove('hidden');
        }else{
            list_search_input_clearer.classList.add('hidden');
        } 

        options.forEach(option => { 
            if(option.string.includes(search_value)){
                option.element.classList.remove('hidden');
            }else{
                option.element.classList.add('hidden');
            }
        })
    })

    const setSelectValue = (value) => {
        value_input.value = value; 
        const option = list_element.querySelector(`[data-value="${value}"]`);
        if(!option){
            return;
        }
        const new_option = option.cloneNode( true );
        select_element.children[0].children[0].innerHTML = new_option.innerHTML;
    }

    const option_container = list_element.children[0].nextElementSibling; 
    for(let i = 0; i < option_container.children.length; i++){ 
        const option = option_container.children[i];
        options.push({
            element : option, 
            string : slugify(option.innerText.toLowerCase(),''),
        })
        option.addEventListener('click', function(){  
            setSelectValue(option.children[0].getAttribute('data-value'));
            list_element.classList.add('hidden');
        })
    }


    setSelectValue(value_input.value);
})


document.querySelectorAll(".input-tags").forEach(div => {
    const input = div.querySelector('input');
    const tagify = new Tagify(input,{ 
    });
})


const myaccount = new MyAccount();
myaccount.init();