< <section id="booking" class=booking>
        <h1><?= $data->title() ?></h1>
        <!--
                <script type="text/javascript" src="https://form.jotform.com/jsform/240322410834040"></script>
        
-->
</section>


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// session_start(); // Start the session at the beginning of the script

require 'vendor/autoload.php'; // Adjust the path as necessary

$success = false;
$error = false;

// Generate CSRF token and store it in session if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $csrf_token_post = $_POST['csrf_token'];

    // Validate form data
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $csrf_token_post !== $_SESSION['csrf_token']) {
        $error = true;
    } else {
        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'localhost'; // Specify your SMTP server
            $mail->Port = 1025; // Adjust port if using MailHog or another SMTP server
            $mail->SMTPAuth = false; // Set to true if SMTP server requires authentication

            //Recipients
            $mail->setFrom($email);
            $mail->addAddress('youremail@example.com'); // Replace with your email address

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Submission';
            $mail->Body    = "<html><body>
                             <p>You have received a new message from your website contact form.</p>
                             <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                             <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                             <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
                             </body></html>";

            $mail->send();
            $success = true;
            // Regenerate CSRF token after successful form submission
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } catch (Exception $e) {
            $error = true;
        }
    }
}
?>


<main>
  <h1>Contact Us</h1>
  
  <?php if ($success): ?>
    <p>Thank you for your message!</p>
  <?php elseif ($error): ?>
    <p>There was an error sending your message. Please try again.</p>
  <?php endif ?>

  <form method="post" action="<?= $page->url() ?>">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">

    <label for="message">Message:</label>
    <textarea id="message" name="message" required><?= isset($message) ? htmlspecialchars($message) : '' ?></textarea>

    <button type="submit" name="submit" value="submit">Send</button>
  </form>
</main>


<?

