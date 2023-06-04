// variables
const burger_menu = document.getElementById("hamburger")
const mobile_nav = document.getElementById("mobile-nav")
const times = document.getElementById('times')
const header = document.querySelector("header")
const fix = document.querySelector('.fix')
const prev = document.getElementById("previous")
const next = document.getElementById("next")
const slides = document.querySelectorAll('.shop-collection-card')
const sort = document.getElementById("sort")
const font = document.getElementById("font")
const sortCard = document.getElementById('sortCard')
const fontCard = document.getElementById('fontCard')
const icons = document.querySelectorAll('.fa-sort-down')
const err = document.getElementById('charcounter');
const err2 = document.getElementById('minchar');
const fontBtn = document.querySelectorAll('.font-btns')
const selected = document.getElementById('selected')
const onoff = document.querySelectorAll('.onoff')
const bordered = document.querySelectorAll('.bordered')
const useFor = document.querySelectorAll('.useFor')
const itemWidth = document.querySelectorAll('.item-width')


let errors = false;

// hamburger menu for small devices
burger_menu.addEventListener("click" , () => {
    mobile_nav.classList.add('open')
})

times.addEventListener("click" , () => {
    mobile_nav.classList.remove('open')
})

// fixed header
function fixedHeader (hero) {
  try {
    let heroo = hero.offsetTop;
    
    function fixedheader() {
      if (window.scrollY >= heroo) {    
        header.classList.add('fixed');
    } else {
      header.classList.remove('fixed');    
    }
  }
  
    window.addEventListener('scroll', fixedheader);
  } catch (error) {
    console.log(error);
  }
}

fixedHeader(fix);

// carousel
$('.owl-carousel').owlCarousel({
  loop:true,
  margin:10,
  nav:false,
  pagination: true,
  responsive:{
      0:{
          items:1
      },
      600:{
          items:3
      },
      1000:{
          items:4
      }
  }
})

// dropdown
function dropDown(btn , card , clas) {
  btn.addEventListener('click' , () => {
    card.classList.toggle(clas)
    icons.forEach(i => {
      i.classList.toggle('fa-sort-up')
    })
  })
}

try {
  dropDown(sort, sortCard ,'show-sort')
} catch (error) {
  console.log(error);
}

try {
  dropDown(font, fontCard ,'active')
} catch (error) {
  console.log(error);
}

// design functions
// text show
const text = document.getElementById('text')
const neontext = document.getElementById('neon-text')

try { 
  
  neontext.innerHTML = "Enter Text Bellow"
  
  text.addEventListener('input' , () => {
    const lines = text.value.split("\n").length
    if(lines > 2) {
      text.disabled = true;
      err.innerHTML = 'you can write up to two lines only. Refresh the page please To keep customizing'
    }
    neontext.innerHTML = text.value.replace(/\n\r?/g, '<br />')
    err.classList.add('ds-block')
  })
} catch (error) {
  console.log(error)  
}


// limite characters
const price_h = document.getElementById('price');

let price = 300

try {
  price_h.innerHTML =  "0.00 Dh" 
} catch (error) {
  console.log(error); 
}

let maxChar = 10;

let limitChar = (element) => {
  const maxcha = document.getElementById('maxchar'); 
  let ele = document.getElementById(element.id);
  let charLen = ele.value.length;
  ele.setAttribute('maxlength' , maxChar)
  maxcha.innerHTML = maxChar

  price_h.innerHTML = price + charLen * 50   + " Dh"

  if (maxChar - charLen == maxChar) {
    err.innerHTML = '1 or more characters are required for this size, please add more characters.'
    errors = true
  }
  else if (charLen == maxChar) 
  {
      ele.value = ele.value.substring(0, maxChar);
      err.innerHTML =' The maximum number of characters for this current size has been reached.'; 
  }
  else
  {
    err.innerHTML = maxChar - charLen  + ' characters remaining';
  }
}

