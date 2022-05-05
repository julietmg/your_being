<?php /*
       * License before premium installed
       */

function sta_license_key_free(){ ?>
	<p class="bolden">License: <span class="highlight">N/A</span></p>
<?php }
add_action('sta_status', 'sta_license_key_free');

/*
 * Aside advertise for premium
 */
function sta_premium_advert(){ ?>
	<a href="https://www.toastplugins.co.uk/plugins/scroll-triggered-animations/" target="_blank" class="premium-aside-advert">
		<h3>Get premium now</h3>
		<strong>Lifetime</strong> license starting from
		<div class="price">£19.99</div>
		<div class="button">Upgrade now</div>
	</a>
<?php }
add_action('sta_aside_advert_hook', 'sta_premium_advert', 5);