<form action='options.php' method='post'>
  <section id="introduction" class="wrap about-description">
    <h1><?= timetable_wp_options_title(); ?></h1>
    <p><?= timetable_wp_description(); ?></p>

    <?php
      settings_fields( 'pluginPage' );
      do_settings_sections( 'pluginPage' );
      submit_button();
    ?>

  </section>
</form>
<?php
  the_widget( 'wp_timetable_widget' );
?>
