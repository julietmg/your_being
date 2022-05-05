<?php $sta_options = get_option( 'toast_sta_settings' ); ?>
<div class="page" data-name="custom">
	<h2 class="page-title">Custom Animations</h2>
	<div class="page-content">
		<div class="area-wrap">
		<h3>The advanced way to create animations on your site.</h3>
		<p>Familiar with CSS and HTML, start creating custom animations on a global scale.</p>
		<div class="option-area">
			<div class="option">
				<h2>Activating a CSS selector</h2>
				<ol>
					<li>Activate by any CSS selector (class, id, or any HTML tag)</li>
					<li>Activation will simply integrate the element with your STA settings</li>
					<li>A new class will be added when the element is due to animate 'scroll-triggered' which can be targetted with CSS. See example below.</li>
				</ol>
				<div class="code-example">
					h1{opacity:0;transition:.5s;}<br>
					h1.scroll-triggered{opacity:1;}
				</div>
			</div>
			
			<div class="option">
				<label>
				<h4>Activate element</h4>
				</label>
				<input type="text" id="element-activator" placeholder="Insert class, id, HTML tag">
				<div id="activate-element">Activate Element</div>
			</div>
		</div>
		</div>
		
		<div class="option-area" style="margin-top:20px;">
			<h2>Activated Elements</h2>
			<?php if($sta_options['toast_sta_advanced_animations']): ?>
			<?php $activated_elements = explode(',', $sta_options['toast_sta_advanced_animations']); ?>
			<p>Click an element to deactivate</p>
			<ul class="activated-elements">
			
			<?php foreach($activated_elements as $activated_element): ?>
				<li class="activated-element"><?php echo $activated_element; ?></li>
			<?php endforeach; ?>
			</ul>
			<?php else: ?>
			<div class="no-activated-elements">No Elements currently activated</div>
			<?php endif; ?>
			<input type="hidden" name="toast_sta_advanced_animations" <?php if($sta_options['toast_sta_advanced_animations'] !== 'off'): ?>value="<?php echo $sta_options['toast_sta_advanced_animations']; ?>"<?php endif; ?>>
		</div>
		
		<div class="option-area" style="margin-top:20px">
			<h2>Apply your CSS</h2>
			<p>Apply your CSS in the text box below or anywhere within your theme.</p>
			<textarea name="toast_sta_animations_css"><?php if($sta_options['toast_sta_animations_css']): ?><?php echo $sta_options['toast_sta_animations_css']; ?><?php endif; ?></textarea>
		</div>
		
	</div>
</div>