<?php

namespace App\Entity;

use App\Repository\CustomersRatingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomersRatingRepository::class)
 */
class CustomersRating
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=user::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;


    /**
     * @ORM\ManyToOne(targetEntity=BookingOffer::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking_offer_id;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1)
     */
    private $rating;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getBookingOfferId(): ?BookingOffer
    {
        return $this->booking_offer_id;
    }

    public function setBookingOfferId(?BookingOffer $booking_offer_id): self
    {
        $this->booking_offer_id = $booking_offer_id;

        return $this;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(string $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
