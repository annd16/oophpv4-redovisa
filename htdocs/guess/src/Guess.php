<?php

const MAX_NO_GUESSES = 6;

/**
 * A Guess class that handles the guessing game.
 */
class Guess
{

    /**********
     * Properties
     **********/

    private $theNumber;
    // private $guessedNumber;
    private $noGuessesLeft;

    /**********
     * Methods
     **********/

    /**
    * Constructor.
    *
    * @param integer $theNumber - the random number, defaults to null.
    * @param integer $noGuessesLeft - number of guesses left, defaults to MAX_NO_GUESSES.
    *
    * @return self
    */
    public function __construct($theNumber = null, $noGuessesLeft = MAX_NO_GUESSES)
    {
        $this->theNumber = $theNumber;
        // echo "this->theNumber inside constructor: " . $this->theNumber;
        $this->noGuessesLeft = $noGuessesLeft;
        // echo "<br>this->noGuessesLeft inside constructor: " . $this->noGuessesLeft;     // Test
        // echo "<br/>" . __METHOD__ . "<br>";
        // echo "<br>MAX_NO_GUESSES inside constructor: " . MAX_NO_GUESSES;
    }


     /****************
    * Guess::createTheNumber()
    * Create a new random number
    *
    * @return void
    */
    public function createTheNumber()
    {
        $this->theNumber = rand(1, 100);
    }


    /****************
   * Guess::setNoGuessesLeft()
   * Set No of guesses left
   *
   * @return void
   */
    public function setNoGuessesLeft($noGuessesLeft)
    {
        $this->noGuessesLeft = $noGuessesLeft;
    }


    // /****************
    // * Guess::checkTheGuess()
    // * Handle the guess that has been made by the player
    // *
    // * @param integer $guessedNumber - the guessed number.
    // *
    // * @return String
    // *
    // * @throws GuessExeption
    // */
    // // public function makeAGuess($guessedNumber, $theNumber)
    // public function checkTheGuess($guessedNumber)
    // {
    //
    //     if ($guessedNumber < 1 || $guessedNumber > 100) {
    //         $this->noGuessesLeft = ($this->noGuessesLeft)+1;        // Test
    //         // echo "<br>this->noGuessesLeft inside checkTheGuess: " . $this->noGuessesLeft; // Test
    //         throw new GuessException("The guessed number, $guessedNumber, is out of bounds.");
    //
    //         // return "Not a valid guess - try again!";
    //     }
    //
    //     if ($guessedNumber > $this->getTheNumber()) {
    //         return "too high!";
    //     } elseif ($guessedNumber < $this->getTheNumber()) {
    //         return "too low!";
    //     } else {
    //         return "correct!";
    //     }
    // }


    /****************
    * Guess::checkIfNull()
    * Handle the guess that has been made by the player
    *
    * @param integer $guessedNumber - the guessed number.
    *
    * @return String
    *
    * @throws GuessExeption
    */
    // public function makeAGuess($guessedNumber, $theNumber)
    public function checkIfNull($guessedNumber)
    {

        if ($guessedNumber === "null" || $guessedNumber === null) {
            // $this->noGuessesLeft = $noGuessesLeft;        // Test
            echo "<br>this->noGuessesLeft inside checkTheGuess: " . $this->noGuessesLeft; // Test
            throw new GuessException("The guessed number, $guessedNumber, is null.");
            // echo "The guessed number, $guessedNumber, is null."; // Test

            return true;
        }
    }


    /****************
    * Guess::checkIfOutOfBounds()
    * Handle the guess that has been made by the player
    *
    * @param integer $guessedNumber - the guessed number.
    *
    * @return String
    *
    * @throws GuessExeption
    */
    // public function makeAGuess($guessedNumber, $theNumber)
    public function checkIfOutOfBounds($guessedNumber)
    {

        if ($guessedNumber < 1 || $guessedNumber > 100) {
            $this->noGuessesLeft = ($this->noGuessesLeft)+1;        // Test
            // echo "<br>this->noGuessesLeft inside checkTheGuess: " . $this->noGuessesLeft; // Test
            throw new GuessException("The guessed number, $guessedNumber, is out of bounds.");

            return true;
        }
    }

