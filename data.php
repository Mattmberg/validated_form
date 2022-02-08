<!DOCTYPE HTML>  
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php
$firstNameErr = $lastNameErr = $phoneErr = $emailErr = $promoErr = "";
$firstName =  $lastName = $phone = $email =  $promo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstName"])) {
    $firstNameErr = "First Name is required";
  } else {
    $firstName = test_input($_POST["firstName"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
      $firstNameErr = "Only letters and white space are allowed";
    }
  }

  if (empty($_POST["lastName"])) {
    $lastNameErr = "Last name is required";
  } else {
    $lastName = test_input($_POST["lastName"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
      $lastNameErr = "Only letters and white space are allowed";
    }
  }
  
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = test_input($_POST["phone"]);
    if (!preg_replace("/[^\d]/", "", $phone)) {
      $phoneErr = "Invalid phone number format";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["promo"])) {
    $promoErr = "Promo Code is required unless you enter How did you hear";
  } else {
    $promo = test_input($_POST["promo"]);
    if (!preg_replace("/[^a-zA-Z0-9]+/", "", $promo)) {
      $promoErr = "Invalid promo code format";
    }
  }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

<br>

<div class="form">
<h2>Registration Form</h2>
<p><span class="required-label">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    First Name: <input type="text" name="firstName" id="firstName" maxlength="30" value="<?php echo $firstName;?>" required><span class="required-label"> *</span>
    <span><?php echo $firstNameErr;?></span><br><br>
    Last Name:<input type="text" name="lastName" id="lastName" maxlength="30" value="<?php echo $lastName;?>"  required><span class="required-label"> *</span>
    <span><?php echo $lastNameErr;?></span><br><br>
    Phone: <input type="text" name="phone" maxlength="30" value="<?php echo $phone;?>"  required><span class="required-label"> *</span>
    <span><?php echo $phoneErr;?></span><br><br>
    Email:<input type="text" name="email" id="email" maxlength="50" value="<?php echo $email;?>"  required><span class="required-label"> *</span><br>
    <span><?php echo $emailErr;?></span><br><br>
    Promo Code: <input type="text" name="promo" maxlength="7" value="<?php echo $promo;?>" >
    <span><?php echo $promoErr;?></span><br><br>
    How did you hear: <select name= <?php $howDidYouHear ?> id="howDidYouHear">
        <option value="blank"></option>
        <option value="socialMedia">Social Media</option>
        <option value="friend">From a friend</option>
        <option value="referenceEmail">Email</option>
        <option value="other" input type="text" maxlength="255">Other</option>
    </select><br><br>
    <input type="checkbox" id="" name="" value="" required>
    <label for=""></label><span class="required-label"> *</span><br><br>
    <input type="submit" name="submit" value="submit">
</form>
</div>

<div class="footer">
    <p></p>
</div>

</body>
</html>
