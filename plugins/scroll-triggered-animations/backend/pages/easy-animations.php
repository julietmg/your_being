<div class="page" data-name="easy">
	<h2 class="page-title">Quick & Easy Animations</h2>
	<div class="page-content">
		
		<div class="area-wrap">
		<h3>Quick & Easy Animation Classes</h3>
		Apply any of the CSS classes below to animate like the example.
		
		<div class="easy-animations short-list">
			<ul class="easy-animations-list">
				<li data-animation="fade-in-left"><h5>Fade In From Left:</h5> fade-in-left</li>
				<li data-animation="fade-in-right"><h5>Fade In From Right:</h5> fade-in-right</li>
				<li data-animation="fade-in-up"><h5>Fade In From Top:</h5> fade-in-up</li>
				<li data-animation="fade-in-down"><h5>Fade In From Bottom:</h5> fade-in-down</li>
				<li data-animation="bounce-in-left"><h5>Bounce In From Left:</h5> bounce-in-left</li>
				<li data-animation="bounce-in-right"><h5>Bounce In From Right:</h5> bounce-in-right</li>
				<li data-animation="bounce-in-down"><h5>Bounce In From Bottom:</h5> bounce-in-down</li>
				<li data-animation="bounce-in-up"><h5>Bounce In From Top:</h5> bounce-in-up</li>
				<li data-animation="grow-left" class="premium"><h5>Grow Left (Gain Width)</h5> grow-left</li>
				<li data-animation="grow-right" class="premium"><h5>Grow Right (Gain Width)</h5> grow-right</li>
				<li data-animation="grow-up" class="premium"><h5>Grow Up (Gain Height)</h5> grow-up</li>
				<li data-animation="grow-down" class="premium"><h5>Grow down (Gain Height)</h5> grow-down</li>
				<li data-animation="rubber-band" class="premium"><h5>Rubber Band Effect</h5> rubber-band</li>
				<li data-animation="skew-in-right" class="premium"><h5>Skew in Clockwise:</h5> skew-in-right</li>
				<li data-animation="skew-in-left" class="premium"><h5>Skew in Counter-Clockwise:</h5> skew-in-left</li>
			</ul>
			<ul class="easy-animations-list">
				<li data-animation="flip-left"><h5>Flip Left</h5> flip-left</li>
				<li data-animation="flip-right"><h5>Flip Right:</h5> flip-right</li>
				<li data-animation="flip-up"><h5>Flip Up:</h5> flip-up</li>
				<li data-animation="flip-down"><h5>Flip Down</h5> flip-down</li>
				<li data-animation="move-in-left"><h5>Move In From Left</h5> move-in-left</li>
				<li data-animation="move-in-right"><h5>Move In From Right</h5> move-in-right</li>
				<li data-animation="move-in-up"><h5>Move In From Top</h5> move-in-up</li>
				<li data-animation="move-in-down"><h5>Move In From Bottom</h5> move-in-down</li>
				<li data-animation="swing-forward" class="premium"><h5>Swing Forward:</h5> swing-forward</li>
				<li data-animation="swing-side" class="premium"><h5>Swing Sideways:</h5> swing-side</li>
				<li data-animation="zoom-in" class="premium"><h5>Zoom In:</h5> zoom-in</li>
				<li data-animation="shake" class="premium"><h5>Shake:</h5> shake</li>
				<li data-animation="blur-in" class="premium"><h5>Blur In (Gain focus)</h5> blur-in</li>
				<li data-animation="colour-gain" class="premium"><h5>Change from B&W to colour</h5> colour-gain</li>
			</ul>
			<div class="example-area">
				<img src="<?php echo plugins_url(); ?>/scroll-triggered-animations/assets/logo-white.png" id="example-block" class="swing-side scroll-triggered">
			</div>
		</div>	
		</div>
		
		<div class="area-wrap additional-controls">
			<h3>Additional Controls</h3>
			Apply any of the CSS classes in conjuction with animate class above for additional controls.
			<ul class="easy-animations-list additional-controls-list">
				<li data-animation="speed-xxx" class="premium"><h5>Speed Control</h5>speed-xxx <small>Replace 'xxx' with the speed in ms. 1000 = 1 second</small></li>
				<li data-animation="delay-xxx" class="premium"><h5>Delay Control</h5>delay-xxx  <small>Replace 'xxx' with the delay in ms. 1000 = 1 second</small></li>
			</ul>
		</div>
		
		<?php $sta_options = get_option( 'toast_sta_settings' ); ?>
		<div class="area-wrap">
			<h3>Easy Animation Controls</h3>
			<div class="option-area">
				<div class="option premium">
					<input type="checkbox" name="toast_sta_disable_on_mobile" id="toast_sta_disable_on_mobile" <?php if($sta_options['toast_sta_disable_on_mobile'] == 'on'): ?>checked<?php endif; ?>>
					<label for="toast_sta_disable_on_mobile">
						<h4>Disable Easy Animations on mobile</h4>
						Disable all Easy Animations on mobile devices.
					</label>
				</div>
			</div>
		</div>
	</div>
</div>