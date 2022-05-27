import Fileman from './modules/fileman';
import Textman from './modules/textman';
import Blockman from './modules/blockman'; 
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"

document.querySelectorAll(".textman").forEach(textarea => { 
    new Textman(textarea); 
}) 
document.querySelectorAll(".fileman").forEach(div => { 
    new Fileman(div);
}) 
document.querySelectorAll(".blockman").forEach(div => { 
    new Blockman(div);
}) 

/** Toasts */
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