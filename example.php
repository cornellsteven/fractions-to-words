<?php

	require 'FractionsToWords.php';
	$FractionsToWords = new FractionsToWords();
	
	// Example fractions
	echo '<pre>';
	echo $FractionsToWords->convert('1/2') . "\n";
	echo $FractionsToWords->convert('3/2') . "\n";
	echo $FractionsToWords->convert('17/2') . "\n";
	echo $FractionsToWords->convert('1/3') . "\n";
	echo $FractionsToWords->convert('2/3') . "\n";
	echo $FractionsToWords->convert('1/4') . "\n";
	echo $FractionsToWords->convert('3/4') . "\n";
	echo $FractionsToWords->convert('2/15') . "\n";
	echo $FractionsToWords->convert('4/21') . "\n";
	echo $FractionsToWords->convert('3/20') . "\n";
	echo $FractionsToWords->convert('2/578') . "\n";
	echo $FractionsToWords->convert('235/3406') . "\n";
	echo $FractionsToWords->convert('5 1/4') . "\n";
	echo '</pre>';

?>