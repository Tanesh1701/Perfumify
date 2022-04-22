var arrlang = {
  "english": {
    "fragrances": "fragrances",
    "about": "about",
    "contact us": "contact us",
    "hello": "hello",
    "The fantasy of": "The fantasy of",
    "Paradise": "paradise",
    "Energetic aromatic irresistible":"Energetic aromatic irresistible",
    "fragrance for all the ways you play":"fragrance for all the ways you play",
    "Shop Now":"Shop Now"
  },

  "french": {
    "fragrances": "Parfums",
    "about": "à propos",
    "contact us": "contact",
    "hello": "bonjour",
    "The fantasy of": "la fantaisie du",
    "Paradise": "paradis",
    "Energetic aromatic irresistible": "Énergique aromatique irrésistible",
    "fragrance for all the ways you play": "parfum pour toutes vos plaisirs",
    "Shop Now": "Achetez"
  }
}

const items = document.querySelectorAll('.accordion button');

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');

  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }

  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach((item) => item.addEventListener('click', toggleAccordion));


function initMap() {
  var locations = [
    ['London, UK', 51.51064632678645, -0.12940690216828235, 3],
    ['46th Avenue, New York', 40.745968, -73.951792, 2],
    ['Bagatelle Mall, Mauritius', -20.225071889861383, 57.496324626023515, 1]
  ];

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 2,
    center: new google.maps.LatLng(-20.225071889861383, 57.496324626023515),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var infowindow = new google.maps.InfoWindow();

  var marker, i;

  for (i = 0; i < locations.length; i++) {  
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));
  }
}



function toggleLikeIcon(icon) {
  if(icon.innerHTML == "favorite_border") {
    icon.innerHTML = "favorite";
  } else {
    icon.innerHTML = "favorite_border";
  }
  document.onselectstart = function() { return false; };
  return false;
}



function showPanel() {
  $('#sizesIcon').on('click', function() {
    // if($('.panel').css('right')=='0px'){
    //     $('.panel').animate({right: '-100%'}, 500);
    //     // document.getElementById('panelID').style.boxShadow = ''; 
    //     document.getElementById('panelID').style.display = 'none';  
    // }else{
    //     $('.panel').animate({right:0}, 500); 
    //     // document.getElementById('panelID').style.boxShadow = '0 0 0 100vmax rgba(0,0,0,.3)';
    //     document.getElementById('panelID').style.display = 'block';    
    // }
    
    $('.panel').animate({right:0}, 500); 
    document.getElementById('panelID').style.display = 'block';    
  });
}

showPanel();

function closePanelF() {
   $('#closePanelIcon').on('click', function() {
      $('.panel').animate({right: '-100%'}, 500); 
       document.getElementById('panelID').style.display = 'none';
   });
   $('.closePanelHolder').on('click', function() {
    $('.panel').animate({right: '-100%'}, 500); 
     document.getElementById('panelID').style.display = 'none';
 });
}
closePanelF();


function selectSize() {
  var optionSize100 = document.getElementsByClassName('size100')[0];
  var optionSize200 = document.getElementsByClassName('size200')[0];
  var optionSize100Selected = document.getElementById('selectedSize100');
  var optionSize200Selected = document.getElementById('selectedSize200');


  if(optionSize100) {
    optionSize100.addEventListener('click', function() {
      document.getElementsByClassName('productSize')[0].innerHTML = '100ml';
      $('.panel').animate({right: '-100%'}, 500);
      optionSize200Selected.style.display = 'none'; 
      optionSize100Selected.style.display = 'block';
      document.getElementById('panelID').style.display = 'none';
    });
  }

  if(optionSize200) {
    optionSize200.addEventListener('click', function() {
      document.getElementsByClassName('productSize')[0].innerHTML = '200ml';
      $('.panel').animate({right: '-100%'}, 500);
      optionSize100Selected.style.display = 'none';
      optionSize200Selected.style.display = 'block'; 
      document.getElementById('panelID').style.display = 'none';
    }); 
  }
}

selectSize();


function changeQuantity() {
  var increment = document.querySelectorAll('span.input-number-increment');
  var decrement = document.querySelectorAll('span.input-number-decrement');
  var input = document.querySelectorAll('input.input-number');
  var unitPrice = document.querySelectorAll('td.unitPrice');
  var subtotal = document.querySelectorAll('td.sub-total');

  increment.forEach(function(add, i) {
    add.addEventListener('click', function() {
      input[i].value = parseInt(input[i].value) + 1;
      console.log(unitPrice[i].innerHTML);
      subtotal[i].innerHTML = 'Rs ' + input[i].value * parseInt(unitPrice[i].innerHTML.split(' ')[1]);
      if (input[i].value > 5) {
        input[i].value = 5;
        subtotal[i].innerHTML = 'Rs ' + unitPrice[i].innerHTML.split(' ')[1] * 5;
      }
    })
  })

  decrement.forEach(function(substract, i) {
    substract.addEventListener('click', function() {
      input[i].value = parseInt(input[i].value) - 1;
      subtotal[i].innerHTML = 'Rs ' + parseInt(subtotal[i].innerHTML.split(' ')[1] - unitPrice[i].innerHTML.split(' ')[1]);
      if (input[i].value < 1) {
        input[i].value = 1;
        subtotal[i].innerHTML = unitPrice[i].innerHTML;
      }
    })
  })
}

