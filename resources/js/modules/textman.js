import BalloonEditor from '@ckeditor/ckeditor5-build-balloon';

class Textman{
    constructor(dom_textarea){
        // get dom_textarea placeholder if exist
        let placeholder = dom_textarea.getAttribute("placeholder");
        if(placeholder == null){
            placeholder = "Buraya bir metin yazınız...";
        }
        const div = document.createElement("div"); 
        dom_textarea.parentNode.insertBefore(div, dom_textarea.nextSibling); 
        BalloonEditor
            .create(div, {
                placeholder: placeholder
            })
            .then(editor => {
                editor.setData( dom_textarea.value ); 
                editor.model.document.on('change:data', () => {
                    dom_textarea.value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });
    }
}

export default Textman;