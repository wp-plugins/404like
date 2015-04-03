=== Plugin Name ===
Contributors: tobig
Donate link: http://www.gnetos.de
Tags: 404, not found, redirect, 301, autoredirect, posts, page
Requires at least: 2.7.0
Tested up to: 4.1
Stable tag: 1.1.0

It is not issued any 404 error message, but looking for similar sites and forwarded to any results or output a list of possible matches

== Description ==
Es wird keine 404 Fehlermeldung ausgegeben, sondern nach ähnlichen Seiten gesucht und auf eventuelle Treffer weitergeleitet oder eine Liste möglicher Treffer ausgegeben. Damit wird bei einer Änderung der Kategorisierung die Seite oder der Artikel wieder gefunden und keine 404 Seite ausgegeben. 

It is not issued any 404 error message, but looking for similar sites and forwarded to any results or output a list of possible matches

== Changelog ==
= 1.1.0 =
* Fix Search now by title and post name
* Fix Now search similar pages not with extension html or htm
= 1.0.2 =
* Check for sql injection by '";
* Plugin work automatic without code in 404 template
= 1.0 =
First version

== Upgrade Notice ==

= 1.1.0=
Nothing

= 1.0.2 =
* This version fixed security problem
* The using of <?php checkPage(); ? > is deprecated. It was replace with a automatic function.

== Installation ==

1. Upload `404Like.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Nothing, it works without any other activities - you can test it
4. Optional add < ? php new404ErrorPage(); ? >  to your 404 template page.
