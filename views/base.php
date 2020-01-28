<!DOCTYPE html>
<html lang="en">

<head>

    <title>Contentus - <?= $_SESSION['slug'] ?></title>

</head>

<body>

    <?php get_header(); ?>

    <?php include "" . $_SESSION['filename'] . ""; ?>

    <?php get_footer(); ?>

</body>






