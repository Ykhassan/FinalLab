
<?php 
$sanatizedEmail = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
$validatedEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

echo "<P> is Sanatized: $sanatizedEmail 
     is Validated: $validatedEmail </p>
";
