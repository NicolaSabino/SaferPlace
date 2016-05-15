(function ($){
  $(function(){

    //abilito la sidenav collassabile
    $('.button-collapse').sideNav();

    //abilito l'effetto parallasse
    $('.parallax').parallax();

    //abilito le liste collasabili
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

	
    //abilita i select
    $('select').material_select();

    //abilita modali
    $('.modal-trigger').leanModal();


  }); // end of document ready
})(jQuery); // end of jQuery name space
