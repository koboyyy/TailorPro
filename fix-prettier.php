<?php

// Restore the file to the state before Prettier messed it up (from the last git commit)
exec('git checkout resources/views/shared/pattern-svg-core.blade.php');

$filePath = __DIR__ . '/resources/views/shared/pattern-svg-core.blade.php';
$content = file_get_contents($filePath);

// Add prettier-ignore so Prettier doesn't format this file again
if (strpos($content, '<!-- prettier-ignore -->') === false) {
    $content = "<!-- prettier-ignore -->\n" . $content;
    file_put_contents($filePath, $content);
}

echo "Berhasil mengembalikan format asli dan menambahkan aturan prettier-ignore!\n";
