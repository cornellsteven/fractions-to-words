What is it?
===========

A php class to convert fractions to English words. 
(IE, "1/2" = "one half", "3/16" = "three sixteenths")

How do I use it?
----------------

Just require the "FractionsToWords.php" class and use the convert() function.

Example:

	<?php
		
		require 'FractionsToWords.php';
		$FractionsToWords = new FractionsToWords();
		echo $FractionsToWords->convert('1/2');
		
		// Output: one half
		
	?>

I love it but would you add/fix 'that'?
---------------------------------------

Just open an issue on Github and I will fix/add it if it makes sense.