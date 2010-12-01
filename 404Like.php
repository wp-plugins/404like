<?php
/*
 Plugin Name: 404Like
 Plugin URI: http://www.gnetos.de/projekte/404Like
 Description: Es wird keine 404 Fehlermeldung ausgegeben, sondern nach �hnlichen Seiten gesucht und auf eventuelle Treffer weitergeleitet oder eine Liste m�glicher Treffer ausgegeben / It is not issued any 404 error message, but looking for similar sites and forwarded to any results or output a list of possible matches
 Version: 1.0
 Author: Tobias Gafner
 Author URI: http://www.gnetos.de
 License: GPL2
 */

/*  Copyright 2010  Tobias Gafner  (email : tobi@gnetos.de) 

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
/**
 * Search function
 */ 
function findPostWhereLikeNameTitle($title = "") {
	$where .= " (post_type = 'post' OR post_type = 'page') AND
    post_status = 'publish' AND (post_name like '%".$title."%' OR post_title like '%".$title."%')";
	return $where;
}
/**
 * Search function
 */ 
function findPostWhereLike($title = "") {
	$where = " (post_type = 'post' OR post_type = 'page') AND
    post_status = 'publish' AND (post_title like '%".$title."%')";
	return $where;
}
/**
 *  this function must call in your 404 Page
 *  
 *  <?php checkPage(); ? >
    <?php
    get_header();
    ? >
    .....
 *
 */  
function checkPage() {
	global $wpdb;

  $urltext =  $_SERVER['REQUEST_URI'];
	//$urltexta = substr($urltext,1);
	$urltext = trim($urltext);
  //Letztes / loeschen
  $urltext = htmlspecialchars($urltext); 
  if(strlen($urltext) != 0)   {
    //Letztes Zeichen ist ?
    if(substr ($urltext , -1,1) == "/") {
      $urltext = substr ($urltext , 0,-1);
    }
    //Letztes von xxx/xxxx/xxx ist interessant
    $searchWord = 	substr (strrchr ($urltext, "/"), 1);
    //SQL 
    $querystr = "SELECT * FROM $wpdb->posts WHERE ".findPostWhereLike($searchWord);
    $pageposts = $wpdb->get_col($querystr);
    if ($pageposts) {
      ob_start();
  		if (count($pageposts) == 1) { 
      	foreach ($pageposts as $id) {
          $url = get_permalink($id); 
          echo $inhalt;
          wp_redirect($url,301);
          // Okay, stop.
        }         
        
        wp_reset_query();               
        ob_end_flush();     
  		}
  	}
  }
}

/**
 * Result List by many results
 * 
 * example:
 * ...</p>
        < ? php new404ErrorPage(); ? >      
	....  
 */ 
function new404ErrorPage() {
	global $wpdb;

  $urltext =  $_SERVER['REQUEST_URI'];
  $urltext = trim($urltext);
  //Letztes / loeschen
  $urltext = htmlspecialchars($urltext); 
  if(strlen($urltext) != 0)   {
    //Letztes Zeichen ist ?
    if(substr ($urltext , -1,1) == "/") {
      $urltext = substr ($urltext , 0,-1);
    }                          
    //Letztes von xxx/xxxx/xxx ist interessant
    $searchWord = 	substr (strrchr ($urltext, "/"), 1);
    //SQL
    $querystr = "SELECT *  FROM $wpdb->posts WHERE ".findPostWhereLikeNameTitle($searchWord);   
    $pageposts = $wpdb->get_col($querystr);
    if ($pageposts) {
    //Ausgabe
      echo '<div id="errorresults"><h2 class="twost">Folgendes Gesucht ?</h2><ul>';
    	foreach ($pageposts as $id) {
        $post_id_7 = get_post($id);
        $url = get_permalink($id);  
        $title = $post_id_7->post_title;
        echo "<li>".'<a href="'.$url.'">'.$title."</a></li>";
    	}
    	echo "</ul></div>";
    }
  	//Reset Query
  	wp_reset_query();
	}
}
?>