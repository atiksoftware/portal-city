
import Fileman from './fileman';
import Textman from './textman';

class Blockman{
 
    dom_wrapper = null;
    dom_grid = null;

    constructor(dom_wrapper){ 
        

        const dom_grid = document.createElement("div");
        this.dom_grid = dom_grid;
        dom_wrapper.appendChild(dom_grid);
        dom_grid.className = "grid grid-cols-1 divide-y divide-dashed"; 

        const dom_button_container = document.createElement("div");
        dom_wrapper.appendChild(dom_button_container);
        dom_button_container.className = "flex space-x-2 justify-center mt-4";

        const button_class_name = 'inline-block px-6 py-3 bg-slate-600 text-white font-medium text-xs  rounded shadow-md hover:bg-slate-700 hover:shadow-lg focus:bg-slate-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-slate-800 active:shadow-lg transition duration-150 ease-in-out';

        const textblock_button = document.createElement("button");
        dom_button_container.appendChild(textblock_button);
        textblock_button.className = button_class_name;
        textblock_button.innerHTML = 'Metin Alanı Ekle';
        textblock_button.setAttribute("type", "button");
        textblock_button.addEventListener("click", () => {
            this.addTextBlock();
        })

        const galleryblock_button = document.createElement("button");
        dom_button_container.appendChild(galleryblock_button);
        galleryblock_button.className = button_class_name;
        galleryblock_button.innerHTML = 'Fotoğraf Alanı Ekle';
        galleryblock_button.setAttribute("type", "button"); 
        galleryblock_button.addEventListener("click", () => {
            this.addGalleryBlock();
        })

        const blocks = JSON.parse(dom_wrapper.getAttribute("data-blocks") || '[]');
        for(let i=0; i<blocks.length; i++){
            const block = blocks[i];
            if(block.type_id == 1){
                this.addTextBlock(block.content);
            }else if(block.type_id == 2){
                this.addGalleryBlock(block.images);
            }
        }
    }

    addTextBlock(content){ 
        const id = this.getNextId();
        const dom_block = document.createElement("div");
        dom_block.setAttribute("data-id", id);
        dom_block.classList.add("py-4")
        this.addDynamicBlockHeader(dom_block,'Metin Alanı', 'Birşeyler yazın')
        this.dom_grid.appendChild(dom_block);
        const dom_textarea = document.createElement("textarea");
        dom_block.appendChild(dom_textarea);
        dom_textarea.classList.add("hidden");  
        dom_textarea.setAttribute("name", 'blocks['+id+'][content]');
        dom_textarea.value = content || '';

        const dom_input = document.createElement("input");
        dom_block.appendChild(dom_input); 
        dom_input.setAttribute("name", 'blocks['+id+'][type_id]');
        dom_input.setAttribute("value", 1);
        dom_input.setAttribute("type", 'hidden');
        

        new Textman(dom_textarea); 
    }

    addGalleryBlock(files){ 
        const id = this.getNextId();
        const dom_block = document.createElement("div");
        dom_block.setAttribute("data-id", id);
        dom_block.classList.add("py-4")
        this.addDynamicBlockHeader(dom_block,'Fotoğraf Alanı', '10 fotoğraf ekleyebilirsiniz')
        this.dom_grid.appendChild(dom_block);

        const dom_input = document.createElement("input");
        dom_block.appendChild(dom_input);
        dom_input.setAttribute("name", 'blocks['+id+'][type_id]');
        dom_input.setAttribute("value", 2);
        dom_input.setAttribute("type", 'hidden');

        new Fileman(dom_block,{
            name : 'blocks['+id+'][images]',
            limit: 10,
            files : files || [],
        });
    } 
    addDynamicBlockHeader(dom_block, label, description){
        const html = `<div class="flex">
            <div class="flex-1"><span class="font-semibold text-sm text-rose-500">`+label+`</span><span class="text-slate-400 text-xs ml-2">`+description+`</span></div>
            <div class="font-semibold text-sm text-red-500 cursor-pointer">Bloğu Sil</div>
        </div>`
        dom_block.innerHTML = html;
        dom_block.querySelector("div>div>div:last-child").addEventListener("click", () => {
            dom_block.remove();
        })
    }
    getNextId(){ 
        const dom_blocks = this.dom_grid.querySelectorAll("div[data-id]");
        let id = 0;
        for(let i=0; i<dom_blocks.length; i++){
            const dom_block = dom_blocks[i];
            const block_id = parseInt(dom_block.getAttribute("data-id"));
            if(block_id > id){
                id = block_id;
            }
        }
        return id+1;
    }
}

export default Blockman;