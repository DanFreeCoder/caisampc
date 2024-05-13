<?php
// Function to verify the entered code with the stored code in the database (replace this with your actual verification logic)
function verifyCode($enteredCode)
{
    global $servername, $username, $password, $dbname;

    // Check the entered code against the stored code in the database
    $conn = new mysqli($servername, $username, $password, $dbname);
    $stmt = $conn->prepare("SELECT email FROM verification_codes WHERE code = ?");
    $stmt->bind_param("s", $enteredCode);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    // If a matching code is found, return the email associated with the code.
    // Otherwise, return false to indicate incorrect code.
    if ($email) {
      return json_encode(array('success' => true, 'email' => $email));
    } else {
      return json_encode(array('success' => false));
    }
}

// Get the data from the AJAX request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['verificationCode'])) {
  // Call the verifyCode function
  $result = verifyCode($data['verificationCode']);

  // Send the response back to the JavaScript code
  echo $result;
} else {
  // Return an error response if the required data is not provided
  echo json_encode(array('success' => false));
}
?>
