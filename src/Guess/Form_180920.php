<?php

namespace Anna\Guess;

/**
 * A Guess class that handles the guessing game.
 */
class Form
{

    /**********
     * Properties
     **********/

    private $action = "";
    // private $guessedNumber;
    private $method = "";
    private $class = "";
    private $inputs = [];
    private $inputsCheat = [];
    private $values = [];
    private $valuesCheats = [];

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
    public function __construct($guessedNumber, $theNumber, $done, $noGuessesLeft, $else)
    {
        // $this->inputs =
        // [
        //     ["type" => "number", "name" => "guessedNumber", "value"=> $guessedNumber, "else" => $done === "true" ? "disabled" : ""],
        //     ["type" => "hidden", "name" => "theNumber", "value"=> $guess->getTheNumber()],
        //     ["type" => "hidden", "name" => "done", "value" => $done],
        //     ["type" => "hidden", "name" => "noGuessesLeft", "value"=> $guess->getNoGuessesLeft()-1],
        //     ["value" => "Submit guess", "else"=> $done === "true" ? "disabled" : ""]
        // ];
        //
        // $this->inputsCheat =
        // [
        //     ["type" => "hidden", "name" => "guessedNumber", "value" => null, "else" => $done === "true" ? "disabled" : ""],
        //     ["type" => "hidden", "name" => "theNumber", "value" => $guess->getTheNumber()],
        //     ["type" => "hidden", "name" => "done", "value" => $done],
        //     ["type" => "hidden", "name" => "noGuessesLeft", "value" => $guess->getNoGuessesLeft()],
        //     ["name" => "cheat", "value" => "Cheat", "else" => $done === "true" ? "disabled" : ""]
        // ];

        $this->inputs =
        [
            ["type" => "number", "name" => "guessedNumber", "value" => $guessedNumber, "else" => $else],
            ["type" => "hidden", "name" => "theNumber", "value" => $theNumber, "else" => ""],
            ["type" => "hidden", "name" => "done", "value" => $done, "else" => ""],
            ["type" => "hidden", "name" => "noGuessesLeft", "value" => $noGuessesLeft, "else" => ""],
            ["name" => "", "value" => "Submit guess", "else"=> $else]
        ];

        $this->inputsCheat =
        [
            ["type" => "hidden", "name" => "guessedNumber", "value" => null, "else" => $else],
            ["type" => "hidden", "name" => "theNumber", "value" => $theNumber, "else" => ""],
            ["type" => "hidden", "name" => "done", "value" => $done, "else" => ""],
            ["type" => "hidden", "name" => "noGuessesLeft", "value" => $noGuessesLeft, "else" => ""],
            ["name" => "cheat", "value" => "Cheat", "else" => $else]
        ];
    }


     /****************
    * Guess::createTheNumber()
    * Create a new random number
    *
    * @return void
    */
    private function createFormStartTag($class, $action, $method)
    {
        return "<form class='$class' action='$action' method='$method'>";
    }


    /****************
   * Guess::setNoGuessesLeft()
   * Set No of guesses left
   *
   * @return void
   */
    private function createInput($type, $name, $value, $else = "")
    {
        return "<input type='$type', name='$name' value='$value' $else>";
    }


    /****************
   * Guess::setNoGuessesLeft()
   * Set No of guesses left
   *
   * @return void
   */
    private function createInputSubmit($name, $value, $else = "")
    {
        return "<input type='submit' class='submit' name='$name' value='$value' $else>";
    }


    /****************
   * Guess::setNoGuessesLeft()
   * Set No of guesses left
   *
   * @return void
   */
    private function createFormEndTag()
    {
        return "</form>";
    }


    /****************
   * Guess::setNoGuessesLeft()
   * Set No of guesses left
   *
   * @return void
   */
    private function createForm($method, $cheat = false)
    {
        $action = "#result";
        $formAsString = "";
            if (!$cheat) {
                $formAsString = $this->createFormStartTag("form form-guess form-".$method, $action, $method);   // Fungerar!
                // echo "\$formAsString = " . $formAsString;
                // echo "hello1";

                for ($i = 0; $i < 4; $i++) {
                    // echo "hello2";
                    // echo "\$this->\$inputs[$i]['type'] = " . $this->inputs[$i]["type"];
                    // $formAsString .= $this->createInput($type, $name, $value, $else = "");
                    $formAsString .= $this->createInput($this->inputs[$i]["type"], $this->inputs[$i]["name"], $this->inputs[$i]["value"], $this->inputs[$i]["else"]);
                }
                // echo "\$formAsString = " . $formAsString;
                $formAsString .= $this->createInputSubmit($this->inputs[4]["name"], $this->inputs[4]["value"], $this->inputs[4]["else"]);
                // echo "\$formAsString = " . $formAsString;
            } else {
                $formAsString = $this->createFormStartTag("form form-cheat form-".$method, $action, $method);   // Fungerar!
                for ($i = 0; $i < 4; $i++ ) {
                    // echo "hello2";
                    // echo "\$this->\$inputs[$i]['type'] = " . $this->inputs[$i]["type"];
                    // $formAsString .= $this->createInput($type, $name, $value, $else = "");
                    $formAsString .= $this->createInput($this->inputsCheat[$i]["type"], $this->inputsCheat[$i]["name"], $this->inputsCheat[$i]["value"], $this->inputsCheat[$i]["else"]);
                }
                // echo "\$formAsString = " . $formAsString;
                $formAsString .= $this->createInputSubmit($this->inputsCheat[4]["name"], $this->inputsCheat[4]["value"], $this->inputsCheat[4]["else"]);
                // echo "\$formAsString = " . $formAsString;
            }
        $formAsString .= $this->createFormEndTag();
        // echo "\$formAsString = " . $formAsString;
        return $formAsString;
    }

    /****************
   * Guess::setNoGuessesLeft()
   * Set No of guesses left
   *
   * @return void
   */
    public function displayForm($method, $cheat = false)
    {
        $formAsString = $this->createForm($method, $cheat);
        echo $formAsString;
    }

}
