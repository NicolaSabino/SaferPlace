(function($){
  $(function(){
    
    $('.button-collapse').sideNav();
    $('.parallax').parallax();
    $('.modal-trigger').leanModal();
    $(document).ready(function() {
      $('select').material_select();
    });
  }); // end of document ready
})(jQuery); // end of jQuery name space

function idstanza() {
  
var e =document.getElementById('stanza');
var numstanza=e.options[e.selectedIndex].value;

return numstanza;
}

//funzione che scrolla la pagina nel checkinb
$(function () {
  $('#selectPiano').change(function () {
    $('html,body').animate({ scrollTop: $("#" + $(this).val()).offset().top-200 }, 800);  });
});

function scrollToTop() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
}

// gestione ajax form evacuazione
  function evacuazione(){
  // popola la form se vengono passati parametri
  var piano = getPiano() ;

  if (piano!=0) {

    $('dd#piano-element').find("ul").find("li").remove();
    $('dd#piano-element').find("select").find("option").remove();
    $('dd#piano-element').find("ul."+"dropdown-content select-dropdown ").append('<li><span>Piano'+ piano +'</span></li>');
    $('dd#piano-element').find("select").append('<option value="'+ piano +'">Piano '+ piano +'</option>');
    $('select').material_select();
  }

  $("#edificio").on("change", function(){
    var actionUrl= ajaxEdificio();
    
      $.ajax({
        type : 'POST',
        url : actionUrl,
        data : $("#edificio").serialize(),
        dataType : 'json',
        success : pianiPopulate
      });


  });

  function pianiPopulate(data){
  
    $('dd#piano-element').find("ul").find("li").remove();
    $('dd#piano-element').find("select").find("option").remove();
    $.each(data, function(key, val){
  
      $('dd#piano-element').find("ul."+"dropdown-content select-dropdown ").append('<li><span>Piano'+ val +'</span></li>');
      $('dd#piano-element').find("select").append('<option value="'+ val +'">Piano '+ val +'</option>');

    });
    $('select').material_select();
  }
    
  $("#piano").on("change", function(){

  var actionUrl= ajaxPianoUrl();

  var dati = [{name: 'edificio', value: $("#edificio").val()},
              {name: 'piano', value: $("#piano").val()}];

  $.ajax({
      type : 'POST',
      url : actionUrl,
      data : $.param(dati),
      dataType : 'json',
      success : zonePopulate
  });


  })

  function zonePopulate(data){

    $('dd#zona-element').find("ul").find("li").remove();
    $('dd#zona-element').find("select").find("option").remove();
    $.each(data, function(key, val){
      $('dd#zona-element').find("ul").append('<li><span>'+ val +'</span></li>');
      $('dd#zona-element').find("select").append('<option value="'+ val +'">'+ val +'</option>');

    });
    $('select').material_select();
  }
    
}