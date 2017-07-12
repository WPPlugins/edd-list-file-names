=== EDD List File Names ===
Contributors: sumobi
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EFUPMPEZPGW7L
Tags: easy digital downloads, digital downloads, e-downloads, edd, e-commerce, ecommerce, sumobi, files
Requires at least: 3.3
Tested up to: 3.9 alpha
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shows a simple list of the download's files with a shortcode

== Description ==

This plugin requires [Easy Digital Downloads](http://wordpress.org/extend/plugins/easy-digital-downloads/ "Easy Digital Downloads"). 

Using the included `[edd_file_names]` shortcode you'll be able to list a download's file names (not file paths). This is useful for showing customers what is included when they purchase your product. The shortcode also takes 2 parameters, title and ID. Using the ID you're able to show a download's file names from another post/page/download.

**Shortcode usage**

Basic listing of the current download in an ordered list

    [edd_file_names]
 
Custom title above the list

    [edd_file_names title="Files Included"]

Show the download's files by using it's ID. Useful when you are also using the [purchase_link] shortcode on another page/post

    [edd_file_names id="123" title="Another download's files"]


**Modifying the HTML markup**

This example shows how you can modify the HTML markup. Heading has been replaced with an `<h1>` tag, and the list is now an unordered list. Copy and paste the following function into your child theme's functions.php or a custom plugin:

	function sumobi_edd_list_file_names( $html, $title, $download_files ) { 
		ob_start();
		if ( $download_files && is_array( $download_files ) ) : ?>

			<?php if ( $title ) : ?>
			<h1><?php echo $title; ?></h1>
			<?php endif; ?>
				
			<ul class="edd-file-names">
			<?php foreach ( $download_files as $file ) : ?>
				<li><?php echo $file['name']; ?></li>
			<?php endforeach; ?>
			</ul>

		<?php endif;
		
		$html = ob_get_clean();
		return $html;
	}
	add_filter( 'edd_list_file_names', 'sumobi_edd_list_file_names', 10, 3 );

**Extensions for Easy Digital Downloads**

[https://easydigitaldownloads.com/extensions/](https://easydigitaldownloads.com/extensions/?ref=166 "Plugins for Easy Digital Downloads")

**Tips for Easy Digital Downloads**

[http://sumobi.com/blog](http://sumobi.com/blog "Tips for Easy Digital Downloads")

**Stay up to date**

*Follow me on Twitter* 
[http://twitter.com/sumobi_](http://twitter.com/sumobi_ "Twitter")

*Become a fan on Facebook* 
[http://www.facebook.com/sumobicom](http://www.facebook.com/sumobicom "Facebook")

== Installation ==

1. Unpack the entire contents of this plugin zip file into your `wp-content/plugins/` folder locally
1. Upload to your site
1. Navigate to `wp-admin/plugins.php` on your site (your WP Admin plugin page)
1. Activate this plugin

OR you can just install it with WordPress by going to Plugins >> Add New >> and type this plugin's name

== Changelog ==

= 1.0.1 =
* New: Added edd-file-names CSS class on ordered list for easier styling

= 1.0 =
* Initial release