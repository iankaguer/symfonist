<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TaskRepository;
use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 *
 *
 */
#[ApiResource]
class Task
{
	

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
	#[Groups(["task:list", "task:item"])]
                                  private ?string $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
	#[Groups(["task:list", "task:item"])]
                                  private ?DateTimeInterface $tdate;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type("boolean")
     */
	#[Groups(["task:list", "task:item"])]
                              	
                                  private ?bool $status;
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	#[Groups(["task:list", "task:item"])]
                                  private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

   

   

    

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
        return $this->user;
    }

    public function setUserId(?user $user): self
    {
        $this->user = $user;

        return $this;
    }


 
}
