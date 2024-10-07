<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $site->title() ?></title>

        <?= css([
            "assets/css/index.css",
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css",
            "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        ]) ?>
        <?= js("https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js") ?>




    </head>
    <body>  
        <div class="tablet-max">
            <label class="hamburger-menu">
                <input type="checkbox" id="menu-toggle">
            </label>
            <aside class="sidebar">
                <nav class="menu">
                <div class="menu-wrapper">
                    <?php foreach ($site->children()->listed() as $subpage): ?>
                    <!--- 
                    instead of url() use id() here 
                    !-->
                    <a class="item" href="#<?= $subpage ?>" onclick="closeSidebar()"><?= $subpage->title() ?></a>
                    <?php endforeach ?>
                </div>
                </nav>
            </aside>
        </div>
        
        <header class="header desktop-min">
            <nav class="menu">
                <?php foreach ($site->children()->listed() as $subpage): ?>
                <!--- 
                instead of url() use id() here 
                !-->
                <a class="item" href="#<?= $subpage ?>"><?= $subpage->title() ?></a>
                <?php endforeach ?>
            </nav>
        </header>
        

