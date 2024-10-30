<?php
/*
Plugin Name: Call Now Icon Animate
Plugin URI: http://alantien.com
Description: Mobile visitors will see a call now icon with animate css3 at the bottom of your site
Version: 0.1.0
Author: Alan Tien
Author URI: http://www.alantien.com
License: GPL2
*/
?>
<?php
/*  Copyright 2017  Alan Tien  (email : alantien99@gmail.com) - Thanks you Jerry Rietveld was supported me complete plugin

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
define('cnbm_VERSION','0.1.0');
add_action('admin_menu', 'register_cnbm_page');
add_action('admin_init', 'cnbm_options_init');

function register_cnbm_page() {
	add_submenu_page('options-general.php', 'Call Now Icon Animate', 'Call Now Icon Animate', 'manage_options', 'call-now-icon', 'call_now_settings_page');
}
set_basic_options();
// add the color picker
add_action( 'admin_enqueue_scripts', 'cnbm_enqueue_color_picker' );
function cnbm_enqueue_color_picker( $hook_suffix ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'cnbm-script-handle', plugins_url('call-now-icon.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

function cnbm_options_init() {
	register_setting('cnbm_options','cnbm');
}
function call_now_settings_page() { ?>
<div class="wrap"><h2>Call Now Icon Animate<span >by <a href="http://www.alantien.com" rel="help">Alan Tien</a></span></h2>


<form method="post" action="options.php">
            <?php settings_fields('cnbm_options'); ?>
            <?php $options = cnbm_get_options(); ?>
			<h4 style="max-width:700px; text-align:right; margin:0;cursor:pointer; color:#21759b" class="cnbm_settings"><span class="plus">+</span><span class="minus">-</span> Advanced settings</h4>
            <table class="form-table">
            	<tr valign="top"><th scope="row">Enabled/Disabled Icon</th>
                	<td>
                    	<input name="cnbm[active]" type="radio" value="1" <?php checked('1', $options['active']); ?> /> Enabled<br />
                        <input name="cnbm[active]" type="radio" value="0" <?php checked('0', $options['active']); ?> /> Disabled
                    </td>
                </tr>
                <tr valign="top"><th scope="row">Phone number</th>
                    <td><input type="text" name="cnbm[number]" value="<?php echo $options['number']; ?>" /></td>
                </tr>
			</table>
            <div id="settings">
            	<table class="form-table">
				<tr valign="top"><th scope="row">Icon color</th>
                	<td><input name="cnbm[color]" type="text" value="<?php echo $options['color']; ?>" class="cnbm-color-field" data-default-color="#F20000" /></td>
                </tr>
                <tr valign="top"><th scope="row">Icon color hover</th>
                	<td><input name="cnbm[colorhover]" type="text" value="<?php echo $options['colorhover']; ?>" class="cnbm-color-field-hover" data-default-color="#75eb50" /></td>
                </tr>
				<tr valign="top"><th scope="row">Appearance</th>
                	<td>
                    	<label title="right">
                        	<input type="radio" name="cnbm[appearance]" value="right" <?php checked('right', $options['appearance']); ?>>
                            <span>Right bottom</span>
                        </label><br />
                    	<label title="left">
                        	<input type="radio" name="cnbm[appearance]" value="left" <?php checked('left', $options['appearance']); ?>>
                            <span>Left bottom</span>
                        </label><br />
                    </td>
                </tr>
            </table>
			</div><!--#settings-->
            <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>

		<h2>Feedback, Requests &amp; Appreciation</h2>
        <div class="donate" style="width:160px; float:left; padding:20px; height:70px;">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHTwYJKoZIhvcNAQcEoIIHQDCCBzwCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYA/ZXWi0UHxlHg8OlGJNYUTytt1vm8Q+mqxXW2t/o7UR518BvZakVK9hV5OnKnh7nodDgXXuDHftRJzpJsLaM7iv/EvcKX0SyxzFnD7ZheMPWV4hj1PRb4aqavhgrfYvkfuljgUNE5rjJxu/bf+gIJpHk9Ix2JK5CaNgM8qjGtEzTELMAkGBSsOAwIaBQAwgcwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIXTCzJW/IUwuAgaiIyrt5ObUEx74LHoqpJpz8141oadGUq3gh5t5MN5enGW9v8nq0B58XJkqQHQzUJv+X0BhON1nQ3uth8GsPL8ilZIVn2+HOBVatA/qiDSh4M8Lvfr+LE19/liE+EcEl31ho0fsn0uhzephdtq3hoA2gzSkUQd/ubS9uHi9592HC4eEHzucvaBkNnpX1+0S4gquEd4abjZzaHWRLd7DIMVw0eI1BxZHirZqgggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xNzA2MDcwNDAyNDNaMCMGCSqGSIb3DQEJBDEWBBTAO39pxGNGyY5sZpvN4iqwmftSWTANBgkqhkiG9w0BAQEFAASBgF/scdgpVQlL6HHOo9aZ0YcqWBEufqkErQ6DC2Dmrv47AjDMfZiWYmE91zwlCP345H13c/H+QQWfKewMqvEzZ0vD956f0/3yicVC+pODUBewIuVUc/awvie7VuAXdzXEAIgfLzSpNSF0I/2uJiqJRo+iA43/PjWL3JpDB8J4BsuG-----END PKCS7-----
            ">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div><!--.donate-->

  		<p><strong>Feedback:</strong> I'am Alan Tien. I'm very interested in hearing your thoughts about the plugin. You can contact me <a href="https://www.facebook.com/alantien99">Facebook</a></p>
        <p><strong>Say thanks:</strong> Developing a plugin takes time and energy. If you like the plugin or use it for clients, consider making a donation. Thanks.</p>
    </div>
<?php }
if(get_option('cnbm') && !is_admin()) {
	
	// Color functions to calculate borders
	function changeColor($color, $direction) {
		if(!preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $color, $parts));
		if(!isset($direction) || $direction == "lighter") { $change = 45; } else { $change = -50; }
		for($i = 1; $i <= 3; $i++) {
		  $parts[$i] = hexdec($parts[$i]);
		  $parts[$i] = round($parts[$i] + $change);
		  if($parts[$i] > 255) { $parts[$i] = 255; } elseif($parts[$i] < 0) { $parts[$i] = 0; }
		  $parts[$i] = dechex($parts[$i]);
		} 
		$output = '#' . str_pad($parts[1],2,"0",STR_PAD_LEFT) . str_pad($parts[2],2,"0",STR_PAD_LEFT) . str_pad($parts[3],2,"0",STR_PAD_LEFT);
		return $output;
	}
	
	
	$options = get_option('cnbm');
	if(isset($options['active'])) $enabled = $options['active']; else $enabled = 0;
	if($enabled == '1') {
		// it's enables so put footer stuff here
		function cnbm_head() {
			$options = get_option('cnbm');
			$credits = "\n<!-- Call Now Icon Animate Mobile ".cnbm_VERSION." by Alan Tien (alantien.com) -->\n";
			echo $credits."<style>
                    .coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-img-circle {
                        background-color: ".changeColor($options['color'], 'darker').";
                    }
                .coccoc-alo-phone.coccoc-alo-green.coccoc-alo-hover .coccoc-alo-ph-img-circle, .coccoc-alo-phone.coccoc-alo-green:hover .coccoc-alo-ph-img-circle
                {background-color: ".changeColor($options['colorhover'], 'darker').";}
                @media screen and (max-width:650px){.coccoc-alo-phone.coccoc-alo-show {display:block;}}
                </style>";
				}
		add_action('wp_head', 'cnbm_head');
		
		function cnbm_footer() {
			$alloptions = get_option('cnbm');
			if($alloptions['appearance'] == 'left') {
			
			    $ButtonAppearance = "left:0px !important; bottom:20px !important;";
			} else {
			    $ButtonAppearance = "right:0px !important; bottom:20px !important;";
			}
			
			if(isset($alloptions['show']) && $alloptions['show'] != "") {
				$show = explode(',', str_replace(' ', '' ,$alloptions['show']));
				$limited = TRUE;
			} else {
				$limited = FALSE;
			}
			
			if($alloptions['tracking'] == '1') {
				$tracking = "onclick=\"_gaq.push(['_trackEvent', 'Contact', 'Call Now Button', 'Phone']);\""; 
			} elseif($alloptions['tracking'] == '2') {
				$tracking = "onclick=\"ga('send', 'event', 'Contact', 'Call Now Button', 'Phone');\""; 
			} else {
				$tracking = "";
			}
			
			if($limited) {
				if(is_single($show) || is_page($show)) {
				    ?>
		<a href="tel:<?php echo $alloptions['number'].$alloptions['color']?>">
        <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show" id="coccoc-alo-phoneIcon callnowicon" style="<?php echo $ButtonAppearance?>">
        <div class="coccoc-alo-ph-circle"></div>
        <div class="coccoc-alo-ph-circle-fill"></div>
        <div class="coccoc-alo-ph-img-circle"></div>
        </div></a>
				    
				<?php
				}
			} else {
			    ?>
				<a href="tel:<?php echo $alloptions['number']?>" >
        <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show" id="coccoc-alo-phoneIcon callnowicon" style="<?php echo $ButtonAppearance?>">
        <div class="coccoc-alo-ph-circle"></div>
        <div class="coccoc-alo-ph-circle-fill"></div>
        <div class="coccoc-alo-ph-img-circle"></div>
        </div></a>
        <?php
			}
		}
		add_action('wp_footer', 'cnbm_footer');
	}
} 

function cnbm_get_options() { // Checking and setting the default options
	if(!get_option('cnbm')) {
		$default_options = array(
							  'active' => 0,
							  'number' => '',
							  'color' => '#F20000',
		                      'colorhover' => '#75eb50',
							  'appearance' => 'right',
							  'tracking' => 0,
							  'show' => ''
							  );
		add_option('cnbm',$default_options);
		$options = get_option('cnbm');
	} 
	
	$options = get_option('cnbm');
	
	return $options;
}
function set_basic_options() {
	if(get_option('cnbm') && !array_key_exists('color', get_option('cnbm'))) {
		$options = get_option('cnbm');
		$default_options = array(
							  'active' => $options['active'],
							  'number' => $options['number'],
							  'color' => '#F20000',
							  'appearance' => 'right',
		                      'colorhover' => '#75eb50',
							  'tracking' => 0,
							  'show' => ''
							  );
		update_option('cnbm',$default_options);
	}
}
function getstyle1()
{
    // moved the js to an external file, you may want to change the path
    wp_enqueue_style('hrw', '/wp-content/plugins/call-now-icon-animate/css.css', null, null, false);
}
add_action('wp_enqueue_scripts', 'getstyle1');
?>
