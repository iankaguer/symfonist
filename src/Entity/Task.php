<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\TaskRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 * @ORM\Table(name="task")
 *
 */

#[ApiResource(
	collectionOperations: ["get", "post"],
	itemOperations: ["GET", "PUT", "PATCH","DELETE"],
	denormalizationContext: ["groups" => ["write"]],
	formats: [ "jsonld", "csv" => ["text/csv"]],
	normalizationContext: ["groups" => ["read"]]
)]

class Task
{
	
    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
	#[Groups(["read", "write"])]
    private ?string $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
	#[Groups(["read", "write"])]
      private ?DateTimeInterface $tdate;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
	#[Groups(["read", "write"])]
    private ?bool $status;
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	#[Groups(["read", "write"])]
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tasks")
     * @ORM\JoinColumn(name="user_id",nullable=false)
     */
	#[Groups(["read"])]
    private ?user $userId;



   

    

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

    public function getUserId(): ?user
    {
        return $this->userId;
    }

    public function setUserId(?user $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    


 
}
