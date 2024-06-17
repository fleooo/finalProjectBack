<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?int $totalAmount = null;

    #[ORM\Column(options :['default'=> 'CURRENT_TIMESTAMP']  )]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    /**
     * @var Collection<int, OrdersLine>
     */
    #[ORM\OneToMany(targetEntity: OrdersLine::class, mappedBy: 'orders', orphanRemoval: true)]
    private Collection $ordersLines;

    public function __construct()
    {
        $this->ordersLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(int $totalAmount): static
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, OrdersLine>
     */
    public function getOrdersLines(): Collection
    {
        return $this->ordersLines;
    }

    public function addOrdersLine(OrdersLine $ordersLine): static
    {
        if (!$this->ordersLines->contains($ordersLine)) {
            $this->ordersLines->add($ordersLine);
            $ordersLine->setOrders($this);
        }

        return $this;
    }

    public function removeOrdersLine(OrdersLine $ordersLine): static
    {
        if ($this->ordersLines->removeElement($ordersLine)) {
            // set the owning side to null (unless already changed)
            if ($ordersLine->getOrders() === $this) {
                $ordersLine->setOrders(null);
            }
        }

        return $this;
    }
}
