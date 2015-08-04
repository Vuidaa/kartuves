$('.selectpicker').selectpicker();

$('.row').flexVerticalCenter();

var gameObject = null;

$('.letter').click(function(){

  $(this).fadeOut('300',function(){
    $(this).remove();
  });

  $.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

  var request = $.ajax({ url: "ajax-call", method: "POST", data: { letter : $(this).val() } });
         
  request.done(function(game){

    switch(game.state){

      case 'finished': 
        finished(game);
      break;

      case 'gameover':
        gameObject  = game;
        $('.progress-bar').width(game.mistakes * 20 + "%"); 
        gameover(game);  
      break;

      default:
        $('.progress-bar').width(game.mistakes * 20 + "%");
        running(game);
      break;
    }
  });

});

function gameover(game)
{
  game = game;
  $('.progress').remove();
  $('#blank').html('');
  $('#blank').html(game.answer);
  $('#points').remove();
  $('#category').remove();
  $(".letter").off("click");
  $('#info-box').html("<div id='status'><h4>Deja pralaimėjote!</h4><h5>Jūsų surinkti taškai - <strong>"+game.points+"</strong></h5><a class='btn btn-warning' id='rek'>PRIDĖTI Į REKORDUS</a><a class='btn btn-primary' href='game'>ŽAISTI DAR KARTĄ</a><a class='btn btn-success' href='/'>Į PRADŽIĄ</a></div>");
  $('.row').flexVerticalCenter();
}

function finished(game)
{
  $('.progress').remove();
  $('#blank').html('');
  $('#blank').html(game.blank);
  $('#points').remove();
  $('#category').remove();
  $('#info-box').html("<div id='status'><h4>Teisingas atsakymas!</h4><h5>Jūsų turimi taškai - <strong>"+game.points+"</strong></h5><a class='btn btn-primary' href='game'>TĘSTI ŽAIDIMĄ</a><a class='btn btn-success' href='/'>Į PRADŽIĄ</a></div>");
  $('.row').flexVerticalCenter();
}

function running(game)
{
  $('#blank').html(game.blank);
  $('#points').html("Taškai - "+game.points);
}

jQuery("#blank").fitText(1.3, { minFontSize: '40px', maxFontSize: '200px' });
jQuery("#main-title").fitText(0.5, { minFontSize: '90px', maxFontSize: '300px' });
jQuery("#records-title").fitText(1.2, { minFontSize: '30px', maxFontSize: '100px' });

$( document ).on( "click", "#rek", function() {

  if(gameObject.state == 'gameover'){

    var person = prompt("Jūsų vardas");

    if(person) 
    {
      $.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

      var request = $.ajax({ url: "records", method: "POST", data: { person : person, category : gameObject.category, points : gameObject.points } });

        request.done(function( response ){ setTimeout(function(){return window.location.replace("records");},500); });
    }
  }
});