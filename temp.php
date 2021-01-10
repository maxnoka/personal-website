<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

// outputs the username that owns the running php/httpd process
// (on a system with the "whoami" executable in the path)
$output=null;
$retval=null;

$command = './futoshiki-solver ';
$command .= "\"0,0,0,0\n0,0,0,2\n0,0,0,0\n0,0,0,0\" "; 
$command .= "\"0,0:0,1:>\n0,2:0,3:<\n1,1:1,2:<\n2,2:2,3:<\" ";

exec($command, $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);