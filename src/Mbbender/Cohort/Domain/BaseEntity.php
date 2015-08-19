<?php

namespace Mbbender\Cohort\Domain;

use Doctrine\ORM\Mapping as ORM;
use Mbbender\Cohort\Traits\BaseEntityTrait;

/**
 * Class BaseEntity includes imports, GUID  generation, and  Time Stamp Functionality
 * @package Mbbender\Cohort\Domain
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
class BaseEntity {

    use BaseEntityTrait;
}