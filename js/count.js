$('#fancyCountdown').fancyCountdown({
  fillColor: '#22292A', 
  year:2013, 
  month: 12, 
  day: 31, 
  hour: 0, 
  minute: 0, 
  second: 0, 
  timezone: 1
});

$('#set').click(function(){
  $.fancyCountdown.timezone($('#timezone').val());
  $.fancyCountdown.targetDate($('#year').val(), $('#month').val(), $('#day').val(), $('#hour').val(), $('#minute').val(), $('#second').val());		
});

$('#start').click(function(){
  $.fancyCountdown.start();			
});

$('#stop').click(function(){
  $.fancyCountdown.stop();			
});	
