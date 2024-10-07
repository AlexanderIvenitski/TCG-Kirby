<?php
snippet('header');

foreach($pages->listed() as $section) {
  if ($section->uid() === 'contact') {
    snippet('contact'); // Include the contact form snippet
  } else {
    snippet($section->uid(), ['data' => $section]);
  }
}

snippet('footer');
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var form = document.getElementById('contact-form');
  if (form) {
    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission

      var formData = new FormData(form);
      var xhr = new XMLHttpRequest();

      xhr.open('POST', form.getAttribute('action'), true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onload = function() {
        var response = JSON.parse(xhr.responseText);
        var messageContainer = document.createElement('p');
        messageContainer.textContent = response.message;

        if (response.success) {
          messageContainer.classList.add('success-message');
        } else {
          messageContainer.classList.add('error-message');
        }

        form.appendChild(messageContainer);
        form.reset(); // Reset form fields after submission
      };

      xhr.onerror = function() {
        console.error('Error occurred while sending the request.');
      };

      xhr.send(formData);
    });
  } else {
    console.error('Contact form not found.');
  }
});
</script>

<?= js('@auto') ?>
