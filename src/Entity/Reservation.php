<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
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
     * @ORM\Column(type="boolean")
     */
    private $paid;

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

    public function setDateOfBooking(\DateTimeInterface $dateOfBooking): self
    {
        $this->dateOfBooking = $dateOfBooking;

        return $this;
    }

    public function getPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(bool $paid): self
    {
        $this->paid = $paid;

        return $this;
    }

    public function getBankTransferDate(): ?\DateTimeInterface
    {
        return $this->bankTransferDate;
    }

    public function setBankTransferDate(\DateTimeInterface $bankTransferDate): self
    {
        $this->bankTransferDate = $bankTransferDate;

        return $this;
    }
}
