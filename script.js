//Menu mobile

let btnMobile = document.querySelector('#btnMenu');
let naveg = document.querySelector('#menu');

btnMobile.addEventListener('click',abrirMenu);

function abrirMenu(){   

 naveg.classList.toggle('active'); 
}

document.querySelectorAll('.menu-link').forEach(link => {
  link.addEventListener('click', () => {
    menu.classList.remove('active'); // aqui você fecha o menu manualmente
  });
});



//Anima texto
document.addEventListener("DOMContentLoaded", () => {
   const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
    if (entry.isIntersecting) {
       entry.target.classList.add('animate');
    }
    });
}, {
    threshold: 0.3
});


const titulo = document.querySelector('.titulo-site');
    if (titulo) observer.observe(titulo);
});





//Carrossel marcas
 // JavaScript com autoplay
 
const imageCarouselTrack = document.querySelector('.carousel-track');
const imageNextButton = document.getElementById('nextBtn');
const imagePrevButton = document.getElementById('prevBtn');

let imageCarouselPosition = 0;
const imageSlideWidth = 180; // largura da imagem + margem
const imageTotalSlides = imageCarouselTrack.children.length;
const imageVisibleSlides = Math.floor(imageCarouselTrack.parentElement.offsetWidth / imageSlideWidth);

// Função para atualizar a posição
function updateImageCarouselPosition() {
  const maxPosition = -imageSlideWidth * (imageTotalSlides - imageVisibleSlides);
  if (imageCarouselPosition <= maxPosition) {
    imageCarouselPosition = 0; // reinicia no começo
  } else {
    imageCarouselPosition -= imageSlideWidth;
  }
  imageCarouselTrack.style.transform = `translateX(${imageCarouselPosition}px)`;
}

// Autoplay a cada 3 segundos
const imageAutoplay = setInterval(updateImageCarouselPosition, 3000);

// Botões ainda funcionam
imageNextButton.addEventListener('click', () => {
  clearInterval(imageAutoplay); // opcional: pausa ao interagir
  updateImageCarouselPosition();
});

imagePrevButton.addEventListener('click', () => {
  clearInterval(imageAutoplay);
  imageCarouselPosition += imageSlideWidth;
  imageCarouselTrack.style.transform = `translateX(${imageCarouselPosition}px)`;
});



//Depoimentos
const track = document.querySelector('.testimonial-track');
const nextBtn = document.getElementById('nextTest');
const prevBtn = document.getElementById('prevTest');
const testimonials = document.querySelectorAll('.testimonial');

let currentIndex = 0;
const slideWidth = testimonials[0].offsetWidth + 20; // largura + margem (ajustar se necessário)

function updateSlide() {
  track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

nextBtn.addEventListener('click', () => {
  if (currentIndex < testimonials.length - 1) {
    currentIndex++;
    updateSlide();
  }
});

prevBtn.addEventListener('click', () => {
  if (currentIndex > 0) {
    currentIndex--;
    updateSlide();
  }
});  


 //Troca de status do carro

window.onload = function() { 
  
// Mapa de status manual
let carrosVendidos = {
  carro1: false,    //primeira imagem
  carro2: true,    //segunda imagem 
  carro3: false,  //terceira imagem
  carro4: false,  //quarta imagem
  carro5: false,  //quinta imagem
  carro6: false,  //sexta imagem
  carro7: false,  //setima imagem
  carro8: true,   //oitava imagem
  carro9: true,   //nona imagem
  
  
}; // false são os disponiveis e true os vendidos

let botoes = document.getElementsByClassName('botaoStatus');

for (let i = 0; i < botoes.length; i++) {
  botoes[i].addEventListener('click', function () {
    let card = this.closest('.car-card');
    let statusElemento = card.querySelector('.status');
    let idCarro = card.getAttribute('data-id');
    let botaoVerMais = card.querySelector('.botao-vermais');
if (botaoVerMais) {
  botaoVerMais.style.visibility = 'hidden';
}

    if (!statusElemento || !idCarro) return;

    if (carrosVendidos[idCarro]) {
  statusElemento.innerText = 'Vendido';      
  let imagem = card.querySelector('img');
  if (imagem) imagem.remove();      

      
  } else {
      statusElemento.innerText = 'Disponível';
      // Agora o botão 'ver-mais' só aparece se o carro estiver disponível
  let botaoVerMais = card.querySelector('.botao-vermais');
  if (botaoVerMais) {
    botaoVerMais.style.visibility = 'visible';
  }

    }
  });
}
 
};

