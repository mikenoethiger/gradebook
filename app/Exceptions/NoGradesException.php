<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 27.05.15
 * Time: 21:43
 */

namespace App\Exceptions;


class NoGradesException extends \Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}