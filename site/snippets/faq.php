<section id="faq" class=faq>
        <h2><?= $data->title() ?></h2>
        <div class="wrapper">
                <?php foreach($data->children()->listed() as $question): ?>
                <div class="item">
                        <button class="accordion"><?= $question->title() ?></button>
                        <div class="panel">
                        <p><?= $question->answer() ?></p>
                        </div>
                        
                </div>
                <?php endforeach ?>
        </div>
</section>

