<?php

	require 'FractionsToWords.php';
	$FractionsToWords = new FractionsToWords();
	
	// Example fractions
	echo '<pre>';
	echo $FractionsToWords->convert('1/2') . "\n";			// one-half
	echo $FractionsToWords->convert('3/2') . "\n";			// three-halves
	echo $FractionsToWords->convert('17/2') . "\n";			// seventeen-halves
	echo $FractionsToWords->convert('1/3') . "\n";			// one-third
	echo $FractionsToWords->convert('2/3') . "\n";			// two-thirds
	echo $FractionsToWords->convert('1/4') . "\n";			// one-fourth
	echo $FractionsToWords->convert('3/4') . "\n";			// three-fourths
	echo $FractionsToWords->convert('2/15') . "\n";			// two-fifteenths
	echo $FractionsToWords->convert('4/21') . "\n";			// four twenth-firsts
	echo $FractionsToWords->convert('3/20') . "\n";			// three-twentieths
	echo $FractionsToWords->convert('2/578') . "\n";		// two five hundred seventy-eighths
	echo $FractionsToWords->convert('235/3406') . "\n";		// two hundred thirty-five three thousand four hundred-sixths
	echo $FractionsToWords->convert('5 1/4') . "\n";		// 5 and one-fourth
	
	// Test invalid fractions
	echo $FractionsToWords->convert('5 1/4 1/2') . "\n";	// Invalid fraction (returns original string)
	echo $FractionsToWords->convert('523') . "\n";			// Invalid fraction (returns original string)
	
	echo '</pre>';

?>