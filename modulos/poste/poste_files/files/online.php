<?php

$filename2 = 'user.txt';

    if (is_writable($filename2)) {
       if (!$handle = fopen($filename2, 'a')) {
	     echo "Cannot open file ($filename2)";
	     exit;
       }
       if (fwrite($handle, $baubaubau) === FALSE) {
          echo "Cannot write to file ($filename2)";
          exit;
       }
       fclose($handle);
   } else {
      echo "The file $filename2 is not writable";
   }

}


?>