let fontdb = 'Alexa'
fontBtn.forEach(btn => {
 
  btn.addEventListener('click', () => {
    const previous = document.getElementsByClassName("active font-btns");

    if (previous.length > 0) {
       previous[0].className = previous[0].className.replace(" active", "");
    }
  
    btn.classList.add('active')

    selected.innerHTML = btn.innerHTML

    fontdb = btn.innerHTML

    // var style = document.createElement('style');
    // style.innerHTML = `@font-face {
    //   font-family: ${btn.innerHTML};
    //   src: url('assets/fonts/${btn.innerHTML}');
    // };`;
    // document.head.appendChild(style);

    if(btn.innerHTML.includes('+')) {
      neontext.style.fontFamily = btn.innerHTML.replace('+' , ' ')
    } else {
      neontext.style.fontFamily = btn.innerHTML
    }

  })
})


onoff.forEach(onof => {
  onof.addEventListener('click', () => {
    const previous = document.getElementsByClassName("active onoff");

    if (previous.length > 0) {
       previous[0].className = previous[0].className.replace(" active", "");
    }
  
    onof.classList.add('active')

    if(onof.innerHTML == 'Off') {
      neontext.classList.add('no-shadow')
    } else {
      neontext.classList.remove('no-shadow')
    }
  })

})


let color = 'default'

bordered.forEach(border => {

  border.addEventListener('click', () => {
    const previous = document.getElementsByClassName("bordered active");


    if (previous.length > 0) {
       previous[0].className = previous[0].className.replace(" active", "");
    }
  
    border.classList.add('active')
    const colors = border.children[0].classList[1]

    var style = document.createElement('style');

    switch(colors) {
      case "red":
        style.innerHTML = `:root { --neon-shadow: red;  }`;
        color = 'red';
        document.head.appendChild(style);
        break;
      case "yellow":
        style.innerHTML = `:root { --neon-shadow: yellow;  }`;
        color = 'yellow';
        document.head.appendChild(style);
        break;
      case "blue":
        style.innerHTML = `:root { --neon-shadow: rgb(48, 143, 221);  }`;
        color = 'blue';
        document.head.appendChild(style);
        break;
      case "white":
        style.innerHTML = `:root { --neon-shadow: #ebebeb;  }`;
        color = 'white';
        document.head.appendChild(style);
        break;
      case "green":
        style.innerHTML = `:root { --neon-shadow: rgb(0, 255, 53);  }`;
        color = 'green';
        document.head.appendChild(style);
        break;
      case "orange":
        style.innerHTML = `:root { --neon-shadow: rgb(245, 166, 35);  }`;
        color = 'orange';
        document.head.appendChild(style);
        break;
      default :
        style.innerHTML = `:root { --neon-shadow: #ff3472  }`;
        document.head.appendChild(style);
        break;
    }
  })
})


// update the price
const sizes = document.querySelectorAll('.sizes');

let sizeDB = 'Small'

sizes.forEach(size => {
  size.addEventListener('click', () => {
    const previous = document.getElementsByClassName("active sizes");
    
    if (previous.length > 0) {
      previous[0].className = previous[0].className.replace(" active", "");
    }
    
    size.classList.add('active')
    
    if(size.innerHTML == 'Small') {
      maxChar = 10;
      price = 300;
      sizeDB = 'Smlll'
    } else if (size.innerHTML == 'Medium') {
      maxChar = 15
      price = 500;
      sizeDB = 'Medium'
    } else {
      maxChar = 20
      price = 600;
      sizeDB = 'Large'
    }
    
    if(text.value != '') {
      text.value = '' ;
      neontext.innerHTML = 'Enter Text Bellow';
    }

    price_h.innerHTML = price + " Dh" 
  })
  
})


// align-btn

const alignbtns = document.querySelectorAll('.align-btn')
let aligndb = 'left'

