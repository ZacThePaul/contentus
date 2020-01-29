<?php
$user = $_SESSION['user'];
?>
<div id="dashboard-container">

    <?php include('partials/admin-bar.php') ?>

    <div id="dashboard-content">

        <div class="inner-dashboard">

            <div class="long-dashboard">

                <h2>Welcome to your <?= $_SESSION['slug'] ?>, <?= $user->name ?></h2>

                <form action="" class="search-form">
                    <input type="text" class="search-bar" placeholder="Search your site...">
                    <i class="fa fa-search search-icon"></i>
                </form>



            </div>

        </div>

    </div>

</div>