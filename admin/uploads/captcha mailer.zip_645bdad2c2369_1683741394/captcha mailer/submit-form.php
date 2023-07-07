<?php
use PHPMailer\PHPMailer\PHPMailer;
// use 'PHPMailer/PHPMailer.php';
use PHPMailer\PHPMailer\Exception;
// use 'PHPMailer/SMTP.php';

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $recp =  $_POST['captchaResponse'];
    $key  = "6LdLMeklAAAAACy_59HuBQZWIQW1owNX5l4GChAp";
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$key.'&response='.$recp;

    $response = file_get_contents($url);
    $response_Keys = json_decode($response,true);

    if ($response_Keys['success']){

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'khalidbaga222@gmail.com';
        $mail->Password = 'fcagigsqmxkhgjjj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
    
    
        $mail->setFrom('khalidbaga222@gmail.com', 'Khalid');
        $mail->addAddress('f2ah2ad2@gmail.com', 'Fahad Ali Khan');
    
    
        $mail->Subject = 'Contact Form Submission';
        $mail->Body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
    
        // Send email
        $mail->send();
    
        echo '
        <div class="message-sent">
<div class="message-sent-content">
<i class="fa fa-check-circle"></i>
<p>Message sent!</p>
</div>
</div>


<style>

#contact-form{
display:none;
}
.message-sent {
position: fixed;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
background-color: #00C851;
color: #fff;
padding: 20px;
border-radius: 5px;
box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
/* visibility: hidden; */
/* opacity: 0; */
transition: visibility 0s, opacity 0.5s ease-in-out;
}

.message-sent.show {
visibility: visible;
opacity: 1;
}

.message-sent-content {
display: flex;
align-items: center;
}

.message-sent-content i {
font-size: 24px;
margin-right: 10px;
}

.message-sent-content p {
font-size: 18px;
font-weight: bold;
margin: 0;
}

/* Keyframe animation for message sent */
@keyframes message-sent-animation {
0% { transform: scale(0); opacity: 0; }
50% { transform: scale(1.2); opacity: 1; }
100% { transform: scale(1); opacity: 1; }
}


</style>


<script>
// Show message sent animation
function showMessageSent() {
var messageSent = document.querySelector(".message-sent");
messageSent.classList.add("show");

// Remove message sent animation after 3 seconds
setTimeout(function() {
messageSent.classList.remove("show");
}, 1000);
}

</script>
        
        ';

}


	
}
?>
