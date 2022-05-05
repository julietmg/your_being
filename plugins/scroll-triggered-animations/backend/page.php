<?php function toast_sta_options_page(){ ?>
	<div class="sta-wrap wrap">
		<h1 class="screen-reader-text">Scroll Triggered Animations</h1>
		<div class="sta-body">
			<header class="sta-header">
				<a href="https://www.toastplugins.co.uk/" target="_blank" class="logo">
				<img src="<?php echo plugins_url(); ?>/scroll-triggered-animations/assets/logo-white.png">
				</a>
				<ul class="header-nav">
					<li class="active" data-name="hub">
						<h3>Animation Hub</h3>
						The hub of your animations
					</li>
					<li data-name="easy">
						<h3>Quick & Easy Animations</h3>
						Easy to setup. Anyone can use.
					</li>
					<li data-name="custom">
						<h3>Custom Animations</h3>
						Fast setup for CSS experts.
					</li>
					<li data-name="visual">
						<h3>Visual Animation builder</h3>
						 More control, slower setup.
					</li>
				</ul>
			</header>
			<main class="sta-content">
					<?php include dirname(__FILE__) . '/pages/pages.php'; ?>
			</main>
			<aside class="sta-aside">
				<?php do_action('sta_aside_advert_hook'); ?>
				<div class="documentation">
					<h3>Documentation</h3>
					<p>Struggling to configure your animations? Our documentation is a great place to get started.</p>
					<a href="https://www.toastplugins.co.uk/documentation/scroll-triggered-animations/" class="button" target="_blank">Read the documentation</a>
				</div>
			</aside>
		</div>
	</div>
<?php } ?>
