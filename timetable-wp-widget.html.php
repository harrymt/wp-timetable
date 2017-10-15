<?php
/**
 * Markup for the Timetable widget.
 * Found in timetable-wp-widget.php.
 *
 */

?>

<?php

  $headings = array(
    "Tutor",
    "Mr A",
    "Mrs B"
  );

  $second_headings = array(
    "Room",
    "Location 1",
    "Location 2"
  );


  $times = array(
    '0900' => array(
      "red" => "Chamber Orchestra",
      "pink" => "COSYJO"
    ),
    '0915' => array(
      "red" => "Chamber Orchestra",
      "pink" => "COSYJO"
    ),
    '0930' => array(
      "green" => "Intermediate Strings",
      "pink" => "COSYJO"
    ),
    '0945' => array(
      "" => "",
      "pink" => "COSYJO"
    )
  );
?>


<table class="timetable-table">
  <tbody>
  <tr>
    <?php foreach ($headings as $th):?>
      <th><?= $th ?></th>
    <?php endforeach; ?>
  </tr>
  <tr>
    <?php foreach ($second_headings as $td):?>
      <td><?= $td ?></td>
    <?php endforeach; ?>
  </tr>
  <?php foreach ($times as $the_time => $the_session):?>
  <tr>
    <td><?= $the_time ?></td>
    <?php foreach ($the_session as $color => $name):?>
      <td <?= $color == "" ? '' : 'class="tt-' . $color . '"'?>>
        <?= $name ?>
      </td>
    <?php endforeach; ?>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>