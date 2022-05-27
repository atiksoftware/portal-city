// Default SortableJS
import Sortable from 'sortablejs';


class Fileman {

    html_label = `<div><span class="text-gray-500 text-sm font-semibold"></span></div>`;
    html_wrapper = `<div class="flex flex-wrap"></div>`;
    html_file = `
    <div class="draggable flex relative m-1 border-2 border-slate-600 h-32 justify-center items-center text-slate-400 hover:text-slate-700 cursor-pointer   transition-all">
        <img class="h-full" src="">
        <div class="absolute left-0 top-0 right-0 bottom-0 bg-white bg-opacity-90 transition-all opacity-0 hover:opacity-100">
            <div class="w-full h-full flex justify-center items-center">
                <svg class="w-12 h-12   mx-auto text-emerald-500" viewBox="0 0 24 24"> 
                    <path fill="currentColor" d="M22.67,12L18.18,16.5L15.67,14L17.65,12L15.67,10.04L18.18,7.53L22.67,12M12,1.33L16.47,5.82L13.96,8.33L12,6.35L10,8.33L7.5,5.82L12,1.33M12,22.67L7.53,18.18L10.04,15.67L12,17.65L14,15.67L16.5,18.18L12,22.67M1.33,12L5.82,7.5L8.33,10L6.35,12L8.33,13.96L5.82,16.47L1.33,12M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10Z" />
                </svg>
            </div>
            <div tag-remover class="right-1 top-1 absolute hover:scale-125 transition-all">
                <svg class="w-7 h-7   mx-auto text-red-500" viewBox="0 0 24 24">  
                    <path fill="currentColor" d="M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19M8.46,11.88L9.87,10.47L12,12.59L14.12,10.47L15.53,11.88L13.41,14L15.53,16.12L14.12,17.53L12,15.41L9.88,17.53L8.47,16.12L10.59,14L8.46,11.88M15.5,4L14.5,3H9.5L8.5,4H5V6H19V4H15.5Z" />
                </svg>
            </div> 
        </div>
        <input type="hidden">
    </div>
    `; 
    html_progress = `
    <div tag-uploading class="flex m-1 border-2 border-slate-400 w-32 h-32 justify-center items-center text-slate-400  transition-all">
        <div class="animate-pulse"> 
            <div>
                <svg class="animate-spin h-10 w-10 mx-auto " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div class="text-xs select-none mt-2">Yükleniyor</div>
        </div>
    </div>
    `; 
    html_trigger = `
    <div class="m-1 border-2 border-slate-500 w-32 h-32 flex justify-center items-center text-slate-400 hover:text-black cursor-pointer hover:border-slate-700 transition-all hover:bg-slate-200">
        <div> 
            <div>
                <svg class="w-12 h-12   mx-auto" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M14,2L20,8V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V4A2,2 0 0,1 6,2H14M18,20V9H13V4H6V20H18M12,12L16,16H13.5V19H10.5V16H8L12,12Z" />
                </svg>
            </div>
            <div class="text-xs select-none text-center">Yeni Fotoğraf Ekle</div>
            <div class="text-xs select-none text-center remaining">Max 4</div>
        </div>
    </div>
    `;

    dom_container = null;
    dom_label = null;
    dom_wrapper = null;
    dom_file = null;
    dom_progress = null;
    dom_trigger = null;

