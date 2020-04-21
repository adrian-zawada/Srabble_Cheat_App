<?php
    class Word
    {
        private $word;
        private $word_points = 0;
        private $word_letters = array();

        function __construct($user_letter)
        {
            $this->word = $user_letter;

            // creates array of words for user letters
            $this->word_for_letters = $this->makeWordForLetters();

            // creates array of letter objects for the word
            $this->word_letters = $this->makeWordLetters();

            // adds points from array of letter objects
            $this->word_points = $this->addWordPoints();

        }

        function makeWordForLetters()
        {
            $word_objects = array();
            $word = $this->getWord();
            $file = file_get_contents( __DIR__."/../src/dictionary.txt");
            $items = explode("\n", $file);

            $letters = str_split($word);

            foreach ($items as $item) {
                $list = $letters;

                $thisItem = preg_replace("/$word/", '', $item, 1);
                for ($i = 0; $i < strlen($thisItem); $i++) {
                    $index = array_search($thisItem[$i], $list);

                    if ($index === false) {
                        continue 2; // letter not available
                    }

                    unset($list[$index]); // remove the letter from the list
                }

                array_push($word_objects, $item);
            }

            return $word_objects;

        }

        function makeWordLetters()
        {
            $word = $this->getWord();
            $letters = str_split($word);
            $letter_objects = array();

            foreach ($letters as $character) {
                array_push($letter_objects, new Letter($character));
            }

            return $letter_objects;
        }

        function addWordPoints()
        {
            $total_word_points = 0;
            $word_letters = $this->getWordLetters();

            foreach ($word_letters as $letter_object) {
                $total_word_points += $letter_object->getValue();
            }
            return $total_word_points;
        }

        function getWord()
        {
            return $this->word;
        }

        function getWordForLetters()
        {
            return $this->word_for_letters;
        }

        function getWordLetters()
        {
            return $this->word_letters;
        }

        function getWordPoints()
        {
            return $this->word_points;
        }
    }