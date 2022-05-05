<?php $sta_options = get_option( 'toast_sta_settings' ); ?>
<div class="page active" data-name="hub">
	<h2 class="page-title">Animation Hub</h2>
	<div class="page-content">
		
		<div class="area-wrap">
			<h3>Status</h3>
			<?php do_action('sta_status'); ?>
		</div>	
	
		<div class="area-wrap">
			<h3>Global Settings</h3>
			<p>Your configurations here will affect <strong>ALL</strong> of your animations.</p>
			<div class="option-area">
				<div class="option">
					<input type="checkbox" name="disable_all" id="disable_all" <?php if($sta_options['disable_all'] == 'on'): ?>checked<?php endif; ?>>
					<label for="disable_all">
						<h4>Disable ALL animations</h4>
						Enable to disable all STA generated animations.
					</label>
				</div>
				<div class="option">
					<input type="checkbox" name="toast_animate_on_page_load" id="toast_animate_on_page_load" <?php if($sta_options['toast_animate_on_page_load'] == 'on'): ?>checked<?php endif; ?>>
					<label for="toast_animate_on_page_load">
						<h4>Play animations on page load</h4>
						Enable this options to play your animations before any scroll movement. Useful if you have animations at the top of a page.
					</label>
				</div>
				<div class="option premium">
					<input type="checkbox" name="toast_sta_repeat_animations" id="toast_sta_repeat_animations" <?php if($sta_options['toast_sta_repeat_animations'] == 'on'): ?>checked<?php endif; ?>>
					<label for="toast_sta_repeat_animations">
						<h4>Repeat animations?</h4>
						Enabling this option will cause elements to re-animate when they have left and re-entered the viewport. 
					</label>
				</div>
			</div>
		</div>
		
		<div class="area-wrap">
			<div class="option-area">
				<div class="option">
					<label for="toast_sta_position_start">
						<h4>Animation start position (Bottom)</h4>
						Select the number of pixels from the bottom of the viewport your animations will start. Useful if you have a fixed footer.
					</label>
					<input type="number" name="toast_sta_position_start" id="toast_sta_position_start" value="<?php echo $sta_options['toast_sta_position_start']; ?>" placeholder="0">
					<div class="unit">px</div>
				</div>
				<div class="option premium">
					<label>
						<h4>Animation start position (Top)</h4>
						Select the number of pixels from the top of the viewport your animations will start. Useful if you have a fixed header. Only applicable if repeat animations* is enabled.
					</label>
					<input type="number" name="toast_sta_offset_from_top" id="toast_sta_offset_from_top" value="<?php echo $sta_options['toast_sta_offset_from_top']; ?>" placeholder="0">
					<div class="unit">px</div>
				</div>
			</div>	
		</div>
		
		<div class="area-wrap">
			<h3>Helpful Articles</h3>
			<div class="option-area">
				<a href="https://www.toastplugins.co.uk/how-to-add-animations-to-your-wordpress-website/" target="_blank" class="article">
					Getting started with Scroll Triggered Animations
				</a>
				<a href="https://www.toastplugins.co.uk/how-to-animate-sections-of-your-website/" target="_blank" class="article">
					Animating sections of your website
				</a>
			</div>
		</div>
		
	</div>
</div>