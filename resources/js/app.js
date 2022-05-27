import Swiper from 'swiper/bundle'; 
import 'swiper/css';
import 'swiper/css/effect-coverflow'; 

import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'photoswipe/style.css';

import MyAccount from './modules/myaccount';

 
/** Persons widget */
new Swiper('.widget_persons', {  
	spaceBetween: 10, 
    slidesPerView: 6, 
    direction: 'horizontal',
    loop: true, 
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },  
    breakpoints : {
        320: {
            slidesPerView: 2, 
        },
        480: {
            slidesPerView: 3, 
        }, 
        640: {
            slidesPerView: 4, 
        },
        768: {
            slidesPerView: 6, 
        }
    }
}); 
/** Menus */
document.querySelectorAll('.mobile-menu-open').forEach(e => { 
    e.addEventListener('click', function(){ 
        document.querySelectorAll('.mobile-menu').forEach(m => {
            m.classList.remove('hidden'); 
            document.body.classList.add('overflow-hidden');
        });
    });
});
document.querySelectorAll('.mobile-menu-close').forEach(e => {
    e.addEventListener('click', function(){ 
        document.querySelectorAll('.mobile-menu').forEach(m => {
            m.classList.add('hidden'); 
            document.body.classList.remove('overflow-hidden');
        });
    });
});


/** Home Page Post Slider */
document.querySelectorAll('.home_headlines').forEach(item => {
    let slider = new Swiper(item, { 
        direction: 'horizontal',
        loop: true, 
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },  
    });
    let next_sibling = item.nextElementSibling;
    let pagination_items = next_sibling.querySelectorAll('div'); 
    pagination_items.forEach(pagination_item => {
        pagination_item.addEventListener('mouseenter', function(){ 
            slider.slideTo(pagination_item.getAttribute('data-index'));
        });
    }) 

});
 
/** Cinemas Slider */
new Swiper('.widget_cinemas', {  
	spaceBetween: 10, 
    slidesPerView: 4, 
    direction: 'horizontal',
    loop: true, 
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },  
    breakpoints : {
        320: {
            slidesPerView: 2, 
        },  
        480: {
            slidesPerView: 3, 
        }, 
        768: {
            slidesPerView: 4, 
        }
    }
});
(new PhotoSwipeLightbox({
    gallery: '.widget_cinemas',
    children: 'a',
    pswpModule: () => import('photoswipe')
})).init();
/** Breaking Slider */
new Swiper('.breakings', {  
    direction: "vertical",
    loop: true,  
    autoplay: {
        delay: 2000,
    },
});

/** Adword Slider */
(new PhotoSwipeLightbox({
    gallery: '.adword_slider',
    children: 'a',
    pswpModule: () => import('photoswipe')
})).init();
new Swiper('.adword_slider', { 
	spaceBetween: 10, 
    slidesPerView: 6, 
    direction: 'horizontal',
    loop: true, 
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },  
    breakpoints : {
        320: {
            slidesPerView: 2, 
        },
        480: {
            slidesPerView: 3, 
        }, 
        640: {
            slidesPerView: 4, 
        },
        768: {
            slidesPerView: 6, 
        }
    }
});



// const swiper = new Swiper('.cover_images', { 
//     direction: 'horizontal',
//     loop: true, 
//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev',
//     },  
// });

// new Swiper('.block_images', { 
//     effect: "coverflow",
//     grabCursor: true, 
//     slidesPerView: "auto",
//     coverflowEffect: {
//       rotate: 50,
//       stretch: 0,
//       depth: 100,
//       modifier: 1,
//       slideShadows: false,
//     },
// });
// const lightbox = new PhotoSwipeLightbox({
//     gallery: '.block_images',
//     children: 'a',
//     pswpModule: () => import('photoswipe')
// });
// lightbox.init();



function imageSlider(selectorName){ 
	document.querySelectorAll(selectorName).forEach(item => { 
		const itemHeight = item.offsetHeight; 
		const images = item.querySelectorAll('img');
 
		// foreach NodeList

		for(let i = 0; i < images.length; i++){
			let image = images[i];  
			let width = parseInt(image.getAttribute('width'));
			let height = parseInt(image.getAttribute('height'));

			let new_height = itemHeight;
			let new_width = itemHeight * width / height;
		 
			image.setAttribute('height', new_height);  
			image.setAttribute('width', new_width);  
			image.parentElement.style.height = new_height + 'px';
			image.parentElement.style.width = new_width + 'px'; 
			image.parentElement.parentElement.style.height = new_height + 'px';
			image.parentElement.parentElement.style.width = new_width + 'px'; 
		} 
	})

	let swiper = new Swiper(selectorName, { 
		slidesPerView: "auto",
		spaceBetween: 10,
		grabCursor: true,
	});
	let lightbox = new PhotoSwipeLightbox({
		gallery: selectorName,
		children: 'a',
		pswpModule: () => import('photoswipe')
	})
	lightbox.init();
}

