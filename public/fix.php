<?php
$file = '/home/evo/Desktop/TailorPro/resources/views/arsip-pola/index.blade.php';
$lines = file($file);
$new_lines = [];
foreach ($lines as $i => $line) {
    $line_num = $i + 1;
    if ($line_num >= 684 && $line_num <= 979) {
        continue;
    }
    $new_lines[] = $line;
}
file_put_contents($file, implode("", $new_lines));
echo "Lines deleted successfully.\n";
