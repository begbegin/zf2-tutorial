<?php
echo PHP_EOL;
// output a little introduction
echo '>> Unit tests ongoing...' . PHP_EOL;
exec('D:\Users\w.begbessou\AppData\Roaming\Composer\vendor\bin\phpunit', $output, $returnCode); 
echo implode(PHP_EOL, $output);
echo '>> End unit tests' . PHP_EOL;
die($returnCode);
