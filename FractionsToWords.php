<?php

	/**
	* Fractions To Words
	* 
	* Description:
	* Takes a fraction (ie, 1/2) and outputs english words (ie, one-half) 
	*
	* Special thanks to @Lamped (http://www.codingforums.com/archive/index.php/t-180473.html)
	* for direction on converting numbers to ordinal words
	*
	* @author		Cornell Campbell (cornellsteven@gmail.com)
	* @copyright	Copyright 2012 Cornell Campbell
	*/
	class FractionsToWords
	{
		
		private $fraction;
		private $whole_number = false;
		private $numerator;
		private $denominator;
		
		/**
		 * Array of names large numbers
		 * Source: Wikipedia (http://en.wikipedia.org/wiki/Names_of_large_numbers)
		 */
		private static $scale = array(
			'', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 
			'quintillion', 'sextillion', 'octillion', 'nonillion', 'decillion', 
			'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion', 
			'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 
			'noverndecillion', 'vigintillion'
		);
		
		/**
		 * An array of cardinal numbers 0 - 19
		 */
		private static $cardinals = array(
			'', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
			'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
			'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen',
		);
		
		/**
		 * An array of ordinal numbers 0 - 19
		 */
		private static $ordinals = array(
			'', 'first', 'second', 'third', 'fourth', 'fifth', 'sixth',
			'seventh', 'eighth', 'ninth', 'tenth', 'eleventh', 'twelfth',
			'thirteenth', 'fourteenth', 'fifteenth', 'sixteenth', 'seventeenth',
			'eighteenth', 'nineteenth'
		);
		
		/**
		 * An array of cardinal numbers by tens: 20 - 90
		 */
		private static $tensCardinals = array(
			'', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 
			'eighty', 'ninety',
		);
		
		/**
		 * An array of ordinal numbers by tens: 20th - 90th
		 */
		private static $tensOrdinals = array(
			'', '', 'twentieth', 'thirtieth', 'fortieth', 'fiftieth', 'sixtieth', 
			'seventieth', 'eightieth', 'ninetieth',
		);
		
		/**
		 * Main function to convert a fraction to words
		 *
		 * @param string $fraction 
		 * @return void
		 */
		public function convert($fraction) {
			
			$this->fraction = $fraction;
			
			// Clean up input
			$fraction = trim($fraction);
			$fraction = preg_replace('/\s+/', ' ', $fraction);
			
			// Get parts of fraction
			$parts = explode(' ', $fraction);
			if (count($parts) > 2 || strpos($this->fraction, '/') === false) {
				// If this does not appear to be an actual fraction, just return the original input string
				return $this->fraction;
			} else if (count($parts) === 2) {
				$this->whole_number = $parts[0];
				$fraction = $parts[1];
			} else {
				$fraction = $parts[0];
			}
			$this->numerator = reset(explode('/', $fraction));
			$this->denominator = end(explode('/', $fraction));
			
			// Convert numbers to words
			$whole_number = self::numberToCardinal($this->whole_number);
			$numerator = self::numberToCardinal($this->numerator);
			if ($this->denominator == 2) {
				if ($this->numerator > 1) {
					$denominator = 'halves';
				} else {
					$denominator = 'half';
				}
			} else {
				$denominator = self::numberToOrdinal($this->denominator);
			}
			
			if (count(explode('-', $denominator)) < 2) {
				$fraction = $numerator . '-' . $denominator;
			} else {
				$fraction = $numerator . ' ' . $denominator;
			}
			$fraction = str_replace(' -', '-', $fraction);
			
			if ($this->numerator > 1 && $this->denominator != 2) {
				$fraction .= 's';
			}
			
			// Check for whole number
			if ($whole_number) {
				$fraction = $whole_number . ' and ' . $fraction;
			}
			
			return trim($fraction);
			
		}
		
		/**
		 * Turns a number into an array containing sections of a number (as strings)
		 * 
		 * Example: 
		 * 1234567 becomes: 
		 * array(
		 * 		'001', '234', '567'
		 * );
		 *
		 * @param string $number 
		 * @return void
		 */
		private static function floatToArray($number) {
			return str_split(str_pad($number, ceil(strlen($number)/3)*3, '0', STR_PAD_LEFT), 3);
		}
		
		/**
		 * Converts a number into english words
		 *
		 * @param string $number 
		 * @return void
		 */
		private static function numberToEnglish($number) {
			$hundreds = floor($number / 100);
			$tens = $number % 100;
			$pre = ($hundreds ? self::$cardinals[$hundreds].' hundred' : '');
			
			if ($tens < 20) {
				$post = self::$cardinals[$tens];
			} else {
				$post = trim(self::$tensCardinals[floor($tens / 10)]);
				if ( ! empty(self::$cardinals[$tens % 10])) {
					$post .= '-' . self::$cardinals[$tens % 10];
				}
			}
			
			if ($pre && $post) {
				return trim("$pre $post");
			}
			
			return trim($pre.$post);
		}
		
		/**
		 * Converts an number into a English cardinal words 
		 *
		 * @param string $number 
		 * @return void
		 */
		private static function numberToCardinal($number) {
			if ($number === false) { return false; }
			
			$int = array_reverse(self::floatToArray($number));
			for($i = count($int)-1; $i > -1; $i--) {
				$englishnumber = self::numberToEnglish($int[$i]);
				if ($englishnumber) {
					$english[] = $englishnumber.' '.self::$scale[$i];
				}
			}
			$post = array_pop($english);
			$pre = implode(' ', $english);
			if ($pre && $post) {
				$cardinal = trim("$pre $post");
			} else {
				$cardinal = $pre.$post;
			}
			
			return trim($cardinal);
		}
		
		/**
		 * Converts a number into English ordinal words
		 *
		 * @param string $number 
		 * @return void
		 */
		private static function numberToOrdinal($number) {
			return trim(self::cardinalToOrdinal(self::numberToCardinal($number)));
		}
		
		/**
		 * Converts a English-words cardinal number into English ordinal words
		 *
		 * @param string $cardinal 
		 * @return void
		 */
		private static function cardinalToOrdinal($cardinal) {
			$cardinal = trim($cardinal);
			$words = explode(' ', $cardinal);
			$last = &$words[count($words)-1];
			
			if (strpos($last, '-') !== false) {
				$last_two = explode('-', $last);
				$pre = $last_two[0];
				$last = $last_two[1];
			}
			
			if (in_array($last, self::$cardinals)) {
				$last = self::$ordinals[array_search($last, self::$cardinals)];
			} else if (in_array($last, self::$tensCardinals)) {
				$last = self::$tensOrdinals[array_search($last, self::$tensCardinals)];
			} else if (substr($last, -2) != 'th') {
				$last .= 'th';
			}
			
			if (isset($pre)) {
				$last = "$pre-$last";
			}
			
			if (count($words) > 1) {
				if (strpos($words[count($words)-1], '-') === false) {
					$last = array_pop($words);
					$words[count($words)-1] = $words[count($words)-1] . '-' . $last;
				}
			}
			
			return trim(implode(' ', $words));
		}
		
	}
	
?>