window.$ = window.jQuery = require("jquery");

require('./../../../semantic/dist/semantic.js');

// import './../../../semantic/dist/semantic.css';

$(function(){
  init_semantic();
})

function init_semantic()
{
  $('.ui.dropdown')
    .dropdown()
  ;

  $('.ui.checkbox')
    .checkbox();

}