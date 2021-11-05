<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\UserRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 *
 * @method string getUserIdentifier()
 */
#[ApiResource(
	collectionOperations: ['get', 'post'],
	itemOperations: ['GET', 'PUT', 'PATCH', 'DELETE'],
	denormalizationContext: ['groups' => ['write']],
	formats: ['jsonld', 'csv' => ['text/csv']],
	normalizationContext: ['groups' => ['read']]
)]
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
	#[Groups(['read', 'write'])]
    private int $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
	#[Groups(['read', 'write'])]
    private string $mail;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 */
	#[Groups(['read', 'write'])]
	private string $username;
	
	/**
	 * @ORM\Column(type="string")
	 */
	#[Groups([ 'write'])]
	private ?string $password;
	
    /**
     * @ORM\Column(type="boolean")
     */
	#[Groups(['read', 'write'])]
    private bool $validated;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
	#[Groups(['read', 'write'])]
    private DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
	#[Groups(['read', 'write'])]
    private DateTimeInterface $lastConnexion;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="userId", orphanRemoval=true)
     */
	#[ApiSubresource]
	private PersistentCollection $tasks;

   /* #[Pure] public function __construct()
    {
       // $this->tasks = new PersistentCollection();
    }*/

    
	
	

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
	
	
	public function getUsername()
    {
        return $this->username;
    }
	public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
	
	public function getPassword()
    {
        return $this->password;
    }
	public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
	
	public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }
	
	public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

	public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
	
	public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
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
	    // set the owning side to null (unless already changed)
	    if ($this->tasks->removeElement($task) && $task->getUserId() === $this) {
	        $task->setUserId(null);
	    }
        return $this;
    }
}
