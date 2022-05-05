<?php function sta_init_frontend_js(){ ?>
<?php $option = get_option( 'toast_sta_settings' ); ?>
<script name="Scroll Triggered Animations Script">
jQuery(window).on('load', function(){
var scrollTriggers = ['.move-in-left',
					 '.move-in-right',
					 '.move-in-up',
					 '.move-in-down',
					 '.fade-in',
					 '.fade-in-up',
					 '.fade-in-left',
					 '.fade-in-right',
					 '.fade-in-down',
					 '.flip-left',
					 '.flip-right',
					 '.flip-up',
					 '.flip-down',
					 '.bounce-in-left',
					 '.bounce-in-right',
					 '.bounce-in-down',
					 '.bounce-in-up',
					 ]

setTimeout(function(){
    joinsViewport(scrollTriggers.join(','));
		
	 joinsViewport('<?php echo $option['toast_sta_advanced_animations']; ?>');

 function joinsViewport(elements){
 
	 jQuery(elements).each(function(){
	 
	  var    elementTranformation = parseInt(jQuery(this).css('transform').split(',')[5]);
	  if(elementTranformation){
	  var    elementPosition = jQuery(this).offset().top - elementTranformation;
	  }else{
	  var    elementPosition = jQuery(this).offset().top
	  }
      var    topOfWindow = jQuery(window).scrollTop();
	  var	 windowHeight = jQuery(window).height();
	  var	 BottomOfWindow = topOfWindow + windowHeight;
	  var    item = jQuery(this)
	 
	  jQuery(window).scroll(function(){
             topOfWindow = jQuery(window).scrollTop(),
		     windowHeight = jQuery(window).height(),
		     BottomOfWindow = topOfWindow + windowHeight
		 
		 
		 if( elementPosition < BottomOfWindow <?php if($option['toast_sta_position_start']): ?>-<?php echo $option['toast_sta_position_start']; ?><?php endif; ?>){
			 jQuery(item).addClass('scroll-triggered');
		 }
			 
		 });
		 
//ANIMATE ITEMS ON PAGE LOAD
  <?php if(isset($option['toast_animate_on_page_load']) && $option['toast_animate_on_page_load'] == 'on'): ?>
	 if( elementPosition < BottomOfWindow<?php if($option['toast_sta_position_start']): ?>-<?php echo $option['toast_sta_position_start']; ?><?php endif; ?>){
	    jQuery(this).addClass('scroll-triggered');
	 } 
  <?php endif; ?>
		 
	 }); //END OF EACH
	 } //END OF JOINVIEWPORT FUNTION
	 

   //GIVE PERSPECTIVE TO FLIP ITEMS
   jQuery('.flip-left, .flip-right, .flip-downwards, .flip-down, .flip-upwards, .flip-up').parent().css({'perspective': '1000px'});

		
}, 200)
}); //END OF ON PAGE LOAD


</script>
<?php }
add_action('wp_footer','sta_init_frontend_js', 99999);