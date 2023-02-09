<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Change DNS Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container" style="margin-top: 50px;">
      

<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // The updated data for the DNS record
    $data = [
        "type" => $_POST['type'],
        "name" => $_POST['name'],
        "data" => $_POST['data'],
        "ttl" => (int) $_POST['ttl']
    ];
    
    // Update the DNS record
    $url = "https://api.godaddy.com/v1/domains/" . $domain . "/records/" . $_POST['type'] . "/" . $_POST['name'];
    
    $ch = curl_init();
    
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: sso-key " . $apiKey . ":" . $apiSecret,
            "Accept: application/json",
            "Content-Type: application/json"
        ],
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => json_encode($data)
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    // Check if the API call was successful
    if ($httpCode == 200) {
        echo "The DNS record was updated successfully.";
    } else {
        echo "An error occurred while updating the DNS record.";
    }
} else {
    // Display the form to update a DNS record
    echo "<center><h1>Change DNS Records</h1></center>";
    echo "
        <form method='post'>
          <div class='form-group'>
            <label>Type:</label>
            <input type='text' class='form-control' name='type' required>
          </div>
          <div class='form-group'>
            <label>Name:</label>
            <input type='text' class='form-control' name='name' required>
          </div>
          <div class='form-group'>
            <label>Value:</label>
            <input type='text' class='form-control' name='value' required>
          </div>
          <div class='form-group'>
            <label>New Value:</label>
            <input type='text' class='form-control' name='new_value' required>
          </div>
          <input type='submit' class='btn btn-primary' value='Change'>
        </form>
    </div>
  </body>
</html>
";
}
?>
