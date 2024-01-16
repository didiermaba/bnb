<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $guest = null;

    #[ORM\ManyToOne(inversedBy: 'create_at')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $rooms = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $create_at = null;

    #[ORM\OneToOne(mappedBy: 'review', cascade: ['persist', 'remove'])]
    private ?Booking $booking = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getGuest(): ?User
    {
        return $this->guest;
    }

    public function setGuest(?User $guest): static
    {
        $this->guest = $guest;

        return $this;
    }

    public function getRooms(): ?Room
    {
        return $this->rooms;
    }

    public function setRooms(?Room $rooms): static
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): static
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(?Booking $booking): static
    {
        // unset the owning side of the relation if necessary
        if ($booking === null && $this->booking !== null) {
            $this->booking->setReview(null);
        }

        // set the owning side of the relation if necessary
        if ($booking !== null && $booking->getReview() !== $this) {
            $booking->setReview($this);
        }

        $this->booking = $booking;

        return $this;
    }
}
