<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_arrive;

    /**
     * @ORM\Column(type="date")
     */
    private $date_depart;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrP;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrC;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->date_arrive;
    }

    public function setDateArrive(\DateTimeInterface $date_arrive): self
    {
        $this->date_arrive = $date_arrive;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getNbrP(): ?int
    {
        return $this->nbrP;
    }

    public function setNbrP(int $nbrP): self
    {
        $this->nbrP = $nbrP;

        return $this;
    }

    public function getNbrC(): ?int
    {
        return $this->nbrC;
    }

    public function setNbrC(int $nbrC): self
    {
        $this->nbrC = $nbrC;

        return $this;
    }
}
