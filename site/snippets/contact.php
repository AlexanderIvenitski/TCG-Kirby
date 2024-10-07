<!-- site/snippets/contact.php -->

<?php
session_start(); // Start the session at the beginning of the script

$success = false;
$error = false;
$response = [];

// Generate CSRF token and store it in session if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Validate and sanitize form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    $csrf_token_post = $_POST['csrf_token'];

    // Validate form data
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $csrf_token_post !== $_SESSION['csrf_token']) {
        $response = ['success' => false, 'message' => 'Please fill in all fields correctly.'];
    } else {
        // Send email using Kirby email plugin
        $emailSent = email([
            'to' => 'youremail@example.com', // Replace with your email address
            'from' => $email,
            'subject' => 'New Contact Form Submission',
            'body' => "<html><body>
                        <p>You have received a new message from your website contact form.</p>
                        <p><strong>Name:</strong> {$name}</p>
                        <p><strong>Email:</strong> {$email}</p>
                        <p><strong>Message:</strong><br>{$message}</p>
                        </body></html>",
            'contentType' => 'text/html',
        ]);

        // Check if email was sent successfully
        if ($emailSent->isSent()) {
            $success = true;
            $response = ['success' => true, 'message' => 'Thank you for your message!'];
            // Regenerate CSRF token after successful form submission
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } else {
            $error = true;
            $response = ['success' => false, 'message' => 'There was an error sending your message. Please try again.'];
        }
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>

<form id="contact-form" method="post" action="<?= $page->url() ?>">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

    <?php if ($success): ?>
        <p class="success-message">Thank you for your message!</p>
    <?php elseif ($error): ?>
        <p class="error-message">There was an error sending your message. Please try again.</p>
    <?php endif ?>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">

    <label for="message">Message:</label>
    <textarea id="message" name="message" required><?= isset($message) ? htmlspecialchars($message) : '' ?></textarea>

    <button type="submit" name="submit">Send</button>
</form>
