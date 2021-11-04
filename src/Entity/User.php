<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="user")
 * @method string getUserIdentifier()
 */
#[ApiResource]
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private string $mail;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $validated;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $lastConnexion;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="user_id", orphanRemoval=true)
     */
    private ArrayCollection $tasks;

   
  

    #[Pure]
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getValidated(): ?bool
    {
        return $this->validated;
    }

    public function setValidated(bool $validated): self
    {
        $this->validated = $validated;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLastConnexion(): ?DateTimeInterface
    {
        return $this->lastConnexion;
    }

    public function setLastConnexion(DateTimeInterface $lastConnexion): self
    {
        $this->lastConnexion = $lastConnexion;

        return $this;
    }
	
	/**
	 * @return Collection
	 */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setUserId($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getUserId() === $this) {
                $task->setUserId(null);
            }
        }

        return $this;
    }
	
	public function getRoles()
	{
		// TODO: Implement getRoles() method.
	}
	
	public function getPassword()
	{
		// TODO: Implement getPassword() method.
	}
	
	public function getSalt()
	{
		// TODO: Implement getSalt() method.
	}
	
	public function eraseCredentials()
	{
		// TODO: Implement eraseCredentials() method.
	}
	
	public function getUsername()
	{
		// TODO: Implement getUsername() method.
	}
	
	public function __call(string $name, array $arguments)
	{
		// TODO: Implement @method string getUserIdentifier()
	}
}
