<?php

// University Student Problem
// ================================================

// Description
// ================================================
// Create a program that simulate student KRS activity, with these following criteria
// a. Student can take lessons
// b. Student can get summary of lessons taken


// Instruction
// ================================================
// 1. Do not modify the code in "Input" block.
// 2. Write codes that match the Output provided in "Output" block
// 3. Write your code in "Solution" block, continue the existing class and method
// 4. Do not modify the provided code
// 5. Click "RUN" to display your solution in "Output" panel



// Input
// ================================================
// A
$student = new Student;
$student->takeLesson('Algorithm and Programming');

//
 $student->getLessonSummary();

// // B
$student = new Student;
$student->takeLesson('Artificial Intelligence');
$student->takeLesson('Data Structure 2');
//
$student->getLessonSummary();
//
// // C
$student = new Student;
$student->takeLesson('Algorithm and Programming');
$student->takeLesson('Advanced Database');
$student->takeLesson('Artificial Intelligence');
$student->takeLesson('Data Structure 2');

$student->getLessonSummary();

// Output
// ================================================

// Name: YOUR_NAME
// Lesson: Algorithm and Programming
// Total duration: 3 SKS
// Room: A17
// Lecturer: Ikhsan Permadi
// Day: Monday, Thursday
// Building: South Block


// Name: YOUR_NAME
// Lesson: Artificial Intelligence, Data Structure 2
// Total duration: 5 SKS
// Room: B12, B10
// Lecturer: Ikhsan Permadi, Faisal Sulhan
// Day: Thursday, Wednesday
// Building: North Block


// Name: YOUR_NAME
// Lesson: Algorithm and Programming, Advanced Database, Artificial Intelligence, Data Structure 2
// Total duration: 12 SKS
// Room: A17, B12, B10
// Lecturer: Ikhsan Permadi, Faisal Sulhan
// Day: Monday, Thursday, Tuesday, Wednesday
// Building: South Block, North Block

// Solution
// ================================================


// START OF PROVIDED CODE
// DO NOT CHANGE CODES IN THIS BLOCK
// ================================================

class Lesson
{
    public function getDetail($lessonName)
    {
        $details = [
            [
                'name' => 'Algorithm and Programming',
                'lecturer' => 'Ikhsan Permadi',
                'room' => 'A17',
                'schedule' => [
                    [
                        'day'=> 'Monday',
                        'duration'=> '2 SKS'
                    ],
                    [
                        'day'=> 'Thursday',
                        'duration'=> '1 SKS'
                    ]
                ]
            ],
            [
                'name' => 'Advanced Database',
                'lecturer' => 'Faisal Sulhan',
                'room' => 'B12',
                'schedule' => [
                    [
                        'day'=> 'Tuesday',
                        'duration'=> '2 SKS'
                    ],
                    [
                        'day'=> 'Thursday',
                        'duration'=> '2 SKS'
                    ]
                ]
            ],
            [
                'name' => 'Artificial Intelligence',
                'lecturer' => 'Ikhsan Permadi',
                'room' => 'B12',
                'schedule' => [
                    [
                        'day'=> 'Thursday',
                        'duration'=> '3 SKS'
                    ]
                ]
            ],
            [
                'name' => 'Data Structure 2',
                'lecturer' => 'Faisal Sulhan',
                'room' => 'B10',
                'schedule' => [
                    [
                        'day'=> 'Wednesday',
                        'duration'=> '2 SKS'
                    ]
                ]
            ],
        ];

        foreach ($details as $key => $detail) {
            if ($detail['name'] == $lessonName) {
                return $details[$key];
            }
        }
    }
}

class Room
{
    public function getBuilding($roomName)
    {
        $details = [
            'A17' => 'South Block',
            'B12' => 'North Block',
            'B10' => 'North Block'
        ];

        sleep(2);

        return $details[$roomName];
    }
}

// END OF PROVIDED CODE
// PLEASE WRITE AND COMPLETE THE CODE BELOW
// ================================================

class Student
{
    public $list_lesson = array();
    public $list_lesson_name = array();
    public $list_lecturer_name = array();
    public $list_room_name = array();
    public $list_duration = array();
    public $list_day_name = array();
    public $list_building_name = array();

