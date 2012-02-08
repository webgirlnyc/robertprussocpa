var ROBERTPRUSSO = ROBERTPRUSSO || {}

ROBERTPRUSSO = {
	'common' : {
		init : function(){
			// GLOBAL INIT
			
			$(function() {
				// Responsive Text
				$('#banner h1').fitText(1.5);
				// Navigation SubMenus
				$('#nav-main li').hover(function() {
					$(this).addClass('hovered');
				}, function() {
					$(this).removeClass('hovered');
				});
				// Contact Dropdown
				var contactLink = $('#menu-contact a');
				var contactLinkTarget = contactLink.attr('href');
				
				contactLink.hover(function() {
					$(contactLinkTarget).addClass('activated');
				}, function() {
					
					$(contactLinkTarget).removeClass('activated');
					
					$(contactLinkTarget).hover(function() {
						$(contactLink).parent().addClass('hovered');
						$(contactLinkTarget).addClass('activated');
					}, function() {
						$(contactLink).parent().removeClass('hovered');
						$(contactLinkTarget).removeClass('activated');
					});
					
				});
				contactLink.click(function(e) {
					e.preventDefault();
					$(contactLinkTarget).addClass('activated');
				});
			});
			
		},
		finalize : function(){			
			// GLOBAL FINALIZE
			$('a[href^=#]').not('a[href=#contact]').smoothmove();
		}
	},
	'page' : {
		init : function(){
			// "PAGE" BODYCLASS INIT
		},
		'home-page' : function(){
			
			// Tax Tips Twitter Feed and Slider
			$(function(){
				$('#tax-tips .flexslider').tweet({
					username: 'TipsForTaxTime',
					avatar_size: 32,
					count: 8,
					join_text: "auto",
					filter: function(t){ return ! /^@\w+/.test(t["tweet_raw_text"]); },
					loading_text: '<p class="s-loading">Loading Tips...<p>',
					template: '{text}'
				}).bind('loaded', function(){
					$(this).flexslider({
						animation: 'slide',
						prevText: "Previous Tip",
						nextText: "Next Tip"
					});
				});
			});
			
		}
	}
}

UTIL = {

	fire : function(func,funcname, args){

		var namespace = ROBERTPRUSSO;

		funcname = (funcname === undefined) ? 'init' : funcname;
		if (func !== '' && namespace[func] && typeof namespace[func][funcname] == 'function'){
			namespace[func][funcname](args);
		}

	},

	loadEvents : function(){

		var bodyId = document.body.id;

		// hit up common first.
		UTIL.fire('common');

		// do all the classes too.
		$.each(document.body.className.split(/\s+/),function(i,classname){
			UTIL.fire(classname);
			UTIL.fire(classname,bodyId);
		});

		UTIL.fire('common','finalize');

	} 

};

$(document).ready(UTIL.loadEvents);