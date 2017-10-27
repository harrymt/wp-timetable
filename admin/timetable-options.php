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
      <summary>Color options</summary>
      <ul>
        <?php foreach ($color_options as $color): ?>
          <li><?= $color ?></li>
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
