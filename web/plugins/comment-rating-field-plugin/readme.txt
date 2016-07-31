=== Comment Rating Field Plugin ===
Contributors: n7studios,wpcube
Donate link: http://www.wpcube.co.uk/plugins/comment-rating-field-pro-plugin
Tags: comment,field,rating,ratings,star,stars,gd,comments,review,reviews,stars,feedback
Requires at least: 3.6
Tested up to: 4.5.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a 5 star rating field to the end of a comment form in WordPress.

== Description ==

Comment Rating Field adds a 5 star rating field to the end of a comment form in WordPress, allowing the site visitor to optionally submit a rating along with their comment. Ratings are displayed as stars below the comment text.

> #### Comment Rating Field Pro
> <a href="https://www.wpcube.co.uk/plugins/comment-rating-field-pro-plugin/" rel="friend" title="Allow site visitors to leave star ratings on Pages, Posts and Custom Post Types when posting comments on WordPress">Comment Rating Field Pro</a> provides additional functionality:<br />
>
> - Custom Post Types: Support for rating display and functionality on ANY Custom Post Types and their Taxonomies.<br />
> - Multiple Rating Fields and Groups: Create, edit and delete an unlimited number of rating field groups. Each group can have unlimited rating fields, and be targeted to display on a comment form for a specific Custom Post Type and/or Taxonomy.<br />
> - Widgets: List the Highest Average Rating Posts within your sidebars.<br />
> - Shortcodes: Use a shortcode to display the Average Rating anywhere within your content.<br />
> - Enhanced Display Options: Enhanced display options, including to display the average rating on excerpts, content, comments; position the average rating and display a rating breakdown.<br />
> - Colors: Define the colours for stars per rating group<br />
> - Amazon Bar Chart Rating Breakdown: Choose to output a breakdown of ratings in the same style as Amazon<br />
> - Limit Ratings: Prevent reviewers leaving more than one comment rating per Post<br />
> - Rich Snippets: Choose a schema (e.g. Review, Product, Place, Person) for your Ratings<br />
> - WooCommerce: Replace WooCommerce\'s built in reviewing system with a multi field, enhanced one<br />
>
> [Upgrade to Comment Rating Field Pro](https://www.wpcube.co.uk/plugins/comment-rating-field-pro-plugin/)

= Support =

We will do our best to provide support through the WordPress forums. However, please understand that this is a free plugin, 
so support will be limited. Please read this article on <a href="http://www.wpbeginner.com/beginners-guide/how-to-properly-ask-for-wordpress-support-and-get-it/">how to properly ask for WordPress support and get it</a>.

If you require one to one email support, please consider <a href="http://www.wpcube.co.uk/plugins/comment-rating-field-pro-plugin" rel="friend">upgrading to the Pro version</a>.

= WP Cube =
We produce free and premium WordPress Plugins that supercharge your site, by increasing user engagement, boost site visitor numbers
and keep your WordPress web sites secure.

Find out more about us at <a href="http://www.wpcube.co.uk" rel="friend" title="Premium WordPress Plugins">wpcube.co.uk</a>

== Installation ==

1. Upload the `comment-rating-field-plugin` folder to the `/wp-content/plugins/` directory
2. Active the Comment Rating Field Plugin through the 'Plugins' menu in WordPress
3. Configure the plugin by going to the `Comment Rating Field Plugin` menu that appears in your admin menu

== Frequently Asked Questions ==



== Screenshots ==

1. Comment Rating Field Plugin on Comment Form
2. Star rating displayed below comment text 

== Changelog ==

= 2.0.9 =
* Tested with WordPress 4.3
* Fix: plugin_dir_path() and plugin_dir_url() used for Multisite / symlink support

= 2.0.8 =
* Added: Spanish translation
* Fix: Only calculate average rating from approved comments (some comments awaiting moderation were wrongly included in calculations previously)

= 2.0.7 =
* Fix: Changed Menu Icon
* Fix: WordPress 4.0 compatibility
* Fix: Removed unused admin CSS

= 2.0.6 =
* Fix: PHP warning on uninitialized $totalRating variable (props: tim.samuelsson)

= 2.0.5 =
* Added translation support and .pot file

= 2.0.4 =
* Fix: Better jQuery rating integration

= 2.0.3 =
* Removed reference to unused admin.js file

= 2.0.2 =
* Committed frontend.js; removed unused files

= 2.0.1 =
* Dashboard CSS + JS enhancements

= 2.0 =
* Fix: UI enhancements

= 1.5 =
* Fix: Upgrade link
* Version number in line with Pro version

= 1.42 =
* Fix: Enabled on Page option (ratings now display on Pages)
* Fix: CSS for some installations where rating numbers would display in front of stars

= 1.41 =
* Fix for WordPress 3.4 compatibility
* jQuery Rating Javascript updated to 3.14

= 1.4 =
* Removal of Donate Button
* On Activation, plugin no longer enables ratings on Pages and Posts by default
* Change: Average Rating displayed below content for better formatting and output on themes
* Fix: Language / localisation support
* Fix: Rating only shows on selected categories where specified in the plugin
* Fix: Recalculation of rating when comment removed
* Fix: Multisite Compatibility
* Fix: W3 Total Cache compatibility
* Pro Version Only: Support: Access to support ticket system and knowledgebase
* Pro Version Only: Custom Post Types: Support for rating display and functionality on ANY Custom Post Types and their Taxonomies
* Pro Version Only: Widgets: List the Highest Average Rating Posts within your sidebars
* Pro Version Only: Shortcodes: Use a shortcode to display the Average Rating anywhere within your content
* Pro Version Only: Rating Field: Make rating field a required field
* Pro Version Only: Display Average Rating: Choose to display average rating above or below the content
* Pro Version Only: Seamless Upgrade: Retain all current settings and ratings when upgrading to Pro

= 1.3 =
* Javascript changes to fix comment rating field not appearing below comment field on some themes.

= 1.2 =
* Enable on Pages Option Added
* Enable on Post Categories Option Added
* Display Average Option Added - will display the average of all ratings at the top of the comments list.
* Donate Button Added to Settings Panel
* Change to readme.txt file for required ID on comment form.

= 1.01 =
* Fixed paths for CSS and Javascript.

= 1.0 =
* First release.

== Upgrade Notice ==
