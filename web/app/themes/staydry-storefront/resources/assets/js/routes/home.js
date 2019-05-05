import $ from 'jquery'
import TweenMax from 'gsap/TweenMax'
// import TimelineLite from 'gsap/TimelineLite'
// import 'gsap/CSSPlugin' // only needed if using TweenLite
// import 'gsap/EasePack'
import ScrollMagic from 'scrollmagic/scrollmagic/uncompressed/ScrollMagic'
import ScrollToPlugin from 'gsap/ScrollToPlugin'

function createFeatureTimeline ($features, mainTimeline) {
  var timeline = new TimelineMax({paused: true});

  timeline.add(function () {
    mainTimeline.pause();
  }).staggerFromTo(
    $features, 1,
    {scale: .5, y: '-=40px',autoAlpha: 0},
    {scale: 1, y: 0, autoAlpha: 1, ease:Back.easeOut},
    0.25
  ).add(function () {
    mainTimeline.play();
  });

  return function () {
    timeline.play();
  }
}

function createTimeline () {

}

function wirePanelClickHandlers ($problem, $solution, timeline) {
  $problem.click(function () {
    timeline.tweenTo('swapStart');
  });
  $solution.click(function () {
    timeline.tweenTo('swapEnd');
  });
}

export default {
  init() {

    var $hero = $('.homepage-hero'),
        $panels = $('.panel__problem, .panel__solution'),
        $problem = $('.panel__problem'),
        $solution = $('.panel__solution'),
        $features = $hero.find('.problem-feature, .solution-feature'),
        $problemFeatures = $hero.find('.problem-feature'),
        $solutionFeatures = $hero.find('.solution-feature'),
        timeline = new TimelineMax({paused: true});

    timeline
      .from(
        $panels,
        0.5,
        {
          scale: 0.5, autoAlpha: 0
        })
      .add(createFeatureTimeline($problemFeatures, timeline))
      .add('swapStart')
      .to($problem, 1.5, {scale: 0.5, left: '-5%', ease: Circ.easeInOut}, 'swapStart')
      .to($solution, 1.5, {scale: 0.5, right: '-5%', ease: Circ.easeInOut}, 'swapStart')
      .add('swapMid')
      .set($problem, {zIndex: 0})
      .set($solution, {zIndex: 10})
      .to($problem, 1.5, {scale: 0.7, left: '0%', ease: Circ.easeInOut}, 'swapMid')
      .to($solution, 1.5, {scale: 0.9, right: '0%', ease: Circ.easeInOut}, 'swapMid')
      .add(createFeatureTimeline($solutionFeatures, timeline))
      .add('swapEnd')
      .call(wirePanelClickHandlers, [$problem, $solution, timeline]);


    // TODO: remove in production
    var $controls = $('.animation-controls'),
        $play = $('#animation-play'),
        $pause = $('#animation-pause'),
        $resume = $('#animation-resume'),
        $reverse = $('#animation-reverse'),
        $restart = $('#animation-restart');
    $play.on('click', function(){
      timeline.play();
      $(this).hide();
      $pause.show();
    });
    $pause.hide();
    $pause.on('click', function(){
      timeline.pause();
      $(this).hide();
      $play.show();
    });
    $resume.hide()
    $resume.on('click', function(){
      timeline.resume();
    });
    $reverse.on('click', function(){
      timeline.reverse();
    });
    $restart.on('click', function(){
      timeline.restart();
    });


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
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
