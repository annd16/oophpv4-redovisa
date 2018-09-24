<?php

namespace Anna\Guess;

/**
 * A Guess class that handles the html forms
 */
class Form
{

    /**********
     * Properties
     **********/

    private $inputs = [];
    private $inputsCheat = [];

    /**********
     * Methods
     **********/

    /**
    * Constructor.
    *
    * @param integer $guessedNumber - the guessed number.
    * @param integer $theNumber - the random number.
    * @param boolean $done - true if guessedNumber is equal to theNumber.
    * @param integer $noGuessesLeft - number of guesses left.
    *
    * @return self
    */
    // public function __construct($game, $guessedNumber, $theNumber = null, $done, $noGuessesLeft = null, $else)
    public function __construct($done, $else, $guessedNumber = null, $theNumber = null, $noGuessesLeft = null)
    {
        $params = func_get_args();
        $noParams = func_num_args();
        echo "\$params  =";
        var_dump($params);
        echo "\$noParams  =";
        var_dump($noParams);

        if ($noParams === 3) {
            $this->validNames = ["guessedNumber", "done", ""];      // session: guessedNumber, done och submit
        } else if ($noParams === 3) {
            $this->validNames = ["done", "cheat"];                  // session-cheat: // session: done och submit
        } else {
            $this->validNames = ["done", "guessedNumber", "theNumber", "noGuessesLeft", "", "cheat"];
        }

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


     /**
    * Form::createFormStartTag()
    *
    * Create an html <form> start tag

    * @param string - $class - the class as a string
    * @param string - $action - the action/route as a string
    * @param string - $method - the method used (i.e. get/post) as a string
    *
    * @return string - the start tag as a string
    */
    private function createFormStartTag($class, $action, $method)
    {
        return "<form class='$class' action='$action' method='$method'>";
    }


    /**
   * Form::createInput()
   *
   * Create an html <input> tag
   *
   * @param string - $type - the type of the input
   * @param string - $name - the name of the input
   * @param string - $value - the value
   * @param  string - $else - "disabled" if $done is true, else an epmty string "", defaults to an empty string
   *
   * @return string - the input tag as a string
   */
    private function createInput($type, $name, $value, $else = "")
    {
        return "<input type='$type', name='$name' value='$value' $else>";
    }


    /**
   * Form::createInputSubmit()
   *
   * Create an html <input> submit tag
   *
   * @param string - $name - the name of the input
   * @param string - $value - the value
   * @param  string - $else - "disabled" if $done is true, else an epmty string "", defaults to an empty string
   *
   * @return string - the input tag as a string
   */
    private function createInputSubmit($name, $value, $else = "")
    {
        return "<input type='submit' class='submit' name='$name' value='$value' $else>";
    }

    /**
   * Form::createFormEndTag()
   *
   * Create an html <form> end tag
   *
   * @return string - the start tag as a string
   */
    private function createFormEndTag()
    {
        return "</form>";
    }


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

    /****************
   * Guess::setNoGuessesLeft()
   * Set No of guesses left
   *
   * @return void
   */
    private function createForm($game, $method, $cheat = false)
    {
        // $action = "result#";
        $action = "$game";
        $formAsString = "";
        if (!$cheat) {
            $formAsString = $this->createFormStartTag("form form-guess form-".$game, $action, $method);   // Fungerar!
            // echo "\$formAsString = " . $formAsString;
            // echo "hello1";

            for ($i = 0; $i < count($this->inputs)-1; $i++) {
                // echo "hello2";
                // echo "\$this->\$inputs[$i]['type'] = " . $this->inputs[$i]["type"];
                // $formAsString .= $this->createInput($type, $name, $value, $else = "");
                // Test 180920
                if (in_array($this->inputs[$i]["name"], $this->validNames)) {
                    $formAsString .= $this->createInput($this->inputs[$i]["type"], $this->inputs[$i]["name"], $this->inputs[$i]["value"], $this->inputs[$i]["else"]);
                }
            }
            // echo "\$formAsString = " . $formAsString;
            $formAsString .= $this->createInputSubmit($this->inputs[4]["name"], $this->inputs[4]["value"], $this->inputs[4]["else"]);
            // echo "\$formAsString = " . $formAsString;
        } else {
            $formAsString = $this->createFormStartTag("form form-cheat form-".$game, $action, $method);   // Fungerar!
            for ($i = 0; $i < count($this->inputs)-1; $i++) {
                // echo "hello2";
                // echo "\$this->\$inputs[$i]['type'] = " . $this->inputs[$i]["type"];
                // $formAsString .= $this->createInput($type, $name, $value, $else = "");
                // Test 180920
                if (in_array($this->inputs[$i]["name"], $this->validNames)) {

                    $formAsString .= $this->createInput($this->inputsCheat[$i]["type"], $this->inputsCheat[$i]["name"], $this->inputsCheat[$i]["value"], $this->inputsCheat[$i]["else"]);
                }
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
    public function displayForm($game, $method, $cheat = false)
    {
        $formAsString = $this->createForm($game, $method, $cheat);
        echo $formAsString;
    }

}
