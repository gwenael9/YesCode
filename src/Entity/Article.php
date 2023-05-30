<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use ORM\PreUpdate;
use ORM\PrePersist;
use Cocur\Slugify\Slugify; 
use ORM\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Article
{

    /**
     * Génére un slug automatiquement
     * 
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initSlug(){
        if(empty($this->slug) ) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->getTitle(). time(). hash("sha1", $this->getIntro()));
        }
    }

    /**
     * Génére la date auto
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function updateDate(){
        if(empty($this->createdAt)) {
            $this->createdAt = new \DateTime();
        }
    }


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "Veuillez renseigner un titre !")
     * @Assert\Length(
     * min=5, 
     * minMessage="Veuillez avoir au moins {{ limit }} caractères !",
     * max=255, 
     * maxMessage="Plus de {{ limit }} caractères, ce n'est plus un titre !"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "Veuillez renseigner une introduction")
     * @Assert\Length(
     * min=20, 
     * minMessage="Minimun {{ limit }} caractères !",
     * max=255,
     * maxMessage="Plus de {{ limit }} caractères, ce n'est plus une intro !"
     * )
     */
    private $intro;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message= "Ce champs ne peux pas être vide !")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(message= "Ceci n'est pas une url !")
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

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

    public function getIntro(): ?string
    {
        return $this->intro;
    }

    public function setIntro(string $intro): self
    {
        $this->intro = $intro;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
