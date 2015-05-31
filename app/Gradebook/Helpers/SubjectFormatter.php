<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 27.05.15
 * Time: 22:20
 */

namespace App\Gradebook\Helpers;


use App\Exceptions\NoGradesException;
use App\Services\GradeJudge;
use App\Services\Round;

/**
 * Class DisplaySubject
 *
 * This class is responsible to display data of a subject
 * in a human readable way.
 *
 * @package App\Gradebook\Helpers
 */
class SubjectFormatter {

    private $round;
    private $judge;
    private $classifications;

    public function __construct(Round $round, GradeJudge $judge) {
        $this->round = $round;
        $this->judge = $judge;

        $this->classifications[GradeJudge::VERY_BAD] = "panel-red";
        $this->classifications[GradeJudge::BAD] = "panel-yellow";
        $this->classifications[GradeJudge::GOOD] = "panel-primary";
        $this->classifications[GradeJudge::VERY_GOOD] = "panel-green";
    }

    public function average($subject) {
        try {
            // TODO currently the 'tenth' is fix but this should get abstracted to a setting
            return strval($this->round->tenth($subject->average()));
        } catch (NoGradesException $e) {
            return "-";
        }
    }

    public function cssClassForAverage($subject) {
        try {
            return $this->classifications[$this->judge->classify($subject->average())];
        } catch (NoGradesException $e) {
            return $this->classifications[GradeJudge::GOOD];
        }
    }
}