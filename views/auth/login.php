<?php
?>

<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
</script>

<h1>Welcome to the login page</h1>

<form method="post"  id="loginForm">

    <h2>Login Here</h2>

    <input type="email" placeholder="Email" name="email" id="loginEmail">
    <input type="password" placeholder="password" name="password" id="loginPassword">

    <input type="submit" value="Submit" id="loginSubmit" onclick="return loginUser(event)">

</form>

<script src="js/test.js"></script>
