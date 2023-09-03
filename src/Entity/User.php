<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     **/
    protected int $id;
    /**
     * @ORM\Column(type="string", length=40)
     **/
    protected string $name;
    /**
     * @ORM\Column(type="string", length=40)
     **/
    protected string $email;

    /**
     * @ORM\OneToMany(targetEntity="Action", mappedBy="user")
     **/
    protected $actions;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }



    /**
     * @param int $id
     */
    private function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection|Action[]
     **/
    public function getActions(): Collection
    {
        return $this->actions;
    }

}