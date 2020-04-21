<?php
    class Letter
    {
        private $name;
        private $value;

        function __construct($letter)
        {
            $letter = strtolower($letter);
            $this->name = $letter;
            $this->value = $this->setValue();
        }

        function getName()
        {
            return $this->name;
        }

        function getValue()
        {
            return $this->value;
        }

        function setValue()
        {
            $letter = $this->getName();

            switch(true){
                case($letter == 'a'||$letter == 'e'||$letter == 'i'||$letter == 'o'||$letter == 'u'||$letter == 'l'||$letter == 'n'||$letter == 's'||$letter == 't'||$letter == 'r'):
                    return 1;
                case($letter == 'd'||$letter == 'g'):
                    return 2;
                case($letter == 'b'||$letter == 'c'||$letter == 'm'||$letter == 'p'):
                    return 3;
                case($letter == 'f'||$letter == 'h'||$letter == 'v'||$letter == 'w'||$letter == 'y'):
                    return 4;
                case($letter == 'k'):
                    return 5;
                case($letter == 'j'||$letter == 'x'):
                    return 8;
                case($letter == 'q'||$letter == 'z'):
                    return 10;
                default:
                    return 0;
            }
        }
    }
