<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(options :['default'=> 'CURRENT_TIMESTAMP']  )]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $categories = null;

    /**
     * @var Collection<int, OrdersLine>
     */
    
    #[ORM\OneToMany(targetEntity: OrdersLine::class, mappedBy: 'products')]
    private Collection $ordersLines;

    public function __construct()
    {
        $this->ordersLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): static
    {
        $this->categories = $categories;

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
            $ordersLine->setProducts($this);
        }

        return $this;
    }

    public function removeOrdersLine(OrdersLine $ordersLine): static
    {
        if ($this->ordersLines->removeElement($ordersLine)) {
            // set the owning side to null (unless already changed)
            if ($ordersLine->getProducts() === $this) {
                $ordersLine->setProducts(null);
            }
        }

        return $this;
    }
}
