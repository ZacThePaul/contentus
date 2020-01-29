<?php

global $database;

$menu_items = $database->select_item('menu_items', 'con_menu', 'menu_name', 'con_core_menu');
$menu_class = $database->select_item('class_names', 'con_menu', 'menu_name', 'con_core_menu')[0];

$array_items = unserialize($menu_items[0])

?>

<div id="admin-bar">

    <h3 style="text-align: center;">Contentus</h3>

    <ul>

        <?php foreach ($array_items as $item) : ?>

            <li class="<?= $menu_class; echo $_SESSION['slug'] === $item ? ' active-menu' : $_SESSION['slug'] . $item?>">
                <a href="<?= $item ?>"> <?= $item ?> </a>
            </li>

        <?php endforeach; ?>

        <li class="con-menu-items">
            <a href="logout">logout</a>
        </li>

    </ul>

    <div>
        <i class="fa fa-plus-square"></i>
    </div>

</div>
