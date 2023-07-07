<!DOCTYPE html>
<html>
<head>
	<title>Submit Form using AJAX and jQuery</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<form id="contact-form" method="post">

<div class="container mt-5">
<div class="card">
<div class="card-body">

<h5 class="mb-3">Contact Us</h5>
<hr/>
<div  class="form-group">
			<label for="name">Name:</label>
			<input class="form-control" type="text" id="name" name="name" required>
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input  class="form-control" type="email" id="email" name="email" required>
		</div>

        <div class="form-group">
			<label for="email">phone:</label>
			<input class="form-control" type="number" id="phone" name="phone" required>
		</div>

		<div class="form-group">
			<label for="message">Message:</label>
			<textarea class="form-control" id="message" name="message" required></textarea>
		</div>
        <br/>
		<div class="g-recaptcha" data-sitekey="6LdLMeklAAAAAPbM2A-B2JTW-Yvek_nrC6hqQukO"></div>
		<button  class="btn btn-primary mt-2" type="submit">Send Message</button>

</div>
</div>
</div>
</form>
	
    <div id="result">

    </div>

	<script>
		$(document).ready(function() {
			$('#contact-form').submit(function(e) {
				e.preventDefault();

				// Validate reCAPTCHA
				var response = grecaptcha.getResponse();
				if (response.length === 0) {
					alert("Please verify that you're not a robot.");
					return false;
				}

				// Get form data
				var name = $('#name').val();
				var email = $('#email').val();
				var message = $('#message').val();
				var phone = $('#phone').val();

				// Send AJAX request
				$.ajax({
					url: 'submit-form.php',
					type: 'post',
					data: {name: name,phone:phone, email: email, message: message,captchaResponse: response},
					success: function(response) {
						$("#result").html(response);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						// Handle error response
						alert('Error: ' + errorThrown);
					}
				});
			});
		});
	</script>
</body>
</html>