    options = {
        name : '',
        label : '',
        limit : 1,
        mime : 'image/*', 
        files : [],
    };

    
    file_count = 0;
    queue_count = 0;

  

    
    htmlToDOM = (html)  => {   
        var parser = new DOMParser();
        var doc = parser.parseFromString(html, 'text/html'); 
        return doc.body.firstElementChild;
    };
    constructor(container, options) {
        this.dom_container = container; 

        // if options exist
        if(options) {
            // override default options
            this.options = {...this.options, ...options};
        }
        else{
            // read options from data attributes
            this.options.name = this.dom_container.getAttribute('data-name');
            this.options.label = this.dom_container.getAttribute('data-label');
            this.options.limit = parseInt(this.dom_container.getAttribute('data-limit') || 1);
            this.options.mime = this.dom_container.getAttribute('data-mime'); 
            this.options.files = JSON.parse(this.dom_container.getAttribute('data-files') || '[]'); 
        }
  
        this.dom_label = this.htmlToDOM(this.html_label);
        this.dom_wrapper = this.htmlToDOM(this.html_wrapper);
        this.dom_file = this.htmlToDOM(this.html_file);
        this.dom_progress = this.htmlToDOM(this.html_progress);
        this.dom_trigger = this.htmlToDOM(this.html_trigger);
 
        this.dom_container.appendChild(this.dom_label); 
        this.dom_label.querySelector('span').innerText = this.options.label; 

        this.dom_container.appendChild(this.dom_wrapper);  

        this.dom_wrapper.appendChild(this.dom_trigger);
        this.dom_trigger.addEventListener("click", () => {
            this.openFileDialog();
        })

        Sortable.create(this.dom_wrapper, {
            draggable: ".draggable"
        }); 

        this.options.files.forEach(file => {
            this.addFile(file);
        })
        this.syncTriggerDisplay(); 
    }

    addFile(file){
        const dom_file = this.dom_file.cloneNode(true);

        dom_file.querySelector("img").src = file.link;
        dom_file.querySelector("div[tag-remover]").addEventListener("click", () => {
            this.removeFile(dom_file)
        })
        dom_file.querySelector("input").value = file.id;
        dom_file.querySelector("input").name = this.options.name + "[]";
   

        let draggables = this.dom_wrapper.querySelectorAll(".draggable");
        let lastDraggable = null;
        if (draggables.length > 0) {
            lastDraggable = draggables[draggables.length - 1];
        }
        if (lastDraggable !== null) {
            lastDraggable.parentNode.insertBefore(dom_file, lastDraggable.nextSibling);
        } else {
            this.dom_wrapper.insertBefore(dom_file, this.dom_wrapper.firstChild);
        }
 
        this.file_count++;
        this.syncTriggerDisplay(); 
    }
    removeFile(dom_file) { 
        dom_file.style.transform = "scale(0.7)";
        dom_file.style.opacity = "0";
        dom_file.style.pointerEvents = "none";
        setTimeout(() => {
            dom_file.remove();
            this.file_count--;
            this.syncTriggerDisplay();
        }, 300);
    }

   

    getRemainingFile() {
        return this.options.limit - (this.file_count + this.queue_count);
    }

    syncTriggerDisplay() {
        if (this.getRemainingFile() <= 0) {
            this.dom_trigger.classList.add("hidden");
        } else {
            this.dom_trigger.classList.remove("hidden");
        }
        const dom_remaining = this.dom_trigger.querySelector(".remaining");
        if(this.options.limit == 1){
            dom_remaining.classList.add("hidden");
        }
        else{
            dom_remaining.classList.remove("hidden");
            dom_remaining.innerText = 'Max ' + this.getRemainingFile();
        }
    }


    openFileDialog() {
        const input = document.createElement("input");
        input.type = "file";
        input.multiple = true;
        input.accept = "image/*";
        input.addEventListener("change", (e) => {
            console.log(e.target.files);
            for (let i = 0; i < e.target.files.length; i++) {
                console.log(this.getRemainingFile());
                if (this.getRemainingFile() <= 0) {
                    break;
                }
                this.uploadFile(e.target.files[i]);
            }
        });
        input.click();
    }

    uploadFile(file) {
        const dom_progress = this.dom_progress.cloneNode(true);
 
        this.dom_trigger.parentNode.insertBefore(dom_progress, this.dom_trigger);

     
        this.queue_count++;

        this.syncTriggerDisplay();

        // upload file
        const formData = new FormData();
        formData.append("file", file);
 
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/api/file/upload");
        xhr.onload = () => {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);  
                    this.addFile(response) 
                } catch (error) {
                    
                } 
            } 
            this.queue_count--;
            dom_progress.remove();
            this.syncTriggerDisplay(); 
        };
        xhr.onerror = () => {
            this.queue_count--;
            dom_progress.remove();
        };
        xhr.send(formData);
    } 
}

export default Fileman;


