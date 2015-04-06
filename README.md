Fractions To Words
==================

A php class to convert fractions to English words. 
(IE, "1/2" = "one-half", "3/16" = "three-sixteenths")

Usage
-----

Just require the "FractionsToWords.php" class and use the convert() function.

Example:

```php
require 'FractionsToWords.php';

echo FractionsToWords::convert('1/2');      // outputs "one half"
echo FractionsToWords::convert('5 1/4');    // outputs "5 and one-fourth"
```

* * *
If you see a mistakes or have any additions / fixes that you would like implemented, please let me know.