<form action='options.php' method='post'>
  <section id="introduction" class="wrap about-description">
    <h1><?= timetable_options_title(); ?></h1>
    <p><?= timetable_description(); ?></p>

    <?php
      settings_fields( 'pluginPage' );
      do_settings_sections( 'pluginPage' );
      $color_options = array(
        'red',
        'green',
        'pink',
        'blue',
        'orange',
        'brown',
        'purple',
        'yellow',
        'darkgrey',
        'lightbrown',
        'darkblue'
      );
      ?>

      <details>
      <summary class="timetable-summary">Color options</summary>
      <ul>
        <?php foreach ($color_options as $color): ?>
          <li style="display:flex;width:100px;justify-content: space-between;">
            <span><?= $color ?></span>
            <span>
              <span class="tt-<?= $color ?>" style="border-radius: 2px;padding-right: 20px;padding-left: 10px;"></span>
            </span>
          </li>
        <?php endforeach; ?>
      </ul>
    </details>

    <?php
      submit_button();
    ?>

  </section>
</form>
<?php
  the_widget( 'timetable_widget' );
?>
