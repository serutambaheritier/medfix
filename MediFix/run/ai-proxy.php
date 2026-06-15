<?php
header('Content-Type: application/json');

// In a real scenario, this would be in a config file or environment variable
$apiKey = 'YOUR_OPENAI_API_KEY_HERE';

// Enable mock mode for testing if no API key is provided or if requested via parameter
$isMockMode = ($apiKey === 'YOUR_OPENAI_API_KEY_HERE') || (isset($_GET['mock']) && $_GET['mock'] === 'true');

if ($isMockMode) {
    // Sample response for a technician
    $mockResponse = [
        'choices' => [
            [
                'message' => [
                    'content' => "<b><u>Potential Cause</u></b><br>
The most likely cause for the reported issue is a faulty power supply unit (PSU) or a blown fuse within the equipment's internal circuit board. This often occurs after power surges or long periods of continuous operation.<br><br>

<b><u>Proposed Solution</u></b><br>
1. **Safety First**: Disconnect the equipment from the main power source.<br>
2. **Check Fuses**: Open the access panel and inspect the primary fuses. Replace any blown fuses with the exact same rating.<br>
3. **Voltage Test**: Use a multimeter to check if the PSU is outputting the correct voltage according to the service manual.<br>
4. **Capacitor Inspection**: Look for any bulging or leaking capacitors on the motherboard, which might indicate a need for a board-level repair.<br>
5. **Reassemble and Test**: Once the suspected component is replaced, reconnect and perform a functional test."
                ]
            ]
        ]
    ];
    echo json_encode($mockResponse);
    exit;
}

// Real OpenAI API call
$input = json_decode(file_get_contents('php://input'), true);

$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
