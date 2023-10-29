<?php
require_once 'Validator.php';
$errors = [];
if (isset($_POST['submit'])) {
    $validator = new Validator($_POST);
    $errors = $validator->validateForm();

    // here we should store data into database or show a success message
}

?>

<html lang="en">
<head>
    <title>
        Basic Registration Form
    </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   <div class="new-user">
       <h2>
           Login Form
       </h2>
       <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
           <label for="username">Username :</label>
           <input name="username" type="text"  value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
           <div class="errors" >
               <?= isset(   $errors['username'] ) ? $errors['username'] : '' ?>
           </div>
           <label>Email :</label>
           <input name="email" type="text"  value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
           <div class="errors" >
               <?= isset($errors['email'])  ? $errors['email'] : '' ?>
           </div>

           <input type="submit" name="submit" value="submit">

       </form>
   </div>
</body>
</html>