    /****************
    * Guess::checkTheGuess()
    * Handle the guess that has been made by the player
    *
    * @param integer $guessedNumber - the guessed number.
    *
    * @return String
    *
    * @throws GuessExeption
    */
    // public function makeAGuess($guessedNumber, $theNumber)
    public function checkTheGuess($guessedNumber)
    {
        if ($guessedNumber > $this->getTheNumber()) {
            return "too high!";
        } elseif ($guessedNumber < $this->getTheNumber()) {
            return "too low!";
        } else {
            return "correct!";
        }
    }





    // /****************
    // * Guess::checkTheGuess()
    // * Handle the guess that has been made by the player
    // *
    // * @param integer $guessedNumber - the guessed number.
    // *
    // * @return String
    // *
    // * @throws GuessExeption
    // */
    // // public function makeAGuess($guessedNumber, $theNumber)
    // public function checkTheGuess($guessedNumber)
    // {
    //
    //     if ($guessedNumber < 1 || $guessedNumber > 100) {
    //         $this->noGuessesLeft = ($this->noGuessesLeft)+1;        // Test
    //         // echo "<br>this->noGuessesLeft inside checkTheGuess: " . $this->noGuessesLeft; // Test
    //         throw new GuessException("The guessed number, $guessedNumber, is out of bounds.");
    //
    //         // return "Not a valid guess - try again!";
    //     }
    //
    //     if ($guessedNumber > $this->getTheNumber()) {
    //         $answer = 1;
    //         // return "too high!";
    //     } elseif ($guessedNumber < $this->getTheNumber()) {
    //         $answer = -1;
    //         // return "too low!";
    //     } else {
    //         $answer = 0;
    //         // return "correct!";
    //     }
    //     return $answer;
    // }


    /****************
    * Guess::getTheNumber()
    * Get the random number
    *
    * @return integer $this->theNumber
    */
    public function getTheNumber()
    {
        return $this->theNumber;
    }



    /****************
    * Guess::getNoGuesses()
    * Get the number of guesses made
    *
    * @return integer
    */
    public function getNoGuessesMade()
    {
        return MAX_NO_GUESSES - $this->noGuessesLeft;
    }


    /****************
    * Guess::getNoGuessesLeft()
    * Get the number of guesses left
    *
    * @return integer
    */
    public function getNoGuessesLeft()
    {
        return $this->noGuessesLeft;
    }
}



// <?php
// /**
//  * Guess my number, a class supporting the game through GET, POST and SESSION.
//  */
// class Guess
// {
//     /**
//      * @var int $theNumber   The current secret number.
//      * (@var int $tries    Number of tries a guess has been made.)
//      * @var int $tries    Number of guesses left.
//      */
//
//      private $theNumber;
//      public $guessedNumber;
//      public $noGuessesLeft;
//
//
//     /**
//      * Constructor to initiate the object with current game settings,
//      * if available. Randomize the current number if no value is sent in.
//      *
//      * @param int $number The current secret number, default -1 to initiate
//      *                    the number from start.
//      * @param int $tries  Number of tries a guess has been made,
//      *                    default 6.
//      */
//     /*
//     public function __construct(int $number = -1, int $tries = 6)
//     { }
//     */
//
//
//
//     /**
//      * Randomize the secret number between 1 and 100 to initiate a new game.
//      *
//      * @return void
//      */
//     /*
//     public function random()
//     { }
//     */
//
//
//
//     /**
//      * Get number of tries left.
//      *
//      * @return int as number of tries made.
//      */
//     /*
//     public function tries()
//     { }
//     */
//
//
//
//     /**
//      * Get the secret number.
//      *
//      * @return int as the secret number.
//      */
//     /*
//     public function number()
//     { }
//     */
//
//
//
//     /**
//      * Make a guess, decrease remaining guesses and return a string stating
//      * if the guess was correct, too low or to high or if no guesses remains.
//      *
//      * @throws GuessException when guessed number is out of bounds.
//      *
//      * @return string to show the status of the guess made.
//      */
//     /*
//     public function makeGuess($number)
//     { }
//     */
// }
