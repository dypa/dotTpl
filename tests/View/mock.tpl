<?php echo $foo; ?> + <?php echo $bar; ?> = <?php echo $_(function($foo, $bar) {return $foo + $bar;}, $foo, $bar); ?>
