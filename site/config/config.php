<?php
return [
    'debug' => true,
    'email' => [
      'transport' => [
          'type' => 'smtp',
          'host' => 'localhost', // Change this to your SMTP server host if necessary
          'port' => 1025, // Change this to your SMTP server port if necessary (MailHog default port is 1025)
          'security' => null, // Options are 'ssl', 'tls', or null
          'auth' => false, // Set to true if your SMTP server requires authentication
          'username' => '', // Your SMTP username if 'auth' is true
          'password' => '', // Your SMTP password if 'auth' is true
      ],
  ],
  ];
?>

                                       
