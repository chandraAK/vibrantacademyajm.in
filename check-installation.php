<?php
// Save as check-installation.php in your project root and run in browser

echo "<h2>CodeIgniter 4 Installation Check</h2>";

$checks = [
    'app/Config/Paths.php' => __DIR__ . '/app/Config/Paths.php',
    'system/Config/BaseConfig.php (ZIP)' => __DIR__ . '/system/Config/BaseConfig.php',
    'vendor/codeigniter4/framework/system/Config/BaseConfig.php (Composer)' => __DIR__ . '/vendor/codeigniter4/framework/system/Config/BaseConfig.php',
    'spark' => __DIR__ . '/spark',
    'public/index.php' => __DIR__ . '/public/index.php',
];

foreach ($checks as $name => $path) {
    $exists = file_exists($path);
    $status = $exists ? '✅ EXISTS' : '❌ MISSING';
    $color = $exists ? 'green' : 'red';
    echo "<p style='color: $color'><strong>$status:</strong> $name</p>";
    if ($exists && strpos($name, 'Paths.php') !== false) {
        echo "<pre>";
        $content = file_get_contents($path);
        preg_match('/systemDirectory.*=.*\'([^\']+)\'/', $content, $matches);
        if ($matches) {
            echo "Current systemDirectory path: " . $matches[1] . "\n";
            echo "Resolved path: " . realpath(__DIR__ . '/' . $matches[1]) . "\n";
        }
        echo "</pre>";
    }
}