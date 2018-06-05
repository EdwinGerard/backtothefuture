<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 04/06/18
 * Time: 10:27
 */

namespace Model;


class TimeTravelManager extends AbstractManager
{
    const TABLE = 'travel';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);

    }

    public function getTravelInfo()
    {
        $timeTravel = new TimeTravel();
        $travel = $timeTravel->getStart()->diff($timeTravel->getEnd())->format('%y années, %m mois, %d jours, %h heures, %i minutes et %s secondes');
        $info = "Il y a $travel entre les deux dates";

        return $info;

    }

    public function findDate(\DateInterval $interval)
    {
        $timeTravel = new TimeTravel();
        $start = $timeTravel->getStart();

        $end = $start->add($interval)->format('Y-m-d H:i:s');

        $timeTravel->setEnd($start->add($interval));

        $docLocation = "Doc se trouve en $end";

        return $docLocation;

    }

    /**
     * @param \DateInterval $step
     * @return array|string
     * @throws \Exception
     */
    public function backToTheFutureStepByStep(\DateInterval $step)
    {
        $timeTravel = new TimeTravel();
        $max = new \DateInterval('P1M8D');
        $results = [];


        if ($this->comparator($step, $max) === -1) {
            $msg = "Le convecteur temporel est cassé et ne peut pas dépasser 1 mois 1 semaine et 1 jour.
             Recommencer.";
            return $msg;
        }else {
            $start = $timeTravel->getStart();
            $end = $timeTravel->getEnd();
            $results[] = $start->format('M j Y A g:i');
            $interval = $start->format('U') - $end->format('U');
            $count = $interval / $step->s;
            for ($i = 1; $i < $count; $i++) {
                $stepInt = $start->add($step);
                $diff = $stepInt->diff($start);
                $results[] = $stepInt->format('M j Y A g:i');
                $dateRange[] = new \DatePeriod($start, $diff, $end);
            }
            $results[] = $end->format('M j Y A g:i');


            return $results;
        }
    }

    /**
     * @param \DateInterval $first
     * @param \DateInterval $second
     * @return int
     */
    public function comparator(\DateInterval $first, \DateInterval $second)
    {
        $intervalOne = ($first->y * 365 * 24 * 3600) + ($first->m * 31 * 24 * 3600) + ($first->d * 3600 * 24) + ($first->h * 3600) + ($first->i * 60) + $first->s;
        $intervalTwo = ($second->y * 365 * 24 * 3600) + ($second->m * 31 * 24 * 3600) + ($second->d * 3600 * 24) + ($second->h * 3600) + ($second->i * 60) + $second->s;

        if ($intervalOne > $intervalTwo) {
            return -1;
        }else {
            return 1;
        }
    }


}