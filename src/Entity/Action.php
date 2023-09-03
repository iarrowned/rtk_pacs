<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="action")
 **/
class Action
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected int $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    protected User $user;

    /**
     * @ORM\ManyToOne(targetEntity="Zone")
     * @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     **/
    protected Zone $zone;

    /**
     * @ORM\Column(name="time_in", type="datetime")
     **/
    protected \DateTime $timeIn;

    /**
     * @ORM\Column(name="time_out", type="datetime", nullable=true)
     **/
    protected ?\DateTime $timeOut;

    public function __construct()
    {
        $this->timeIn = new \DateTime();
    }

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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Zone
     */
    public function getZone(): Zone
    {
        return $this->zone;
    }

    /**
     * @param Zone $zone
     */
    public function setZone(Zone $zone): void
    {
        $this->zone = $zone;
    }

    /**
     * @return \DateTime
     */
    public function getTimeIn(): \DateTime
    {
        return $this->timeIn;
    }

    /**
     * @param \DateTime $timeIn
     */
    public function setTimeIn(\DateTime $timeIn): void
    {
        $this->timeIn = $timeIn;
    }

    /**
     * @return ?\DateTime
     */
    public function getTimeOut(): ?\DateTime
    {
        return $this->timeOut;
    }

    /**
     * @param \DateTime $timeOut
     */
    public function setTimeOut(\DateTime $timeOut): void
    {
        $this->timeOut = $timeOut;
    }

    public function getInterval(): ?int
    {
        if(!$this->getTimeOut()) {
            return null;
        }
        $now = new \DateTime();
        return (int)(($now->getTimestamp() - $this->getTimeOut()?->getTimestamp()) / 3600);
    }
}