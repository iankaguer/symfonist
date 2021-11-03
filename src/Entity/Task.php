<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TaskRepository;
use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 *
 *
 *  @ApiResource(
 *      collectionOperations={"get"={"normalization_context"={"groups"="task:list"}}},
 *      itemOperations={"get"={"normalization_context"={"groups"="task:item"}}},
 *    paginationEnabled=false
 *  )
 */
class Task
{
	

    /**
     * @ORM\Column(type="string", length=255)
     */
	#[Groups(["conference:list", "conference:item"])]
    private ?string $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
	#[Groups(["conference:list", "conference:item"])]
    private ?DateTimeInterface $tdate;

    /**
     * @ORM\Column(type="boolean")
     */
	#[Groups(["conference:list", "conference:item"])]
    private ?bool $status;
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	#[Groups(["conference:list", "conference:item"])]
    private ?int $id;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTdate(): ?DateTimeInterface
    {
        return $this->tdate;
    }

    public function setTdate(?DateTimeInterface $tdate): self
    {
        $this->tdate = $tdate;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setID(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
