<?php

namespace Anna\Guess;

/**
 * A Guess class that handles the result.
 */
class Result
{

    /**********
     * Properties
     **********/

    // private $inputs = [];
    // private $inputsCheat = [];

    /**********
     * Methods
     **********/

    // /**
    // * Constructor.
    // *
    // * @param integer $guessedNumber - the guessed number.
    // * @param integer $theNumber - the random number.
    // * @param boolean $done - true if guessedNumber is equal to theNumber.
    // * @param integer $noGuessesLeft - number of guesses left.
    // *
    // * @return self
    // */
    // // public function __construct($game, $guessedNumber, $theNumber = null, $done, $noGuessesLeft = null, $else)
    // public function __construct($game, $done, $else, $guessedNumber = null, $theNumber = null, $noGuessesLeft = null)
    // {
    //     $params = func_get_args();
    //     $noParams = func_num_args();
    //     echo "\$params  =";
    //     var_dump($params);
    //     echo "\$noParams  =";
    //     var_dump($noParams);
    //
    //     if ($noParams === 4) {
    //         $this->validNames = ["guessedNumber", "done", ""];
    //     } else if ($noParams === 3) {
    //         $this->validNames = ["done", "cheat"];
    //     } else {
    //         $this->validNames = ["done", "guessedNumber", "theNumber", "noGuessesLeft", "", "cheat"];
    //     }
    //
    //     $this->inputs =
    //     [
    //         ["type" => "number", "name" => "guessedNumber", "value" => $guessedNumber, "else" => $else],
    //         ["type" => "hidden", "name" => "theNumber", "value" => $theNumber, "else" => ""],
    //         ["type" => "hidden", "name" => "done", "value" => $done, "else" => ""],
    //         ["type" => "hidden", "name" => "noGuessesLeft", "value" => $noGuessesLeft, "else" => ""],
    //         ["name" => "", "value" => "Submit guess", "else"=> $else]
    //     ];
    //
    //     $this->inputsCheat =
    //     [
    //         ["type" => "hidden", "name" => "guessedNumber", "value" => null, "else" => $else],
    //         ["type" => "hidden", "name" => "theNumber", "value" => $theNumber, "else" => ""],
    //         ["type" => "hidden", "name" => "done", "value" => $done, "else" => ""],
    //         ["type" => "hidden", "name" => "noGuessesLeft", "value" => $noGuessesLeft, "else" => ""],
    //         ["name" => "cheat", "value" => "Cheat", "else" => $else]
    //     ];
    // }


    //  /**
    // * Form::createFormStartTag()
    // *
    // * Create an html <form> start tag
    //
    // * @param string - $class - the class as a string
    // * @param string - $action - the action/route as a string
    // * @param string - $method - the method used (i.e. get/post) as a string
    // *
    // * @return string - the start tag as a string
    // */
    // private function createFormStartTag($class, $action, $method)
    // {
    //     return "<form class='$class' action='$action' method='$method'>";
    // }
    //

   //  /**
   // * Form::createInput()
   // *
   // * Create an html <input> tag
   // *
   // * @param string - $type - the type of the input
   // * @param string - $name - the name of the input
   // * @param string - $value - the value
   // * @param  string - $else - "disabled" if $done is true, else an epmty string "", defaults to an empty string
   // *
   // * @return string - the input tag as a string
   // */
   //  private function createInput($type, $name, $value, $else = "")
   //  {
   //      return "<input type='$type', name='$name' value='$value' $else>";
   //  }
   //

   //  /**
   // * Form::createInputSubmit()
   // *
   // * Create an html <input> submit tag
   // *
   // * @param string - $name - the name of the input
   // * @param string - $value - the value
   // * @param  string - $else - "disabled" if $done is true, else an epmty string "", defaults to an empty string
   // *
   // * @return string - the input tag as a string
   // */
   //  private function createInputSubmit($name, $value, $else = "")
   //  {
   //      return "<input type='submit' class='submit' name='$name' value='$value' $else>";
   //  }

   //  /**
   // * Form::createFormEndTag()
   // *
   // * Create an html <form> end tag
   // *
   // * @return string - the start tag as a string
   // */
   //  private function createFormEndTag()
   //  {
   //      return "</form>";
   //  }



   //  /****************
   // * Guess::setNoGuessesLeft()
   // * Set No of guesses left
   // *
   // * @return void
   // */
   //  public function getCurrentUrl()
   //  {
   //      namespace \Anax\View;
   //      $request = $di->get("request");
   //      return $request->getCurrentUrl();
   //  }

