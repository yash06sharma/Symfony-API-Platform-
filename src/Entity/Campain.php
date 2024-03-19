<?php

namespace App\Entity;

use App\Repository\CampainRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\ExistsFilter;
use Symfony\Component\Uid\Uuid;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\CampainController;



#[ORM\Entity(repositoryClass: CampainRepository::class)]
#[ApiFilter(DateFilter::class, properties: ['createdat'])]
#[ApiFilter(SearchFilter::class, properties: ['firstname' => 'exact', 'lastname' => 'exact'])]
#[ApiFilter(ExistsFilter::class, properties: ['firstname'])]
#[ApiFilter(OrderFilter::class, properties: ['firstname' => 'ASC', 'lastname' => 'DESC'])]

#[Gedmo\SoftDeleteable()]
#[ApiResource(
    operations: [
        new Get(
            security: 'is_granted(\'CAMPAIN_VIEW\', object)'
        ),
        new Put(
            security: 'is_granted(\'CAMPAIN_EDIT\', object)'
        ),
        new Delete(
            security: 'is_granted(\'CAMPAIN_DELETE\', object)'
        ),
        new Post(
            securityPostDenormalize: 'is_granted(\'CAMPAIN_POST\', object)'
        ),
        new GetCollection(),
        new Get(
            name: 'campains/required-data',
            uriTemplate: '/campains/user/{uuid}',
            controller: CampainController::class,
            
        )
    ]
)
]


class Campain
{
    use SoftDeleteableEntity;
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $uuid;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedat = null;

    public function getUuid():Uuid
    {
        return $this->uuid;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeInterface $createdat): static
    {
        $this->createdat = $createdat;

        return $this;
    }

    public function getUpdatedat(): ?\DateTimeInterface
    {
        return $this->updatedat;
    }

    public function setUpdatedat(\DateTimeInterface $updatedat): static
    {
        $this->updatedat = $updatedat;

        return $this;
    }
}
