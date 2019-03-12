// Theme by default loads a jQuery as dependency of the main script.
// Let's include it using ES6 modules import.
import $ from 'jquery'
import TweenLite from 'gsap/TweenLite'
import ScrollMagic from 'scrollmagic/scrollmagic/uncompressed/ScrollMagic'
import ScrollToPlugin from 'gsap/ScrollToPlugin'

// init controller
var controller = new ScrollMagic.Controller();
var pageHeight = $('#page').height();
$(window).on('resize', function() {
  pageHeight = $('#page').height();
});
new ScrollMagic.Scene({
  triggerElement: '#page',
  duration: pageHeight})
  .addTo(controller)
  .on("update", function (e) {
    console.log(e.target.controller().info("scrollDirection"));
  })
  .on("enter leave", function (e) {
    console.log(e.type == "enter" ? "inside" : "outside");
  })
  .on("start end", function (e) {
    console.log(e.type == "start" ? "top" : "bottom");
  })
  .on("progress", function (e) {
    console.log(e.progress)
  });

console.log('hey');

// import external dependencies
// import 'slick-carousel';

// Import everything from autoload
// import "./autoload/**/*"

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import faq from './routes/faq';
// Import aboutUs from './routes/about';
// import single from './routes/single';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  // aboutUs,
  // single,
  faq,
});

// Load Events
$(document).ready(() => routes.loadEvents());
