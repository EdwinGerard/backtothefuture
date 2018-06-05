<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 04/06/18
 * Time: 10:24
 */

namespace Model;


class TimeTravel
{
    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @return \DateTime
     */
    public function getStart (): \DateTime
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     */
    public function setStart (\DateTime $start): void
    {
        $this->start = $start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd (): \DateTime
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd (\DateTime $end): void
    {
        $this->end = $end;
    }

    public function __construct ()
    {
        $start = new \DateTime('1985-12-31');
        $end = new \DateTime('1954-04-23 22:13:20');

        $this->setStart($start);
        $this->setEnd($end);
    }


}