<?php
$source = file_get_contents(__DIR__ . '/resources/views/hasilkan-pola/partials/pattern-scripts.blade.php');
$target = file_get_contents(__DIR__ . '/resources/views/arsip-pola/index.blade.php');

// Extract complex logic from pattern-scripts.blade.php
$startStr = "} else if (activeType === 'CELANA') {";
$endStr = "wrapper.innerHTML = svgHTML;";

$startPos = strpos($source, $startStr);
$endPos = strpos($source, $endStr, $startPos);

$complexLogic = substr($source, $startPos, $endPos - $startPos);
// Replace `activeType` with `activePattern.type` in the complex logic (only for the conditions)
$complexLogic = str_replace("activeType === 'CELANA'", "activePattern.type === 'CELANA'", $complexLogic);
$complexLogic = str_replace("activeType === 'ROK'", "activePattern.type === 'ROK'", $complexLogic);
$complexLogic = str_replace("activeType === 'GAMIS'", "activePattern.type === 'GAMIS'", $complexLogic);
$complexLogic = str_replace("activeType === 'WANITA'", "activePattern.type === 'WANITA'", $complexLogic);

// In arsip-pola/index.blade.php
$targetStartStr = "} else if (activePattern.type === 'CELANA') {";
$targetEndStr = "wrapper.innerHTML = svgHTML;";

$targetStartPos = strpos($target, $targetStartStr);
$targetEndPos = strpos($target, $targetEndStr, $targetStartPos);

$newTarget = substr($target, 0, $targetStartPos) . $complexLogic . substr($target, $targetEndPos);

// Define selectedCustomer at the top of renderSVGDetail
$newTarget = str_replace(
    "let svgHTML = '';\n\n                if (activePattern.type === 'KEMEJA' || activePattern.type === 'BAJU') {\n                    const selectedCustomer = activePattern.ukuran || activePattern;",
    "let svgHTML = '';\n                const selectedCustomer = activePattern.ukuran || activePattern;\n\n                if (activePattern.type === 'KEMEJA' || activePattern.type === 'BAJU') {",
    $newTarget
);

file_put_contents(__DIR__ . '/resources/views/arsip-pola/index.blade.php', $newTarget);
echo "Fix applied successfully.\n";
