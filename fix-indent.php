<?php

$filePath = __DIR__ . '/resources/views/shared/pattern-svg-core.blade.php';
$lines = file($filePath);

foreach ($lines as &$line) {
    preg_match('/^ +/', $line, $matches);
    if (isset($matches[0])) {
        $spaces = strlen($matches[0]);
        
        // If indentation is excessively deep (e.g., > 40 spaces)
        if ($spaces > 40) {
            // Subtract 44 spaces to bring it back, preserving relative indentation
            $newSpaces = $spaces - 44;
            if ($newSpaces < 16) $newSpaces = 16;
            
            $line = str_repeat(' ', $newSpaces) . ltrim($line);
        }
    }
}

file_put_contents($filePath, implode("", $lines));
echo "Indentasi ekstrim pada template SVG berhasil dirapikan!\n";
