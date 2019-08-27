<?php
/**
   * Calculating the difference between two dates
  
       * @author: Elliott White
  
       * @author: Jonathan D Eisenhamer.
   
       * @link: http://www.quepublishing.com/articles/article.asp?p=664657&rl=1
  
       * @since: Dec 1, 2006.
   
       */
   
      if( function_exists( 'date_default_timezone_set' ) )
       {
  
      // Set the default timezone to US/Eastern
  
      date_default_timezone_set( 'US/Eastern');
  
      }
  
       
  
      // Will return the number of days between the two dates passed in
 
      function count_days( $a, $b )
  
      {
  
      // First we need to break these dates into their constituent parts:
  
      $gd_a = getdate( $a );
  
      $gd_b = getdate( $b );
  
    // Now recreate these timestamps, based upon noon on each day
  
      // The specific time doesn't matter but it must be the same each day
  
      $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
  
      $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );
  
      // Subtract these two numbers and divide by the number of seconds in a
  
      // day. Round the result since crossing over a daylight savings time
  
      // barrier will cause this time to be off by an hour or two.
  
      return round( abs( $a_new - $b_new ) / 86400 );
  
      }
  
       
  
      // Prepare a few dates
 	 /*$date1 = strtotime( '12/3/1973 8:13am' );
     $date2 = strtotime( '1/15/1974 10:15pm' );
     $date3 = strtotime( '2/14/2005 1:32pm' );
  
       
  
      // Calculate the differences, they should be 43 & 11353
      echo "<p>There are ", count_days( $date1, $date2 ), " days.</p>\n";
      echo "<p>There are ", count_days( $date2, $date3 ), " days.</p>\n";*/
 
?>