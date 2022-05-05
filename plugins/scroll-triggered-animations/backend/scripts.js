jQuery(window).ready(function(){
	/*
	 * Page Navigation
	 */
	jQuery('.header-nav li').on('click', function(){
		var page = jQuery(this).attr('data-name');
		jQuery('.page, .header-nav li').removeClass('active');
		jQuery('.page[data-name="'+page+'"], .header-nav li[data-name="'+page+'"]').addClass('active');
	})
	
	/*
	 * Save Options
	 */
	function updateSTAoptions(element){
		var element = jQuery(element);
		var option = jQuery(element).attr('name');
		var value = jQuery(element).val();
		if(jQuery(element).is(':checkbox')){
			value = jQuery(element).prop('checked');
		}
		 jQuery.ajax({
			 type : "post",
			 url : './admin-ajax.php',
         	 data : {action: 'sta_update_options', 
				 	 option : option,
				 	 value : value
					},
         	  success: function(sta_update_options) {
				  jQuery(element).parents('.option-area').addClass('success');
				  
				  setTimeout(function(element){
					jQuery('.option-area').removeClass('success');
				  }, 1200);
              }
      })
	}
	
	jQuery('body').on('change','input:not(#element-activator)', function(){
		   updateSTAoptions(jQuery(this))
	})
	
	/*
	 * Trying to update a premium option
	 */
	jQuery('.option.premium').on('click', function(){
		window.open('https://www.toastplugins.co.uk/plugins/scroll-triggered-animations/');
	})
	
	/*
	 * Show more animations in the list of easy animations
	 */
	jQuery('.easy-animations.short-list').height(400);
	jQuery('.easy-animations.short-list').append('<div class="show-more">Show more Easy Animations <span class="dashicons dashicons-arrow-down-alt2"></span></div>')	
	jQuery('body').on('click', '.easy-animations.short-list .show-more', function(){
		var height = jQuery('.easy-animations').css({'height': 'auto'}).height();
		jQuery('.easy-animations.short-list').height(400);
		jQuery('.easy-animations.short-list').height(height).removeClass('short-list');
		jQuery(this).remove();
	})
	
	/*
	 * Animate the easy animation example when hovered
	 */
	jQuery('.easy-animations-list li:not(.additional-controls-list li)').on('mouseenter', function(){
		var animation = jQuery(this).attr('data-animation');
		
		jQuery('#example-block').removeAttr('class');
		jQuery('#example-block').addClass(animation);
		jQuery('.example-area').show();
		
		jQuery(this).append(jQuery('.example-area'));
		
		setTimeout(function(){
			jQuery('#example-block').addClass('scroll-triggered')
		}, 50)	
	})
	
	jQuery('.easy-animations-list li').on('mouseleave', function(){
		jQuery('.example-area').hide();
	})
	
	/*
	 * Copying easy animations
	 */
	jQuery('.easy-animations-list li').on('click', function(){
		if(jQuery(this).hasClass('premium')){
			window.open('https://www.toastplugins.co.uk/plugins/scroll-triggered-animations/');
		}else{
			var animation = jQuery(this).attr('data-animation');
			jQuery('body').append('<input id="animation-copy" type="text" value="'+animation+'">');
			jQuery('#animation-copy').select();
			document.execCommand("copy");
			jQuery('#animation-copy').remove();
			
			jQuery(this).addClass('copied');
				  
			setTimeout(function(){
				jQuery('.easy-animations-list li').removeClass('copied');
			}, 1200);
		}
	})
	
	/* 
 	 * Validate element 
 	 */
	function validateElement(element, elements){
		if(element.includes(',')){
			alert('Do not comma seperate you selectors. Please activate them seperately.')
			return false;
		} else if(element.includes('*')){
			alert('Cannot activate element. Do not use any special characters.')
			return false;
		} else if(element == ''){
			alert('Please insert at least 1 character. Activation must have a value.')
			return false;
		} else if(elements.length >= 3){
			alert('Please upgrade to premium top activate more than 3 elements')
			window.open("https://www.toastplugins.co.uk/plugins/scroll-triggered-animations/");
			return false;
		} else if(element.includes('.')){
			alert('Please upgrade to premium to target CSS classes');
			window.open("https://www.toastplugins.co.uk/plugins/scroll-triggered-animations/");
			return false;
		} else{
			return true;
		}
	}
	
	/*
	 * Activate an element
	 */
	function activateElement(){
		var activated = jQuery('input[name="toast_sta_advanced_animations"]').val();
		var activate = jQuery('#element-activator').val();
		
		if(validateElement(activate, activated.split(','))){
		if(jQuery('.activated-elements').length){
		jQuery('.activated-elements').append('<li class="activated-element">'+activate+'</li>');
		}else{
		jQuery('.no-activated-elements').replaceWith('<ul class="activated-elements"></ul>');
		jQuery('.activated-elements').append('<li class="activated-element">'+activate+'</li>');
		}
		if(activated){
			var activate = activated + ',' + activate;
		}else{
			var activate = activate;
		}
		jQuery('input[name="toast_sta_advanced_animations').val(activate);
		jQuery('input[name="toast_sta_advanced_animations"]').trigger('change');
		jQuery('#element-activator').val('');
		}
}
	
	jQuery('body').on('click','#activate-element', function(){
		activateElement();
	})
	
	jQuery('#element-activator').on('keydown', function(e){
		if(e.key === 'Enter'){
			e.preventDefault();
			activateElement();
		}
	})
	
/* 
 * Removing Custom Animations 
 */
	jQuery('body').on('click', '.activated-element', function(){
		var element = jQuery(this).text();
		var confirmation = confirm('Are you sure you would like to deactivate "'+element+'"?')
		if(confirmation == true){
			jQuery(this).remove();
			var oldelements = jQuery('input[name="toast_sta_advanced_animations"]').val();
			var oldelementsarray = oldelements.split(",");
			var elementpos = oldelementsarray.indexOf(element);
			oldelementsarray.splice(elementpos, 1);
			jQuery('input[name="toast_sta_advanced_animations"]').val(oldelementsarray);
			jQuery('input[name="toast_sta_advanced_animations"]').trigger('change');
		}
	})
	
})