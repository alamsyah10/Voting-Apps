<?php

// Student Profile Problem
// ================================================

// Description
// ================================================
// Create a program that accepts a student profile basic info and his/her university enrollment info

// Instruction
// ================================================
// 1. Do not modify the code in "Input" block.
// 2. Write codes that match the Output provided in "Output" block
// 3. Write your code in "Solution" block, continue the existing class and method
// 4. Click "RUN" to display your solution in "Output" panel

// Input
// ================================================
$profile = new Profile;
$profile->setName('Faisal Ahmad Sulhan');
$profile->setAge(25);
$profile->getSummary();


$university = new University('Universitas Gadjah Mada', 'Ilmu Komputer', 2015);
$university->getSummary();

// Output
// ================================================
// Nama Lengkap: Faisal Ahmad Sulhan
// Umur: 25
// Universitas: Universitas Gadjah Mada
// Jurusan: Ilmu Komputer
// Tahun Masuk: 2015

// Solution
// ================================================
class Profile
{
    public $name;
    public $age;

    public function setName($n)
    {
        $this->name = $n;
    }

    public function setAge($a)
    {
        $this->age = $a;
    }

    public function getSummary()
    {
        echo "Nama Lengkap: ".$this->name."<br>";
         echo "Nama Lengkap: ".$this->age."<br>";

    }
}

class University
{
    public $univ;
    public $cs;
    public $year;

    public function __construct($u,$c,$y){
        $this->univ = $u;
        $this->cs = $c;
        $this->year = $y;
    }

    public function getSummary()
    {
         echo "Universitas: ".$this->univ."<br>";
          echo "Jurusan: ".$this->cs."<br>";
           echo "Tahun Masuk: ".$this->year."<br>";
    }
}

?>
