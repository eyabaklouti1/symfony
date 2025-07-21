<?php

namespace App\Entity;

use App\Repository\SubcategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubcategoryRepository::class)]
class Subcategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'subcategories')]
    private Collection $category_id;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product_id = null;

    public function __construct()
    {
        $this->category_id = new ArrayCollection();
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

    /**
     * @return Collection<int, category>
     */
    public function getCategoryId(): Collection
    {
        return $this->category_id;
    }

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    public function setProductId(Product $product_id): static
    {
        $this->product_id = $product_id;

        return $this;
    }
}   