<?php

$data = file_get_contents( "php://input" ); //$data is now the string '[1,2,3]';

$data = json_decode( $data ); //$data is now a php array array(1,2,3)



echo '<pre>'; print_r($data); echo '</pre>';

?>