import $ from 'jquery'
import TweenMax from 'gsap/TweenMax'
// import TimelineLite from 'gsap/TimelineLite'
// import 'gsap/CSSPlugin' // only needed if using TweenLite
// import 'gsap/EasePack'
import ScrollMagic from 'scrollmagic/scrollmagic/uncompressed/ScrollMagic'
import ScrollToPlugin from 'gsap/ScrollToPlugin'


  });

}

export default {
  init() {

    var $hero = $('.homepage-hero'),
        $panels = $('.homepage-hero__panels > div'),
        $problem = $('.homepage-hero__problem'),
        $solution = $('.homepage-hero__solution'),
        $features = $hero.find('.problem-feature, .solution-feature'),
        $problemFeatures = $hero.find('.problem-feature'),
        $solutionFeatures = $hero.find('.solution-feature'),
        timeline = new TimelineMax();

    timeline
      .from(
        $panels,
        0.5,
        {
          scale: 0.5, autoAlpha: 0
        })
      .staggerFromTo(
        $problemFeatures,
        1,
        {
          scale: .5,
          y: '-=40px',
          autoAlpha: 0
        },
        {
          scale: 1,
          y: 0,
          autoAlpha: 1,
          ease:Back.easeOut
        },
        0.25)
      .add('swapStart')
      .to($problem, 1.5, {scale: 0.5, left: '-5%', ease: Circ.easeOut}, 'swapStart')
      .to($solution, 1.5, {scale: 0.5, right: '-5%', ease: Circ.easeOut}, 'swapStart')
      .add('swapMid')
      .set($problem, {zIndex: 0})
      .set($solution, {zIndex: 10})
      .to($problem, 1.5, {scale: 0.7, left: '0%', ease: Circ.easeIn}, 'swapMid')
      .to($solution, 1.5, {scale: 0.9, right: '0%', ease: Circ.easeIn}, 'swapMid')
      .staggerFromTo(
        $solutionFeatures,
        1,
        {
          scale: .5,
          y: '-=40px',
          autoAlpha: 0
        },
        {
          scale: 1,
          y: 0,
          autoAlpha: 1,
          ease:Back.easeOut
        },
        0.25);

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


  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
