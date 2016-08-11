<?php
include "counter.php";
?>
<div style="width:150px;">
   <div style="border:1px solid #000000;padding:2px;width:100%;font-size:80%;font-weight:bold;">
      Visitor Statistics
   </div>

   <div style="border:1px solid #000000;padding:2px;width:100%;font-size:80%;">
      &raquo; <?php echo $online; ?> Online<br />   
      &raquo; <?php echo $day; ?> Today<br />
      &raquo; <?php echo $yesterday; ?> Yesterday<br />
      &raquo; <?php echo $week; ?> Week<br />
      &raquo; <?php echo $month; ?> Month<br />
      &raquo; <?php echo $year; ?> Year<br />
      &raquo; <?php echo $all; ?> Total   
   </div>

   <div style="border:1px solid #000000;padding:2px;width:100%;font-size:80%;">
      Record: <?php echo $record; ?> (<?php echo date("d.m.Y", $record_time) ?>)
   </div>
</div>
