window.$ = window.jQuery = require("jquery");

require('./../../../semantic/dist/semantic.js');

// import './../../../semantic/dist/semantic.css';

$(function(){
  init_semantic();
  init_event();
})

function init_event()
{
  $('.clicksubmit').click(function(){
    $(this).submit();
  });
}

function init_semantic()
{
  $('.ui.dropdown')
    .dropdown()
  ;

  $('.ui.checkbox')
    .checkbox();

  $('.modalcaller').click( function() {

    // get the right modal init
    var modalclass = '.ui.modal';
    if ($(this).data('modalId')) {
      modalclass = modalclass + '.' + $(this).data('modalId');
    }
    
    // init
    $(modalclass).modal('show');
    
    // put in text data
    var modaldatatexts = $(this).data('modalText');
    for (var key in modaldatatexts) {
      var datafield = '.data.text.' + key;
      $(modalclass + ' ' + datafield).text(modaldatatexts[key]);
    }

    // put in value data
    var modaldatavals = $(this).data('modalVal');
    for (var key in modaldatavals) {
      var datafield = '.data.val.' + key;
      $(modalclass + ' ' + datafield).val(modaldatavals[key]);
    }
  });
}