/*-----------------------------------------------------------------------------------*/
/* GENERAL SCRIPTS */
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){

	// Table alt row styling
	jQuery( '.entry table tr:odd' ).addClass( 'alt-table-row' );
	
	// FitVids - Responsive Videos
	jQuery( ".post, .widget" ).fitVids();
	
	// Superfish for nav dropdowns
	jQuery( 'ul.nav').superfish({
		delay: 200,
		animation: {opacity:'show', height:'show'},
		speed: 'fast',
		dropShadows: false
	});
	
	// Responsive Navigation (switch top drop down for select)
	jQuery('ul#top-nav').mobileMenu({
		switchWidth: 767,                   //width (in px to switch at)
		topOptionText: 'Select a page',     //first option text
		indentString: '&nbsp;&nbsp;&nbsp;'  //string for indenting nested items
	});

	// Responsive Navigation (switch top drop down for select)
	jQuery('#sidebar-portfolio ul').mobileMenu({
		switchWidth: 767,                   //width (in px to switch at)
		topOptionText: 'Select Project',     //first option text
		indentString: '&nbsp;&nbsp;&nbsp;'  //string for indenting nested items
	});
	
});

jQuery(window).load(function(){

	/*-----------------------------------------------------------------------------------*/
	/* FitVids*/
	/*-----------------------------------------------------------------------------------*/
	
	// Target your .container, .wrapper, .post, etc.
	jQuery("#slides").fitVids();

});
	
/*-----------------------------------------------------------------------------------*/
/* clearText() - Clear Comment Form */
/*-----------------------------------------------------------------------------------*/

function clearText( field ) {

    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;

}