    private function checkLessonUnique($lesson_name){         //a function that will check if there is same $lesson_name in $list_lesson
      foreach ($this->list_lesson as $list) {
        if($list == $lesson_name){
          return false;
        }
      }
      return true;
    }

    public function takeLesson($lesson_name)
    {

      // to make sure there is no same $lesson_name in $list_lesson
      if($this->checkLessonUnique($lesson_name)){
        array_push($this->list_lesson, $lesson_name);
      }

    }

    public function getLessonSummary()
    {

      $room_details = new Room;
      $lesson_details = new Lesson;

      echo "Name: Alamsyah Imanudin<br>";
      //extract data from class Room and class Lesson
      foreach ($this->list_lesson as $key) {

      $tes =  $lesson_details->getDetail($key);


        foreach ($tes as $key2 => $value) {

            if($key2 == "schedule"){

              foreach ($tes[$key2] as $key3 => $value2) {

                foreach ($value2 as $key4 => $value3) {
                  if($key4 == "duration"){
                    array_push($this->list_duration, $value3);
                  }else if($key4 == "day"){
                    array_push($this->list_day_name, $value3);
                  }
                }

              }

            }else{

                if($key2 == "name"){
                  array_push($this->list_lesson_name, $value);
                }else if($key2 == "lecturer"){
                  array_push($this->list_lecturer_name, $value);
                }else if($key2 == "room"){
                  array_push($this->list_room_name, $value);
                }
            }
        }
      }

      //output process

      echo "Lesson: ";
      for ($i=0; $i <sizeof($this->list_lesson_name) ; $i++) {
        if($i == sizeof($this->list_lesson_name)-1){
            echo $this->list_lesson_name[$i] . "<br>";
        }else{
            echo $this->list_lesson_name[$i] . ", ";
        }
      }

      echo "Total duration: ";

      //get total SKS data from $list_duration
      $total_duration = 0;
      for ($i=0; $i <sizeof($this->list_duration) ; $i++) {
        $getValueFromSKS = str_replace(" SKS","",$this->list_duration[$i]);
        $total_duration += (int)$getValueFromSKS;
      }
      echo $total_duration . " SKS<br>";

      //make sure there is no same room_name in list_room_name
      $this->list_room_name = array_unique($this->list_room_name);    //remove duplicate values in list_room_name
      $this->list_room_name = array_values($this->list_room_name);    //indexing the array numerically

      echo "Room: ";
      for ($i=0; $i <sizeof($this->list_room_name) ; $i++) {
        //extract building's name by its room_name
        $building = $room_details->getBuilding($this->list_room_name[$i]);

        array_push($this->list_building_name, $building  );

        if($i == sizeof($this->list_room_name)-1){
            echo $this->list_room_name[$i] . "<br>";
        }else{
            echo $this->list_room_name[$i] . ", ";
        }
      }

      $this->list_lecturer_name = array_unique($this->list_lecturer_name);
      $this->list_lecturer_name = array_values($this->list_lecturer_name);

      echo "Lecturer: ";
      for ($i=0; $i <sizeof($this->list_lecturer_name) ; $i++) {
        if($i == sizeof($this->list_lecturer_name)-1){
            echo $this->list_lecturer_name[$i] . "<br>";
        }else{
            echo $this->list_lecturer_name[$i] . ", ";
        }
      }

      $this->list_day_name = array_unique($this->list_day_name);

      $list_day_name_unique = array_values($this->list_day_name);


      echo "Day: ";
      for ($i=0; $i <sizeof($list_day_name_unique) ; $i++) {
        if($i == sizeof($list_day_name_unique)-1){
            echo $list_day_name_unique[$i] . "<br>";
        }else{
            echo $list_day_name_unique[$i] . ", ";
        }
      }

      $list_building_name_1 = array_unique($this->list_building_name);
      $list_building_name_unique = array_values($list_building_name_1);

      echo "Building: ";
      for ($i=0; $i <sizeof($list_building_name_unique) ; $i++) {
        if($i == sizeof($list_building_name_unique)-1){
            echo $list_building_name_unique[$i] . "<br>";
        }else{
            echo $list_building_name_unique[$i] . ", ";
        }
      }
      echo "<br><br>";



    }
}

?>
