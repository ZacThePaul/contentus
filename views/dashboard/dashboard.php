<?php include('views/partials/header.php'); ?>

<body>

    <h1>WELCOME TO YOUR DASHBOARD <span id="username"></span></h1>

    <h2>Here are your blog posts</h2>

</body>

    <script type="text/javascript">

        let user = $.ajax({
            url: 'apihandler.php?class=Database&method=select',
            type: 'GET',
            success: function(data) {
                let user = JSON.parse(data);
                $('#username').text(user.name);
            }
        });

    </script>

<?php
include('views/partials/footer.php');