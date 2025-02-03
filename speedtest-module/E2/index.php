<?php
// Membaca file JSON
$jsonData = file_get_contents('result.json');
$data = json_decode($jsonData, true);

// Inisialisasi variabel
$sentMessages = [];
$receivedMessages = [];
$sentWordCount = [];
$totalSentLength = 0;
$totalReceivedLength = 0;

// Fungsi untuk menghapus karakter non-huruf
function cleanWord($word) {
    return preg_replace('/[^a-zA-Z0-9]+/', '', $word);
}

// Memproses data pesan
foreach ($data['messages'] as $message) {
    if ($message['from'] !== 'Bot') {
        $sentMessages[] = $message['text'];
        $words = explode(" ", strtolower($message['text']));
        foreach ($words as $word) {
            $cleanedWord = cleanWord($word);  // Menghapus karakter non-huruf
            if ($cleanedWord !== '') {
                $sentWordCount[$cleanedWord] = ($sentWordCount[$cleanedWord] ?? 0) + 1;
            }
        }
        $totalSentLength += strlen($message['text']);
    } else {
        $receivedMessages[] = $message['text'];
        $words = explode(" ", strtolower($message['text']));
        foreach ($words as $word) {
            $cleanedWord = cleanWord($word);  // Menghapus karakter non-huruf
            if ($cleanedWord !== '') {
                $sentWordCount[$cleanedWord] = ($sentWordCount[$cleanedWord] ?? 0) + 1;
            }
        }
        $totalSentLength += strlen($message['text']);
        $totalReceivedLength += strlen($message['text']);
    }
}

// Menghitung hasil analisis
arsort($sentWordCount);
$top5Words = array_slice($sentWordCount, 0, 5, true);
$totalSent = count($sentMessages);
$totalReceived = count($receivedMessages);
$avgSentLength = $totalSent > 0 ? $totalSentLength / $totalSent : 0;
$avgReceivedLength = $totalReceived > 0 ? $totalReceivedLength / $totalReceived : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Analytics</title>
</head>
<body>
    <ul>
        <li>Top 5 sent words:</li>
        <ul>
            <?php foreach ($top5Words as $word => $count): ?>
                <li><?= htmlspecialchars($word) ?> (<?= $count ?>x)</li>
            <?php endforeach; ?>
        </ul>
        <li>Total messages sent: <?= $totalSent ?></li>
        <li>Total messages received: <?= $totalReceived ?></li>
        <li>Average character length sent: <?= (int) $avgSentLength ?></li>
        <li>Average character length received: <?= (int) $avgReceivedLength ?></li>
    </ul>
</body>
</html>