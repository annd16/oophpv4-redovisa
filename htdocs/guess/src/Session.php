<?php

/**
 * A module for Session class.
 *
 * This is the module containing the Session class.
 *
 * @author  Anna
 */

/**
* A Session class that starts a session and handles all communication with $_SESSION.
*/
class Session
{
    /************
    * Properties
    *************/


    /**********
     * Methods
     **********/

    /****************
    *  Guess::start()
    *  Starts a session.
    *
    * @return void
    */
    public static function start()
    {
        session_start();
    }

    /****************
    *  Guess::setName()
    *  Gives the session a name (must be called upon BEFORE start of session).
    *
    * @param String $name - the name of the session.
    *
    * @return void
    */
    public static function setName($name)
    {
        session_name($name);
    }


    /****************
    *  Session::get($key)
    *  Reads a value from the session.
    *
    * @param string $key - the key of the element which value should be read.
    *
    * @return array $_SESSION[$key] - the element (in the session-array) that should be returned
    */
    public static function get($key)
    {
        return $_SESSION[$key];
    }

    /****************
    *  Session::set($key, $value)
    *  Sets a value in the session.
    *
    * @param string $key - the key of the element which should be set.
    * @param integer/object $value - the value of the element which should be set.
    *
    * @return void
    */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /****************
    *  Session::getOnce()
    *  Reads a value from the session and then deletes it from the session.
    *
    * @param string $key - the key of the element which should be read.
    *
    * @return array $_SESSION[$key] as a temp variable
    */
    public static function getOnce($key)
    {
        $tempValue = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $tempValue;

    }

    /****************
    *  Guess::destroy()
    *  Destroys a session.
    *
    *
    * @return void
    */
    public static function destroy()
    {
        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();
    }
}
