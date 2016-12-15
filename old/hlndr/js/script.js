/*
		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,?????????????????$,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,????????????????$,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,??????????????$,,,,,,
		?????????????????????,,,,,,,,,,,,,,,,,,,?????????????$,,,,,,
		???????????????????,,,,,,,,??,,,,,I,,,,,,:???????????$,,,,,,
		?????????????????,,,,,,,,????,,,,,I?,,,,,,,??????????$,,,,,,
		???????????????,,,,,,,,??????,,,,,I???,,,,,,?????????$,,,,,,
		?????????????,,,,,,,,????????,,,,,I????,,,,,,,???????$,,,,,,
		???????????,,,,,,,,??????????,,,,,I?????,,,,,,,??????$,,,,,,
		?????????,,,,,,,,,???????????,,,,,I???????,,,,,,?????$,,,,,,
		????????,,,,,,,,?????????????,,,,,I????????,,,,,,,???$,,,,,,
		??????,,,,,,,,???????????????,,,,,I?????????,,,,,,,??$,,,,,,
		????,,,,,,,,?????????????????,,,,,I???????????,,,,,,,$,,,,,,
		??,,,,,,,,???????????????????,,,,,I????????????,,,,,,,,,,,,,
		,,,,,,,,I????????????????????,,,,,I?????????????,,,,,,,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,I???????????????,,,,,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,I????????????????,,,,,,,,,
		,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,I??????????????????,,,,,,,
		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/



// sweet array with all the descriptions (for major lolz)
var newText = ['is dynamic text', 
			   'is still dynamic text', 
			   'is like a red, red rose', 
			   'is like \"whoa\"', 
			   'is like a virus, resiliant and highly contagious',
			   'is like a Japanese game show',
			   'is like calling bald a hair colour',
			   'is like a museum',
			   'is like the wind',
			   'is like the best medicine',
			   'is like sunshine',
			   'feels like he\'s taking crazy pills',
			   'is a centre for ants',
			   'is like a B-movie',
			   'is like a rolling stone',
			   'is like a puzzle',
			   'is kind of a big deal',
			   'is like a bird',
			   'aims to misbehave',
			   'is like a combination of Fergie and Jesus',
			   'is your father',
			   '= !theFather',
			   'is like deja vu all over again',
			   'is like the Pythagorean Theorum',
			   'is like seeing your oxen turned into bouillon cubes',
			   'is like a fine wine',
			   'is like a foot without a big toe',
			   'is like dating a stairmaster',
			   'is like the inside of a coffin on a moonless night',
			   'is like a mystery adventure',
			   'is not a tumor',
			   'is on first',
			   'can dodge a wrench',
			   'is just a freak...like me',
			   'is Iron Man',
			   'is like teaching a horse to dance',
			   'is like a herd of pigs',
			   'is feeling lucky',
			   'chose not to destroy his Companion Cube',
			   'knows the cake is a lie',
			   'is smarter than the average bear',
			   'is not your mother\'s meatloaf']

// instantiate array index
var i = randomNum(0);

// looping through the array
$(document).ready(function (){

	// start the list of descriptions
	setInterval(function (){
		$('span.dynamic').fadeOut( 400, function () {
			$('span.dynamic').html( newText[i] ).append(".");
			$('span.dynamic').fadeIn();
		});
		i = randomNum(i);
	}, 5000);

	// pre-cache the animated gif in case anyone clicks on it
	if (document.images) {
    	var creeper = new Image();
    	creeper.src = "images/creeper-asplode.gif";
	}

	if ( $(document).width() >= 1025 ) {
			$('p.inline_nav').hide();
		}

	window.onresize = function() {
		if ( $(document).width() >= 1025 ) {
			$('p.inline_nav').hide();
		}
		else { $('p.inline_nav').show();}
	}

 });
// picking the index RANDOMLY
function randomNum( oldNum ) {
	var i = Math.floor(Math.random() * 39);

	// check the new value with the old value
	if ( i === oldNum || i >= newText.length + 1 ) {
		// use some good ol' fashion
		// recursion if the numbers
		// were the same
		randomNum(i);
	}
	return i;
};

// animated scrollationizing
$('.scrollPage').click(function() {
	var topGap = 10;
	if ( $(document).width() >= 1025 ) {
		var topGap = 100;
	}

   var elementClicked = $(this).attr("href");
   var destination = $(elementClicked).offset().top;
   $("body:not(:animated),html:not(:animated)").animate({ scrollTop: destination-topGap}, 800 );
   return false;
});

// fancy box stuff
$("a.fancy").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});


// form submission using jQuery
var customData = null;

$('form').submit(function() {
	$('form').attr(action="ajaxform.php");
	// serialize the form data array
	customData = $(this).serializeArray();
  	// send the form to PHP via $_GET
		$.get('../working/ajaxform.php', customData, function(data) {
						// make the errors hidden
						$('#name_error').html(data[0]).hide();
		  				$('#email_error').html(data[1]).hide();
		  				$('#message_error').html(data[2]).hide();
		  				$('#awesomessage').html(data[3]).hide();
		  				$('#success').html(data[4]).hide();
						// put the values into their places
						// from the PHP file
		  				$('#name_error').html(data[0]).fadeIn(500);
		  				$('#email_error').html(data[1]).fadeIn(500);
		  				$('#message_error').html(data[2]).fadeIn(500);
		  				$('#awesomessage').html(data[3]).fadeIn(500);
		  				$('#success').html(data[4]).fadeIn(500);
		  				
		}, 'json');
  	return false;
});






