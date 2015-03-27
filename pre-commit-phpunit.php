<?php
echo PHP_EOL;

// output a little introduction
echo '>> Starting unit tests' . PHP_EOL;

// get the name for this project; probably the topmost folder name
$projectName = basename(getcwd());

// execute unit tests (it is assumed that a phpunit.xml configuration is present 
// in the root of the project)
exec('phpunit', $output, $returnCode); // cwd is assumed here

// if the build failed, output a summary and fail
if ($returnCode !== 0) {

    // find the line with the summary; this might not be the last
    while (($minimalTestSummary = array_pop($output)) !== null) {
        if (strpos($minimalTestSummary, 'Tests:') !== false) {
            break;
        }
    }

    // output the status
    echo '>> Test suite for ' . $projectName . ' failed:' . PHP_EOL;
    echo $minimalTestSummary;
    echo chr(27) . '[0m' . PHP_EOL; // disable colors and add a line break
    echo PHP_EOL;

    // abort the commit
    exit(1);
}

echo '>> All tests for ' . $projectName . ' passed.' . PHP_EOL;
echo PHP_EOL;
exit(0);