alignbtns.forEach(align => {
  align.addEventListener('click', () => {
    const previous = document.getElementsByClassName("active align-btn");
    
    if (previous.length > 0) {
      previous[0].className = previous[0].className.replace(" active", "");
    }
    
    align.classList.add('active')

    align.children[0].classList.contains('fa-align-left')
    
    if(align.children[0].classList.contains('fa-align-left')) {
      neontext.style.textAlign = 'left';
      aligndb = 'left'
    } else if (align.children[0].classList.contains('fa-align-center')) {
      neontext.style.textAlign = 'center';
      aligndb = 'center'
    } else {
      neontext.style.textAlign = 'right';
      aligndb = 'right'
    }
    
  })
  
})


// design to database
const finish = document.getElementById('finish')
const request = document.getElementById('request')
try {
  
  finish.addEventListener('click' , () => {
    if(errors != true && neontext.innerHTML != 'Enter Text Bellow') {
        // data : {neontext ,  font , align , color , size , request}
  
        async function postData(url = "", data = {}) {
          const response = await fetch(url, {
            method: "POST", 
            mode: "cors", 
            cache: "no-cache", 
            credentials: "same-origin", 
            headers: {
              "Content-Type": "application/json",
            },
            redirect: "follow", 
            referrerPolicy: "no-referrer",
            body: JSON.stringify(data), 
          });
          return response.json(); // parses JSON response into native JavaScript objects
        }
    
        postData("neon-magic-api.php", { Text: neontext.innerText , font: fontdb , align : aligndb , color : color , size : sizeDB , request : request.value , price: price_h.innerHTML }).then((data) => {
          console.log(data.data);
        });
    }
  })
} catch (error) {
    console.log(error);
}


// ****** upload page ******** // 

// active and not active
function statusChange (changableArray , classes ) {
  changableArray.forEach(item => {
    item.addEventListener('click' , () => {
      const previous = document.getElementsByClassName(classes);

      if (previous.length > 0) {
        previous[0].className = previous[0].className.replace(" active", "");
      }
    
      item.classList.add('active')

      })
  })
}

statusChange(useFor , 'useFor active')
statusChange(itemWidth , 'item-width active')

// upload functionalities
function uploadFiles () {
  try {
    const uploadForm = document.getElementById('uploadForm')
    const fileUpload = document.getElementById('fileupload') 
    let image1 = document.getElementById("fileupload").files[0];
    let image2 = document.getElementById("fileupload").files[1];
    let image3 = document.getElementById("fileupload").files[2];
    let formData = new FormData();
       
  
  
  
    uploadForm.addEventListener('submit' , (e) => {
      
  
      e.preventDefault()
  
      if (parseInt(fileUpload.files.length)>3) {
        alert("You can only upload a maximum of 3 files");
      } else {
        formData.append("image1", image1);
        formData.append("image2", image2);
        formData.append("image3", image3);
      
      
        console.log(formData.entries())
      
        fetch('Upload.php', {method: "POST", body: formData});
      }
  
    })
  } catch (error) {
    console.log(error);
  }

}

uploadFiles()


// ---------------- product page --------------- //

const imagesShow = document.querySelectorAll('.show-images img')
const image = document.getElementById('main-image')


imagesShow.forEach(img => {
  img.addEventListener('click' , () => {
    const imagesrc = img.getAttribute('src');
    image.setAttribute('src' , imagesrc) 
  })
}) 



const colors = document.querySelectorAll('.product-description .colors .color')

colors.forEach(color => {
  color.addEventListener('click' , () => {
    let classess = color.className

    classess = classess.replace('color' , '')
    const imagesrc = image.getAttribute('alt')
    image.setAttribute('src' , imagesrc + '-' + classess.trim() + '.jpg' )
  })
})

const sizes_product = document.querySelectorAll('.sizes .size-btn');

sizes_product.forEach(size => {
  size.addEventListener('click', () => {
    const previous = document.getElementsByClassName("active size-btn");
    
    if (previous.length > 0) {
      previous[0].className = previous[0].className.replace(" active", "");
    }
    
    size.classList.add('active')
  })
  
})

