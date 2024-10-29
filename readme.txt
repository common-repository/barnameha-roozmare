=== Barnameha Roozmare ===
Contributors: parselearn,barnameha
Donate link: http://www.barnameha.ir/support
Tags: post,admin,posts,barnameha,roozmare, twitter ,twitter.com,facebook, post per day,barnameha roozmare,short post,twitter service,day to day,simple post,social service,theme
Requires at least: 2.5
Tested up to: 3.0
Stable tag: 1.0.1

Barnameha Roozmare: Send Short Post. Similar twitter.com

== Description ==
Barnameha Roozmare: Send Short Post. Similar twitter.com

Send Event, Feel, Report, ... only 140 Characters.


* Do You Want Add Similar Twitter Service To Website
* Do You Want Send Short Post Day To Day
* ...


* [Home Page](http://www.blog.barnameha.ir/barnameha-roozmare.html)
* [Design](http://www.design.barnameha.ir/)
* [Support](http://www.barnameha.ir/support)
* [Website](http://www.barnameha.ir/)
* [Weblog](http://www.blog.barnameha.ir)



== Installation ==
1. Upload `barnameha-roozmare` directory  to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress backend
3. After active plugin display `Roozmare` menu

== Frequently Asked Questions ==

= Add Roozmare: =
Go to `Roozmare` menu, then clicked `Add Roozmare`

= Manage Roozmare: =
Go to `Roozmare` menu, then clicked `Manage Roozmare`
 
this page for show, change display, edit, delete roozmare


= Settings: =
change:
- Show Date 
- Show Time 
- Use New Line 
- Show Pages 
- Theme 
- roozmare count in admin & display page

= How Work? =
2 method for show roozmare  

1: Use Shortcode: 

- Create a new WordPress Page or Post (checked `Make this post sticky`) . The Page will behave as usual, you can add text, images, etc. 

- then add `[barnameha-roozmare]` text in post content  

2: Use Function: 

- you can use a function. (after the opening `<?php` tag):

`if(function_exists("barnameha_roozmare")){ barnameha_roozmare(2,false); } ` 

first argumant for roozmare count, default=5 

second argumant for show roozmare page, default=true 


= How Make Theme? =
1- Theme Directory: `wp-content\plugins\barnameha-roozmare\theme`

2- Create Main Page, Example: `simple.html`
	Use `{br_post}` text in simple.html for Roozmare Loop.
	Use `{br_page}` text in simple.html for Pages.

3- Create Roozmare Loop Page, Example: `simple_p.html`

	Use `{br_author}` text in simple_p.html for Show Author Roozmare
	Use `{br_date}` text in simple_p.html for Show Date Roozmare
	Use `{br_time}` text in simple_p.html for Show Time Roozmare
	Use `{br_content}` text in simple_p.html for Show Content Roozmare
	Use `{br_separate}` text in simple_p.html for Show Separate chr ( , )



4- Create Style Sheet Document, Example: `simple_css.css`

5- Filter FileName in Page Settings (select Theme):

`*_img*, *_p*, *.gif, *.jpg, *.jpeg, *.png, *.psd, *.js, *.css`

== Screenshots ==
1. Add Roozmare Page
2. Manage Roozmare
3. Roozmare Settings Page
4. Roozmare Page

== Changelog ==

= 1.0.1 =
FIX: interference in other plugin

= 1.0.0 =
The first version of plugin

== Upgrade Notice ==

= 1.0.1 =
FIX: interference in other plugin

= 1.0.0 =
The first version of plugin