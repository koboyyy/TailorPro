<?php
$source = "../resources/views/hasilkan-pola/index.blade.php";
$lines = file($source);
$dir = "../resources/views/hasilkan-pola/partials";
if (!is_dir($dir)) mkdir($dir, 0777, true);
file_put_contents("$dir/header.blade.php", implode("", array_slice($lines, 6, 42)));
file_put_contents("$dir/garment-selector.blade.php", implode("", array_slice($lines, 52, 56)));
file_put_contents("$dir/customer-selector.blade.php", implode("", array_slice($lines, 109, 120)));
file_put_contents("$dir/fabric-estimation.blade.php", implode("", array_slice($lines, 230, 14)));
file_put_contents("$dir/canvas-viewer.blade.php", implode("", array_slice($lines, 246, 91)));
file_put_contents("$dir/modals.blade.php", implode("", array_slice($lines, 341, 40)));
file_put_contents("$dir/pattern-scripts.blade.php", implode("", array_slice($lines, 383)));
echo "SUCCESS";
