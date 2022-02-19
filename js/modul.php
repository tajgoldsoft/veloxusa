<?php 
      
            function my_htmlentities($input) {
             
             $string = htmlentities($input,ENT_NOQUOTES,'UTF-8');
             $string = str_replace('&euro;',chr(128),$string);
              //$string = str_replace('<br>',',',$string);
                   $string = html_entity_decode($string,ENT_NOQUOTES,'ISO-8859-15');
                   $string = strip_tags($string);
                   $string = htmlspecialchars($string,ENT_QUOTES);
             return $string;
          }
      
?>