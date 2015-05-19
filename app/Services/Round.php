<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 14.05.15
 * Time: 11:06
 */

namespace App\Services;


class Round {

    public function round($value, $fraction) {
        switch ($fraction) {
            case "half":
                return half($value);
            case "quarter":
                return quarter($value);
            case "tenth":
                return tenth($value);
            default:
                return $value;
        }
    }

    public function half($value) {
        return round($value/0.5)*0.5;
    }

    public function quarter($value) {
        return round($value/0.25)*0.25;
    }

    public function tenth($value) {
        return round($value/0.1)*0.1;
    }
}