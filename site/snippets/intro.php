<section id="intro" class=intro>
        <div class="pseudo-relative">
                <h1><?= $data->title() ?></h1>
        </div>
        <div class="wrapper">
                <?php foreach($data->children() as $topic): ?>
                <div class="item">
                        <h3><?= $topic->title() ?></h3>
                        <p><?= $topic->text() ?></p>
                </div>
                <?php endforeach ?>
        </div>
</section>