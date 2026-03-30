<?php
echo "<h1>CodeIgniter 4.5 Installation Check</h1>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";

$root = __DIR__;
$paths = [
    'system/Boot.php (ZIP install)' => $root . '/system/Boot.php',
    'vendor/codeigniter4/framework/system/Boot.php (Composer)' => $root . '/vendor/codeigniter4/framework/system/Boot.php',
    'app/Config/Paths.php' => $root . '/app/Config/Paths.php',
    'public/index.php' => $root . '/public/index.php',
    'spark' => $root . '/spark',
];

foreach ($paths as $name => $path) {
    $exists = file_exists($path);
    $color = $exists ? 'green' : 'red';
    $status = $exists ? 'EXISTS' : 'MISSING';
    echo "<p style='color: $color'><strong>$status:</strong> $name</p>";
    
    if ($exists && strpos($name, 'Paths.php') !== false) {
        $content = file_get_contents($path);
        preg_match('/systemDirectory\s*=\s*([^;]+);/', $content, $matches);
        if ($matches) {
            echo "<pre>Current setting: " . htmlentities($matches[1]) . "</pre>";
        }
    }
}