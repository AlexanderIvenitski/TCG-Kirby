  </main>

  <footer class="footer">
    <div class="grid">
      <div class="column" style="--columns: 3">
      <?= $site->image()?>
    
      
        <h3> <?= $site->title() ?> </h3>
        <p><?= $site->title() ?></p>
        <p><?= $site->email() ?></p>

      </div>
      <div class="column" style="--columns: 3">
        <div>
          <p><?= $site->street() ?></p>
          <p><?= $site->city() ?></p>
          <p><?= $site->country() ?></p>
        </div>
      </div>
      <div class="column" style="--columns: 2">
        <ul>
          <?php foreach ($site->children()->listed() as $example): ?>
          <li><a href="<?= $example->url() ?>"><?= $example->title()->esc() ?></a></li>
          <?php endforeach ?>
        </ul>
        </ul>
      </div>
      <div class="column" style="--columns: 2">
        <a href="https://www.instagram.com/tcg.tattoo/" target="_blank">Instagram</a>
      </div>
      <div class="column" style="--columns: 2">
      <?php $datenschutz = page("datenschutz")?>
        <a href="<?= $datenschutz->url() ?>">Datenschutz</a>
        <h3>Datenschutz & Impressum</h3>
      </div>
    </div>
  </footer>

</body>
</html>
