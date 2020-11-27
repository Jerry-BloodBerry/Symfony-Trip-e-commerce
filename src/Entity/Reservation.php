<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository", repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=BookingOffer::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking_offer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateOfBooking;

    /**
     * @ORM\Column(type="integer")
     */
    private $adultNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $childNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPaidFor;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $bankTransferDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBookingOffer(): ?BookingOffer
    {
        return $this->booking_offer;
    }

    public function setBookingOffer(?BookingOffer $booking_offer): self
    {
        $this->booking_offer = $booking_offer;

        return $this;
    }

    public function getDateOfBooking(): ?\DateTimeInterface
    {
        return $this->dateOfBooking;
    }

    public function setDateOfBooking(?\DateTimeInterface $dateOfBooking): self
    {
        $this->dateOfBooking = $dateOfBooking;

        return $this;
    }

    public function getIsPaidFor(): ?bool
    {
        return $this->isPaidFor;
    }

    public function setIsPaidFor(?bool $isPaidFor): self
    {
        $this->isPaidFor = $isPaidFor;

        return $this;
    }

    public function getBankTransferDate(): ?\DateTimeInterface
    {
        return $this->bankTransferDate;
    }

    public function setBankTransferDate(?\DateTimeInterface $bankTransferDate): self
    {
        $this->bankTransferDate = $bankTransferDate;

        return $this;
    }

    public function getChildNumber():?int
    {
        return $this->childNumber;
    }

    public function setChildNumber(?int $childNumber): self
    {
        $this->childNumber = $childNumber;
        return $this;
    }

    public function getAdultNumber(): ?int
    {
        return $this->adultNumber;
    }

    public function setAdultNumber(?int $adultNumber): self
    {
        $this->adultNumber = $adultNumber;
        return $this;
    }
}
