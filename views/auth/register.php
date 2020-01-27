<?php
?>



<h1>Welcome to the registration page</h1>

<form method="post" id="registerForm">

    <h2>Register Here</h2>

    <input type="text" placeholder="Name" name="name" id="registerName">
    <input type="email" placeholder="Email" name="email" id="registerEmail">
    <input type="password" placeholder="password" name="password" id="registerPassword">

    <input type="submit" value="Submit" id="registerSubmit" onclick="return createUser(event)">

</form>

<script src="js/test.js"></script>
