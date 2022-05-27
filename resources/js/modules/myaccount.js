class MyAccount{ 

    containerDesktop = null;
    containerMobile = null;

    constructor(){
        
    }
    init(){
        this.containerDesktop = document.querySelector('.my-account-desktop');
        this.containerMobile = document.querySelector('.my-account-mobile');
        
        this.fillDesktopFromCache();
        this.fillMobileFromCache();

        this.fillFromApi();
    }
    replaceElement(element, html){ 
        element.insertAdjacentHTML('afterend', html);
        let sibling = element.nextElementSibling;
        element.remove();
        return sibling;
    }
    setDesktopHtml(html){ 
        if(this.containerDesktop){
            this.containerDesktop = this.replaceElement(this.containerDesktop, html);
            this.containerDesktop.querySelectorAll('.my-account-dropdown') .forEach(e => {
                e.addEventListener('click', function(){  
                    let next = this.nextElementSibling;
                    if(next){
                        next.classList.remove('hidden'); 
                        setTimeout(function(){
                            document.addEventListener('click', function(e){ 
                                if(!next.contains(e.target)){
                                    next.classList.add('hidden');
                                } 
                            },{once : true});
                        }, 1);
                    }
                }); 
            }); 
        }
    }
    setMobileHtml(html){
        if(this.containerMobile){
            this.containerMobile.innerHTML = html;
        }
    }
    fillDesktopFromCache(){ 
        let cache = localStorage.getItem('my-account-desktop');
        if(cache){
            this.setDesktopHtml(cache);
        } 
    }
    fillMobileFromCache(){
        let cache = localStorage.getItem('my-account-mobile');
        if(cache){
            this.setMobileHtml(cache);
        } 
    }
    fillFromApi(){
        fetch('/my-account/html', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            credentials: "same-origin"
        })
        .then(response => response.json())
        .then(data => {
            this.setDesktopHtml(data.desktop);
            this.setMobileHtml(data.mobile);
            localStorage.setItem('my-account-desktop', data.desktop);
            localStorage.setItem('my-account-mobile', data.mobile);
        })
    }
}

export default MyAccount;