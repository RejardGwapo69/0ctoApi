<?php

// Path to your JSON file
$jsonFile = 'imongmama.json';

// Read JSON file
$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);

// Handle URL parameters
if (isset($_GET['add'])) {
    // Add a new user ID
    $newUserID = $_GET['add'];

    // Check if user ID already exists
    if (!in_array($newUserID, $data['ChatWithAiOfficialUserIDs'])) {
        $data['ChatWithAiOfficialUserIDs'][] = $newUserID;

        // Save updated JSON data
        $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($jsonFile, $updatedJsonData);

        echo "User ID $newUserID added successfully.";
    } else {
        echo "User ID $newUserID is already registered.";
    }
} elseif (isset($_GET['delete'])) {
    // Delete a user ID
    $deleteUserID = $_GET['delete'];
    $index = array_search($deleteUserID, $data['ChatWithAiOfficialUserIDs']);
    if ($index !== false) {
        unset($data['ChatWithAiOfficialUserIDs'][$index]);

        // Save updated JSON data
        $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($jsonFile, $updatedJsonData);

        echo "User ID $deleteUserID deleted successfully.";
    } else {
        echo "User ID $deleteUserID not found.";
    }
}

?>