<?php
function addWatermark($mainImagePath, $watermarkImagePath, $outputImagePath) {
    // Load the main image
    $mainImage = imagecreatefromstring(file_get_contents($mainImagePath));
    if (!$mainImage) {
        die("Gagal memuat gambar utama.");
    }

    // Load the watermark image
    $watermarkImage = imagecreatefromstring(file_get_contents($watermarkImagePath));
    if (!$watermarkImage) {
        die("Gagal memuat gambar watermark.");
    }

    // Get dimensions of main image and watermark
    $mainWidth = imagesx($mainImage);
    $mainHeight = imagesy($mainImage);
    $watermarkWidth = imagesx($watermarkImage);
    $watermarkHeight = imagesy($watermarkImage);

    // Calculate position (top-right corner)
    $destX = $mainWidth - $watermarkWidth - 10; // 10 pixels padding
    $destY = 10; // 10 pixels from top

    // Merge watermark onto main image
    imagecopy($mainImage, $watermarkImage, $destX, $destY, 0, 0, $watermarkWidth, $watermarkHeight);

    // Save the new image
    imagepng($mainImage, $outputImagePath);

    // Free memory
    imagedestroy($mainImage);
    imagedestroy($watermarkImage);
}

// Contoh penggunaan
$mainImage = "image.jpg";
$watermarkImage = "logo.png";
$outputImage = "result.png";

addWatermark($mainImage, $watermarkImage, $outputImage);

echo "Watermark berhasil ditambahkan!";
?>