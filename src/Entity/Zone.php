<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="zone")
 **/
class Zone
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private int $id;

    /**
     * @ORM\Column(name="code", type="string", length=10)
     **/
    private string $code;

    /**
     * @ORM\Column(name="description", type="string", length=100)
     **/
    private string $description;

    /**
     * @ORM\OneToMany(targetEntity="Rule", mappedBy="zoneB")
     **/
    private $rules;

    /**
     * @return Collection|Rule[]
     **/
    public function getRules()
    {
        return $this->rules;
    }

    public function __construct()
    {
        $this->rules = new ArrayCollection();
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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

}