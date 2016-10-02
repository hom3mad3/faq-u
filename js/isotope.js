jQuery(function($) {

	var $container = $('#primary'); //The ID for the list with all the blog posts
	$container.isotope({ //Isotope options, 'item' matches the class in the PHP
		itemSelector: '.item',
		layoutMode: 'masonry',
		masonry: {
			percentPosition: true
		},
		stamp: '.main-navigation',
		filter: ':not(.impressum)',
	});


	//Add the class selected to the item that is clicked, and remove from the others
	var $optionSets = $('#filters'),
		$optionLinks = $optionSets.find('a');

	$optionLinks.click(function() {
		var $this = $(this);
		// don't proceed if already selected
		if ($this.hasClass('selected')) {
			return false;
		}
		var $optionSet = $this.parents('#filters');
		$optionSets.find('.selected').removeClass('selected');
		$this.addClass('selected');

		//When an item is clicked, sort the items.
		var selector = $(this).attr('data-filter');
		$container.isotope({
			filter: selector
		});
		return false;

	});

	//toggle article content
	$('article').click(function() {

		var text = $(this).children('.entry-content');
		console.log(text);
		if (text.is(':hidden')) {
			text.slideDown('200');
			$(this).children('span').html('-');
		} else {
			text.slideUp('200');
			$(this).children('span').html('+');
		}

	});




});
