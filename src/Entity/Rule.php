<?php

namespace Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="rule")
 **/
class Rule
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @ORM\ManyToOne(targetEntity="Zone")
     * @ORM\JoinColumn(name="zone_a", referencedColumnName="id")
     **/
    protected Zone $zoneA;

    /**
     * @ORM\ManyToOne(targetEntity="Zone")
     * @ORM\JoinColumn(name="zone_b", referencedColumnName="id")
     **/
    protected Zone $zoneB;

    /**
     * @ORM\Column(name="hour_interval", type="integer", length=20)
     */
    protected int $hourInterval;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Zone
     */
    public function getZoneA(): Zone
    {
        return $this->zoneA;
    }

    /**
     * @param Zone $zoneA
     */
    public function setZoneA(Zone $zoneA): void
    {
        $this->zoneA = $zoneA;
    }

    /**
     * @return Zone
     */
    public function getZoneB(): Zone
    {
        return $this->zoneB;
    }

    /**
     * @param Zone $zoneB
     */
    public function setZoneB(Zone $zoneB): void
    {
        $this->zoneB = $zoneB;
    }

    /**
     * @return int
     */
    public function getHourInterval(): int
    {
        return $this->hourInterval;
    }

    /**
     * @param int $hourInterval
     */
    public function setHourInterval(int $hourInterval): void
    {
        $this->hourInterval = $hourInterval;
    }


}