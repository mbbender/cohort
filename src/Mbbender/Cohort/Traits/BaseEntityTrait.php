<?php namespace Mbbender\Cohort\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTime;


trait BaseEntityTrait {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="ordered_guid")
     * @ORM\CustomIdGenerator(class="Mbbender\Doctrine\ORM\Id\OrderedGuidGenerator")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getKey()
    {
        return $this->getId();
    }

    public function getKeyName()
    {
        return 'id';
    }

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="update")
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}