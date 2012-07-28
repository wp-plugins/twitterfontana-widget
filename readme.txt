=== Twitter Fontana Widget ===
Contributors: Eight Media
Donate link: http://www.eight.nl (just tell us if you like it!)
Tags: twitter, widget, social, sidebar, last, tweet, tweets, tweetbox, twitterfontana, fontana
Requires at least: 3.4.1
Tested up to: 3.4.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create visual engaging twitter visualizations with Twitter Fontana

== Description ==

Sidebar widget to visualize tweets for a given search query. Enter a keyword, choose an animation, and customize the appearance to your liking.

This plugin provides the sidebar widget, and a shortcode to embed the widget in your main content. The widget just inserts an iframe, so if you need more flexibility, visit twitterfontana.com, and use the embed code directly.

TwitterFontana is a open-source alternative for Flash based Twitter Fountains and tweetwidgets, it is built using HTML5, CSS (SASS) and Javascript. It is hosted at https://github.com/EightMedia/TwitterFontana

**Features**

In admin:

* Easy to install.
* Easy configuration (Appearance -> Widgets).
* Highly customizable (Animation effects, fonts, background colors, background image)
* Use custom CSS for maximum flexibility
* Shortcode to insert the widget where you want

In your site:

* Smart default style (CSS)
* Display link (with special CSS classes) for hastags, users, and web link (`nofollow` links)
* Display twitter's user link and statut's link
* Display source (web, Tweetdeck, etc.) when it's possible
* In option: little slideshow of one tweet in a list of tweets

**Languages**

* Just English, for now

== Installation ==

You can use one of the both method :

**Installation via your Wordpress website**

1. Go to the admin menu 'Plugins' -> 'Install' and search for 'Twitter Fontana'
1. Click 'install' and activate it
1. Configure your widget in Appearance -> Widgets

**Manual Installation**

1. Upload folder `twitterfontana` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Configure plugin in Appearance -> Widgets.

== Screenshots ==
1. Twitter Fontana with default settings
2. Twitter Fontana in the admin
3. Twitter Fontana with customized appearance

== Frequently Asked Questions ==

= How do I use the shortcode? = 

You can use the widget within a post with the shortcode [twitterfontana]. You can customize the widget by providing options, for example: 

[twitterfontana twittersearch="Eight Media" effect="Zoom" font_face="Crete Round, serif"]

Available options :

* twittersearch: searchquery for tweets, defaults to "twitterfontana"
* message_animate_interval: number of millisecondes between animations, default is 6000.
* effect: currently three animation effects are available: 
    * "Slide" (default)
    * "Fade"
    * "Zoom"
* custom_css: url for custom styling, default empty
* font_face: available fonts:
    * "Arial, sans-serif" (default)
    * "Verdana, sans-serif"
    * "Helvetica, Arial, sans-serif"
    * "Open Sans, sans-serif"
    * "Exo, sans-serif"
    * "Imprima, sans-serif"
    * "Handlee, cursive"
    * "Crete Round, serif"
    * "Enriqueta, serif"
* text_color: Font color of the message, default: "#ffffff".
* special_color: Font color of hashtags and usernames in the tweet, default: "#aaea71".
* bg_color: Background color of the widget, default: "#482b73".
* bg_image: Url of background image of the widget, default empty
* box_bg: Background color of tweet, default: #80b43c

== Changelog ==

= 1.0.0 =

* Initial release, beta 

== Upgrade Notice ==

= 1.0.0 =

* Initial release, first version

