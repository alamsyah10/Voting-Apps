<?php

// String Conversion Problem
// ================================================

// Description
// ================================================
// Create a program that accepts a positive integer input and return a string
// represent its respective alphabet just like in Excel column!

// Instruction
// ================================================
// 1. Do not modify the code in "Input" block.
// 2. Write codes that match the Output provided in "Output" block
// 3. Write your code in "Solution" block, continue the existing class and method
// 4. Click "RUN" to display your solution in "Output" panel



// Input
// ================================================
$converter = new IntegerToExcelColumnConverter;
$converter->convert(1);
$converter->convert(26);
$converter->convert(27);
$converter->convert(52);
// $converter->convert(53);

// Output
// ================================================
// A
// Z
// AA
// AZ
// BA
// etc... (We will use another input to validate)


// Solution
// ================================================
class IntegerToExcelColumnConverter
{

    public function convert($int)
    {

        $i = intval($int / 27);
        $iremainder = $int - ($i*26);

        if($i > 0){
            $str = chr($i+64);
        }


        if($iremainder > 0){
            $str = $str . chr($iremainder+64);
        }

        echo $str."<br>";
          //  $int--;

    }
}

?>
