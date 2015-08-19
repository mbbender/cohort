<?php namespace Mbbender\Cohort\Traits;

use LaravelDoctrine\ORM\Extensions\Timestamps\Timestamps;
use Doctrine\ORM\Mapping as ORM;


trait BaseEntityTrait {

    use Timestamps;

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
}