<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>List DNS Records</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container" style="margin-top: 50px;">

<?php
      session_start();

      if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
          header("Location: index.php");
      }

      require_once 'config.php';

// Get the list of DNS records
$url = "https://api.godaddy.com/v1/domains/" . $domain . "/records";

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: sso-key " . $apiKey . ":" . $apiSecret,
        "Accept: application/json"
    ]
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

// Check if the API call was successful
if ($httpCode == 200) {
    $dnsRecords = json_decode($response, true);
    
    // Display the list of DNS records in a table
    echo "<center><h1>List DNS Records</h1></center>";
    echo "<table class=\"table table-hover table-bordered\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Type</th>";
    echo "<th>Name</th>";
    echo "<th>Data</th>";
    echo "<th>Priority</th>";
    echo "<th>TTL</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    foreach ($dnsRecords as $record) {
        echo "<tr>";
        echo "<td>" . $record['type'] . "</td>";
        echo "<td>" . $record['name'] . "</td>";
        echo "<td style=\"word-wrap:break-word;max-width:200px;\">" . $record['data'] . "</td>";
        echo "<td>" . $record['priority'] . "</td>";
        echo "<td>" . $record['ttl'] . "</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
    
} else {
    echo "An error occurred while retrieving the DNS records.";
}

?>
    </div>
  </body>
</html>