   //  /****************
   // * Guess::setNoGuessesLeft()
   // * Set No of guesses left
   // *
   // * @return void
   // */
   //  private function createForm($game, $method, $cheat = false)
   //  {
   //      // $action = "result#";
   //      $action = "$game";
   //      $formAsString = "";
   //          if (!$cheat) {
   //              $formAsString = $this->createFormStartTag("form form-guess form-".$game, $action, $method);   // Fungerar!
   //              // echo "\$formAsString = " . $formAsString;
   //              // echo "hello1";
   //
   //              for ($i = 0; $i < count($this->inputs)-1; $i++) {
   //                  // echo "hello2";
   //                  // echo "\$this->\$inputs[$i]['type'] = " . $this->inputs[$i]["type"];
   //                  // $formAsString .= $this->createInput($type, $name, $value, $else = "");
   //                  // Test 180920
   //                  if (in_array($this->inputs[$i]["name"], $this->validNames)) {
   //                      $formAsString .= $this->createInput($this->inputs[$i]["type"], $this->inputs[$i]["name"], $this->inputs[$i]["value"], $this->inputs[$i]["else"]);
   //                  }
   //              }
   //              // echo "\$formAsString = " . $formAsString;
   //              $formAsString .= $this->createInputSubmit($this->inputs[4]["name"], $this->inputs[4]["value"], $this->inputs[4]["else"]);
   //              // echo "\$formAsString = " . $formAsString;
   //          } else {
   //              $formAsString = $this->createFormStartTag("form form-cheat form-".$game, $action, $method);   // Fungerar!
   //              for ($i = 0; $i < count($this->inputs)-1; $i++ ) {
   //                  // echo "hello2";
   //                  // echo "\$this->\$inputs[$i]['type'] = " . $this->inputs[$i]["type"];
   //                  // $formAsString .= $this->createInput($type, $name, $value, $else = "");
   //                  // Test 180920
   //                  if (in_array($this->inputs[$i]["name"], $this->validNames)) {
   //
   //                      $formAsString .= $this->createInput($this->inputsCheat[$i]["type"], $this->inputsCheat[$i]["name"], $this->inputsCheat[$i]["value"], $this->inputsCheat[$i]["else"]);
   //                  }
   //              }
   //              // echo "\$formAsString = " . $formAsString;
   //              $formAsString .= $this->createInputSubmit($this->inputsCheat[4]["name"], $this->inputsCheat[4]["value"], $this->inputsCheat[4]["else"]);
   //              // echo "\$formAsString = " . $formAsString;
   //          }
   //      $formAsString .= $this->createFormEndTag();
   //      // echo "\$formAsString = " . $formAsString;
   //      return $formAsString;
   //  }





  //  /**
  // * Result::getAndDisplayResultBeforeGuessHasBeenMade()
  // *
  // * Set class on h3 element depending on what value $comparison has.
  // *
  // * @param integer - $guessedNumber - the incoming $_GET['guessedNumber']
  // *
  // *
  // * @return string - $result - the result as a HTML strings
  // */
  //   public static function getAndDisplayResultBeforeGuessHasBeenMade($guessedNumber, $noGuessesLeft)
  //   {
  //       // För att resultat-diven ska visas även innan några gissningar gjorts:
  //       if (!isset($guessedNumber)) {
  //           $result = "<h4 class='noguessesmade'>No guesses has been made yet!</h4> " .
  //               "<h4 class='guessesleft'>Number of guesses left: " . $noGuessesLeft;
  //       }
  //       return $result;
  //   }

   /**
  * Result::getResult()
  *
  * Get differnt result dependant on result code.
  *
  * @param integer - $guessedNumber - the incoming $_GET['guessedNumber']
  *
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
                $result = "<h4 class='guessesleft'>Number of guesses left: " . ($noGuessesLeft > 0 ? $noGuessesLeft : "none.") . "</h4>";
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
                echo "An exception has occured!";
                $result = "<h3>Caught exception:</h3>" . "<h4>" . $extraMessage . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($noGuessesLeft > 0 ? $noGuessesLeft : "none.") . "</h4>";
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
   * @return void
   */
    public static function displayResult($result)
    {
        echo "<div class='result' id='result'>" . $result . "</div>";
    }
}
