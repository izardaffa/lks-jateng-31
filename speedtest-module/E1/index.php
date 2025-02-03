<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $xmlInput = $_POST["xmlInput"] ?? "";
    $jsonData = xmlToJson($xmlInput);
} else {
    $jsonData = "";
}

function xmlToJson($xmlString) {
    // Load XML string into a SimpleXMLElement object
    $xmlObject = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
    
    if ($xmlObject === false) {
        return json_encode(["error" => "Invalid XML format"]);
    }
    
    // Convert XML object to JSON
    return json_encode($xmlObject, JSON_PRETTY_PRINT);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>XML2JSON Converter</title>
</head>
<body>
    <h2>XML to JSON Converter</h2>
    <form method="POST">
        <textarea name="xmlInput" rows="10" cols="50" placeholder="Masukkan XML di sini..."><?php echo htmlspecialchars($_POST['xmlInput'] ?? ''); ?></textarea>
        <br>
        <button type="submit">Convert</button>
    </form>
    <h3>Hasil JSON:</h3>
    <textarea rows="10" cols="50" readonly><?php echo $jsonData; ?></textarea>
</body>
</html>