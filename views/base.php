<!DOCTYPE html>
<html lang="en">

<head>

    <title>Contentus - <?= $_SESSION['slug'] ?></title>
    <!--    Since every file is loaded through index.php, you don't need to specify any specific route for CSS-->
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <?php echo is_user_logged_in() ? "<link rel='stylesheet' href='css/dashboard/dashboard_style.php' type='text/css'>" : "" ?>

</head>

<body>

    <?php get_header(); ?>

        <?php include "" . $_SESSION['filename'] . ""; ?>

    <?php get_footer(); ?>

</body>






