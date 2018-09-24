<?php

namespace Anna\Guess;

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


     /**
    * Guess::createTheNumber()
    * Create a new random number
    *
    * @return void
    */
    public function createTheNumber()
    {
        $this->theNumber = rand(1, 100);
    }


    /**
   * Guess::setNoGuessesLeft()
   * Set No of guesses left
   *
   * @return void
   */
    public function setNoGuessesLeft($noGuessesLeft)
    {
        $this->noGuessesLeft = $noGuessesLeft;
    }

    /**
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
            // echo "<br>this->noGuessesLeft inside checkTheGuess: " . $this->noGuessesLeft; // Test
            throw new GuessException("The guessed number, $guessedNumber, is null.");
            // echo "The guessed number, $guessedNumber, is null."; // Test

            return true;
        }
    }


    /**
    * Guess::checkIfOutOfBounds()
    * Handle the guess that has been made by the player
    *
    * @param integer $guessedNumber - the guessed number.
    *
    * @return String
    *
    * @throws GuessExeption
    */
    public function checkIfOutOfBounds($guessedNumber)
    {

        if ($guessedNumber < 1 || $guessedNumber > 100) {
            $this->noGuessesLeft = ($this->noGuessesLeft)+1;        // Test
            // echo "<br>this->noGuessesLeft inside checkTheGuess: " . $this->noGuessesLeft; // Test
            throw new GuessException("The guessed number, $guessedNumber, is out of bounds.");

            return true;
        }
    }

    /**
    * Guess::checkTheGuess()
    * Handle the guess that has been made by the player
    *
    * @param integer $guessedNumber - the guessed number.
    *
    * @return String
    *
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


    /**
    * Guess::getTheNumber()
    * Get the random number
    *
    * @return integer $this->theNumber
    */
    public function getTheNumber()
    {
        return $this->theNumber;
    }


    // /**
    // * Guess::getNoGuesses()
    // * Get the number of guesses made
    // *
    // * @return integer
    // */
    // public function getNoGuessesMade()
    // {
    //     return MAX_NO_GUESSES - $this->noGuessesLeft;
    // }


    /**
    * Guess::getNoGuessesLeft()
    * Get the number of guesses left
    *
    * @return integer
    */
    public function getNoGuessesLeft()
    {
        return $this->noGuessesLeft;
    }


    /**
    * Guess::compare()
    * Compare guessedNumber with the Number
    *
    * @return boolean
    */
    public function compare($guessedNumber)
    {
        if ($guessedNumber === $this->getTheNumber()) {
            $done = "true";
            // echo "The number is correct!";
        }
        return $done;
    }

    /**
    * Guess::checkNoGuessesLeft()
    * Check the number of guesses left
    *
    * @return integer
    */
    public function checkNoGuessesLeft()
    {
        if ($this->getNoGuessesLeft() >= 0) {
                $resCode = "aboveZeroLeft";
        } else {
            $resCode = "zeroLeft";
        }
        return $resCode;
    }





    // /**
    // * Guess::tryCatch()
    // * Get the number of guesses left
    // *
    // * @return integer
    // */
    // public function tryCatch($guessedNumber)
    // {
    //     try {
    //         $this->checkIfOutOfBounds(htmlentities($guessedNumber));
    //         $comparison = $this->checkTheGuess(htmlentities($guessedNumber));
    //         $lastWord = \Anna\Guess\Result::setClassOnH3($comparison);
    //         if ($guessedNumber === $this->getTheNumber()) {
    //             $done = "true";
    //             // echo "The number is correct!";
    //         }
    //         if ($this->getNoGuessesLeft() >= 0) {
    //                 $result =  "<h4>The guessed number </h4>" . "<h3 class='$lastWord'>" . htmlentities($_GET['guessedNumber']) . "</h3>" . "<h4>  is  </h4>" . "<h3  class='$lastWord'>" . $comparison . "</h3>"
    //                 . "<h4 class='guessesleft'>Number of guesses left: " . $this->getNoGuessesLeft();
    //             // }
    //         } else {
    //             $result = "<h3>Sorry, you have no guesses left!</h3>" .
    //                 "<h3>The correct number was " . $this->getTheNumber() . ". </h3>";
    //         }
    //     } catch (\Exception $e) {
    //         $result = "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
    //         // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
    //     }
    //     return $result;
    // }
}