imageSlider('.images_slider');

 

const myaccount = new MyAccount();
myaccount.init();



fetch('/thread', {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
    credentials: "same-origin"
})
.then(response => response.json())
.then(data => {
    // CURRENCIES
    let currencies = document.querySelector('#currencies')
    if(currencies != null && typeof data.currencies != 'undefined'){
        data.currencies.forEach((item, index) => {
            let currency = currencies.querySelector('[data-currency="' + item.code + '"]'); 
            if(currency != null){
                let value = currency.querySelector('[data-property="value"]');
                if(value != null){
                    value.innerHTML =  Number((item.price).toFixed(2)).toLocaleString() ;
                }
                let caret_up = currency.querySelector('[data-property="caret_up"]');
                if(caret_up != null){ 
                    if(item.is_rising){ 
                        caret_up.classList.remove('hidden');
                    }else{
                        caret_up.classList.add('hidden');
                    }
                }
                let caret_down = currency.querySelector('[data-property="caret_down"]');
                if(caret_down != null){
                    if(item.is_rising){ 
                        caret_down.classList.add('hidden');
                    }else{
                        caret_down.classList.remove('hidden');
                    }
                }
            }
        })
    }

    // WEATHER
    let weather = document.querySelector('#weather')
    if(weather != null && typeof data.weather != 'undefined'){
        let degree = weather.querySelector('[data-property="degree"]');
        if(degree != null){
            degree.innerHTML = parseInt(data.weather.degree);
        }
        let description = weather.querySelector('[data-property="description"]');
        if(description != null){
            description.innerHTML = data.weather.description.toLocaleUpperCase();
        }
        let icon = weather.querySelector('[data-property="icon"]');
        if(icon != null){
            icon.src = data.weather.icon; 
            icon.alt = data.weather.description.toLocaleUpperCase();
        }
    }


    // BREAKING
    let breaking = document.querySelector('#breaking')
    if(breaking != null && typeof data.breaking != 'undefined'){
        data.breaking.forEach((item, index) => {
            breaking.querySelectorAll('div[data-swiper-slide-index="'+ index +'"]').forEach(slide => {
                let a = slide.querySelector('a');
                if(a != null){
                    a.href = item.public_link;
                    a.innerHTML = item.title; 
                    a.setAttribute('title', item.title);
                }
            })
        })
    } 




})




/** DEBUG */
if(phpdebugbar !== undefined){
    // var SeoWidget = PhpDebugBar.Widget.extend({ 
    //     tagName: 'div', 
    //     className: 'DebugSeoWidget', 
    // }); 
    // phpdebugbar.createTab("Seo", new SeoWidget()); 
    // const div = document.querySelector('.DebugSeoWidget');
    // const table = document.createElement('table');
    // const tbody = document.createElement('tbody');
    // table.appendChild(tbody);
    // div.appendChild(table);

    let list = {};
    let index = 0;

    const encode = function(str){
        return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }
 
 
    Array.from(document.body.querySelectorAll('body > *')).filter(e => e.className.indexOf('debugbar') === -1 ).forEach(m => {
        m.querySelectorAll("a").forEach(e => { 
            let id = "Link_" + (index++);
            let errors = [];

            if((e.getAttribute('href') || "").length <= 1){
                errors.push('HREF'); 
            } 

            if((e.getAttribute('title') || "").length <= 1){
                errors.push('TITLE'); 
            }  

            if(errors.length > 0){ 
                list[id + " -> " + errors.join(" , ")] =  encode(e.outerHTML);
            } 
        });
        m.querySelectorAll("img").forEach(e => { 
            let id = "Image_" + (index++);
            let errors = []; 
            if((e.getAttribute('alt') || "").length <= 1){
                errors.push('ALT'); 
            }   
            if(errors.length > 0){ 
                list[id + " -> " + errors.join(" , ")] =  encode(e.outerHTML);
            } 
        });
    }); 
    phpdebugbar.addTab("seo", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Seo", "widget": new PhpDebugBar.Widgets.KVListWidget ()}));
    phpdebugbar.addDataMap({
        "seo": [ "seo.data" , {}],
        "seo:badge": [ "seo.count" , {}]
    }); 
    const dsi = Object.keys(phpdebugbar.datasets)[0] 

    let set = phpdebugbar.datasets[dsi];
    set.seo = {
        count : Object.keys(list).length,
        data : list
    }
    phpdebugbar.setData(set)
    // phpdebugbar.showTab( "seo" );
}





