<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Card", mappedBy="Type")
     */
    private $CardType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Card", mappedBy="type")
     */
    private $cards;

    public function __construct()
    {
        $this->CardType = new ArrayCollection();
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getCardType(): Collection
    {
        return $this->CardType;
    }

    public function addCardType(Card $cardType): self
    {
        if (!$this->CardType->contains($cardType)) {
            $this->CardType[] = $cardType;
            $cardType->setType($this);
        }

        return $this;
    }

    public function removeCardType(Card $cardType): self
    {
        if ($this->CardType->contains($cardType)) {
            $this->CardType->removeElement($cardType);
            // set the owning side to null (unless already changed)
            if ($cardType->getType() === $this) {
                $cardType->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Card $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards[] = $card;
            $card->setType($this);
        }

        return $this;
    }

    public function removeCard(Card $card): self
    {
        if ($this->cards->contains($card)) {
            $this->cards->removeElement($card);
            // set the owning side to null (unless already changed)
            if ($card->getType() === $this) {
                $card->setType(null);
            }
        }

        return $this;
    }
}
