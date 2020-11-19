<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingOfferRepository")
 */
class BookingOffer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $offerName;

    /**
     * @ORM\Column(type="integer")
     */
    private $offerPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $rating;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destination", inversedBy="bookingOffers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bookingStartDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bookingEndDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departureDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $comebackDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $departureSpot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BookingOfferType", inversedBy="bookingOffers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offerType;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfferName(): ?string
    {
        return $this->offerName;
    }

    public function setOfferName(string $offerName): self
    {
        $this->offerName = $offerName;

        return $this;
    }

    public function getOfferPrice(): ?int
    {
        return $this->offerPrice;
    }

    public function setOfferPrice(int $offerPrice): self
    {
        $this->offerPrice = $offerPrice;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getBookingStartDate(): ?\DateTimeInterface
    {
        return $this->bookingStartDate;
    }

    public function setBookingStartDate(\DateTimeInterface $bookingStartDate): self
    {
        $this->bookingStartDate = $bookingStartDate;

        return $this;
    }

    public function getBookingEndDate(): ?\DateTimeInterface
    {
        return $this->bookingEndDate;
    }

    public function setBookingEndDate(\DateTimeInterface $bookingEndDate): self
    {
        $this->bookingEndDate = $bookingEndDate;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getComebackDate(): ?\DateTimeInterface
    {
        return $this->comebackDate;
    }

    public function setComebackDate(\DateTimeInterface $comebackDate): self
    {
        $this->comebackDate = $comebackDate;

        return $this;
    }

    public function getDepartureSpot(): ?string
    {
        return $this->departureSpot;
    }

    public function setDepartureSpot(string $departureSpot): self
    {
        $this->departureSpot = $departureSpot;

        return $this;
    }

    public function getOfferType(): ?BookingOfferType
    {
        return $this->offerType;
    }

    public function setOfferType(?BookingOfferType $offerType): self
    {
        $this->offerType = $offerType;

        return $this;
    }
}
