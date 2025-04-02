<?php

    // Básico
    class Student {
        // constructor
        public function __construct($first_name, $last_name) {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
        }
    
        public function say_name() {
            echo "My name is " . $this->first_name . " " . $this->last_name . ".\n";
        }
    }
    
    $alex = new Student("Alex", "Jones");
    $alex->say_name(); 


    // Definir clave y usarla extendida
    class Student {
        // constructor
        public function __construct($first_name, $last_name) {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
        }
    
        public function say_name() {
            echo "My name is " . $this->first_name . " " . $this->last_name . ".\n";
        }
    }
    
    $alex = new Student("Alex", "Jones");
    $alex->say_name();
    
    class MathStudent extends Student {
        function sum_numbers($first_number, $second_number) {
            $sum = $first_number + $second_number;
            echo $this->first_name . " says that " . $first_number . " + " . $second_number . " is " . $sum;
        }
    }
    
    $eric = new MathStudent("Eric", "Chang");
    $eric->say_name();
    $eric->sum_numbers(3, 5);

?>