changeQuantity();

function openPage(pageName,elmnt) {
  var i, tabcontent;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  
  for (const li of document.querySelectorAll("li.active")) {
    li.classList.remove("active");
  }
  elmnt.classList.add("active");
  document.getElementsByClassName('userDetails')[0].style.display = 'none';
  document.getElementById(pageName).style.display = "block";
}


function randomQuote() {

  fetch("../json/quotes.json").then(response => response.json()).then(data => {
    var random = Math.floor(Math.random() * (data.length + 1));
    if( document.getElementById('dashboardQuote')) {
      document.getElementById('dashboardQuote').innerHTML = data[random].quote;
      document.getElementById('dashboardQuoter').innerHTML = '~ ' + data[random].author;
    } 
  });
}

randomQuote();


$(function() {
  $('.translate').click(function() {
    var lang = $(this).attr('id');
    fetch("../json/localization.json").then(response => response.json()).then(data => {
      $('.lang').each(function(index, element) {
          $(this).text(data[lang][$(this).attr('key')]);
      })
    });
  }); 
});

function countries() {
  var select = document.getElementById("selectCountry");
  fetch("../json/countries.json").then(response => response.json()).then(data => {
    for(var i = 0; i < data.length; i++) {
      var option = document.createElement("option"); 
      var txt = document.createTextNode(data[i]); 
      option.appendChild(txt); 
      option.setAttribute("value",data[i]);
      if(select) {
        select.insertBefore(option,select.lastChild);
      } 
    }
  })
}

countries();


const alternatives = [
  "Sorry I couldn't quite catch that, can you repeat the question please?",
  "My apologies, can you rephrase your question?",
  "Sorry but I don't understand your question.",
  "Sorry! Let me connect you to a human!",
  "Have you checked the faq page yet about your query?"
]

function query() {
document.addEventListener("DOMContentLoaded", () => {
  const inputField = document.getElementById("inputMessage");
  inputField.addEventListener("keydown", (e) => {
    if (e.code === "Enter") {
      let input = inputField.value;
      inputField.value = "";
      process(input);
    }
  });
});
}

query();


function process(input) {
  let found;
  let reply;
  let text = input.replace(/[^\w\s]/gi, "").replace(/[\d]/gi, "").trim();
  text = text
  .replace(/ a /g, " ")
  .replace(/i feel /g, "")
  .replace(/whats/g, "what is")
  .replace(/please /g, "")
  .replace(/ please/g, "")
  .replace(/r u/g, "are you");
  text = text.charAt(0).toUpperCase() + text.substring(1);

  fetch('../json/Axia.json').then(response => response.json()).then(data => {
      for(var i = 0; i<data.length; i++) {
          if(text === data[i]['question']) {
              found = true;
              reply = data[i]['answer'];
              //console.log(reply);
              output(input, reply);
              break;
          } else {
              found = false;
          }
      }
      if (found === false) {
          var random = Math.floor(Math.random() * alternatives.length)
          output(text, alternatives[random]);
      }
  })
}

function output(question, answer) {
const messagesContainer = document.getElementById("messages");
const synth = window.speechSynthesis;
var axiaVolume = 2;

const textToSpeech = (string) => {
  let voice = new SpeechSynthesisUtterance(string);
  var voices = speechSynthesis.getVoices();
  voice.text = string;
  voice.lang = "en-US";
  voice.voice = voices[5];
  voice.volume = axiaVolume;
  voice.rate = 1;
  voice.pitch = 2; 
  synth.speak(voice);
}

let userDiv = document.createElement("div");
userDiv.id = "user";
userDiv.className = "user-response";
userDiv.innerHTML = `<p>${question}</p>`;
messagesContainer.appendChild(userDiv);

let botDiv = document.createElement("div");
let botText = document.createElement("span");
let botImg = document.createElement("img");

botDiv.id = "bot";
botImg.src = "../axia.jpg";
botImg.className = "botImage";

botDiv.className = "bot response";
botText.className = "axiaImg";
botText.innerText = "Typing...";
botDiv.appendChild(botImg);
botDiv.appendChild(botText);
messagesContainer.appendChild(botDiv);
// Keep messages at most recent
messagesContainer.scrollTop = messagesContainer.scrollHeight - messagesContainer.clientHeight;

// Fake delay to seem "real"
setTimeout(() => {
  botText.innerText = `${answer}`;
  textToSpeech(answer);
}, 2000
)
}
