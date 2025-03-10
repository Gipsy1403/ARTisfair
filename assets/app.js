// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';
import './styles/app.scss';
import '@splidejs/splide/dist/css/splide.min.css';
import Splide from '@splidejs/splide';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// Carrousel des 4 commentaires les plus récents en page d'accueil
const splide = new Splide( '.splide' );
const bar = splide.root.querySelector( '.lides_comments_progress_bar' );


// Met à jour la largeur de la barre chaque fois que le carrousel se déplace :
splide.on( 'déplacement barre', function () {
  const end = splide.Components.Controller.getEnd() + 1;
  const taux = Math.min( ( splide.index + 1 ) / end, 1 );
  bar.style.width = String( 100 * taux ) + '%';
} );

splide.mount();

// carousel des 3 images de chaque carte des pages "mon espace", "galerie"

document.addEventListener('DOMContentLoaded', function () {
	document.querySelectorAll('.splide').forEach(slider => {
	    const slides = slider.querySelectorAll('.splide__slide');
	    const hasMultipleSlides = slides.length > 1;  // Vérifie s'il y a plus d'une image

	    new Splide('#' + slider.id, {
		  type: 'loop',
		  perPage: 1,
		  arrows: hasMultipleSlides,  // Les flèches sont visibles si plusieurs images
		  pagination: hasMultipleSlides,  // Les points sont visibles si plusieurs images
	  
	    }).mount();
	});
 });

//  bouton scroll vers le haut de page

// sélection du bouton
const btnScroll=document.querySelector(".btn_scroll");
btnScroll.addEventListener("click",()=>{
// défilement de la page (top = jusqu'en haut, left = reste en position horizontal, smooth = fluidité de l'action)
      window.scrollTo({
            top:0,
            left: 0,
            behavior:"smooth",
      })
})
// lorsque l'utilisateur scroll, la fonction est détectée
window.onscroll=function(){
      toggleScrollTopButton();
};
function toggleScrollTopButton(){
	// selectionne la barre de navigation
      let navbar=document.querySelector("nav");
	//  sélectionne le bouton à nouveau
      let scrollTopButton=document.querySelector(".btn_scroll");
	//  Si la position de défilement est inférieure à la hauteur de la barre de navigation
      if(window.scrollY<navbar.offsetHeight){
		// bouton caché
            scrollTopButton.style.display="none";
      }else{
		// sinon est affiché
            scrollTopButton.style.display="block";
      }
}
 
