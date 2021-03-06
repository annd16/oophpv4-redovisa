<?php

/**
 * A module for Result class.
 *
 * This is the module containing the Result class.
 *
 * @author  Anna
 */


namespace Anna\Result;

/**
 * A Guess class that handles the result.
 */
class Result
{

    /**********
     * Properties
     **********/

    /**********
     * Methods
     **********/

   /**
  * Result::getResult()
  *
  * Get different result dependant on result code.
  *
  * @param string $resCode - the result code
  * @param integer $guessedNumber - the incoming guessedNumber
  * @param integer $theNumber - the random number
  * @param integer $noGuessesLeft - the guessed number
  * @param integer extraMessage - extra information needed to display the result
  *
  * @return string - $result - the result as a HTML strings
  */
    public static function getResult($resCode, $guessedNumber, $theNumber, $noGuessesLeft, $extraMessage = null)
    {
        // if ($extraMessage !== null) {
        //     $lastWord = self::setClassOnH3($comparison);
        //     echo "extraMessage is not null!";
        // }
        switch ($resCode) {
            case "cheat":
                $result = "<h4 class='guessesleft'>Number of guesses left: " . ($noGuessesLeft > 0 ? htmlentities($noGuessesLeft) : "none.") . "</h4>";
                break;
            case "zeroLeft":
                $result = "<h3>Sorry, you have no guesses left!</h3>" .
                    "<h3>The correct number was " . $theNumber . ". </h3>";
                break;
            case "aboveZeroLeft":
                $lastWord = self::setClassOnH3($extraMessage);
                // $result =  "<h4>The guessed number </h4>" . "<h3 class='" . (($extraMessage !== null) ? $lastWord : "" ) . "'>" . htmlentities($_GET['guessedNumber']) . "</h3>" . "<h4>  is  </h4>" . "<h3  class='$lastWord'>" . $extraMessage . "</h3>"
                //     . "<h4 class='guessesleft'>Number of guesses left: " . $noGuessesLeft . "</h4>";
                $result =  "<h4>The guessed number </h4>" . "<h3 class='" . (($extraMessage !== null) ? $lastWord : "" ) . "'>" . htmlentities($guessedNumber) . "</h3>" . "<h4>  is  </h4>" . "<h3  class='$lastWord'>" . $extraMessage . "</h3>"
                    . "<h4 class='guessesleft'>Number of guesses left: " . $noGuessesLeft . "</h4>";
                break;
            case "anException":
                // echo "An exception has occured!";
                $result = "<h3>Caught exception:</h3>" . "<h4>" . $extraMessage . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($noGuessesLeft > 0 ?  htmlentities($noGuessesLeft) : "none.") . "</h4>";
                break;
        }
        return $result;
    }


   /**
  * Result::setClassOnH3()
  *
  * Set class on h3 element depending on what value $comparison has
  *
  * @param string - $comparison - the result as string from the comparison i.e. "too low"/"too high"/"correct"
  *
  * @return string - $LastWord - the extracted string that should be used as the class
  */
    public static function setClassOnH3($comparison)
    {
        $words=[];
        $words = explode(' ', $comparison);
        $lastWord = array_pop($words);
        $lastWord = substr($lastWord, 0, -1);
        return $lastWord;
    }


    /**
   * Result::displayResult()
   *
   * Display the result div
   *
    * @param string - $result - the result as a html-string
   *
   * @return void
   */
    public static function displayResult($result)
    {
        echo "<div class='result' id='result'>" . $result . "</div>";
    }
}
