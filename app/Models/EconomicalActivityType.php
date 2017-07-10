<?php
/**
 * Copyright (c) 2016  Universal Business Network - All rights reserved.
 *
 * Created by hlogeon <email: hlogeon1@gmail.com>
 * Date: 11/22/16
 * Time: 12:17 AM
 */

namespace App\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\PersistentCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use App\ValueObjects\TranslatableString;

/**
 * Class EconomicalActivityType.
 *
 * @ODM\Document(
 *     collection="economicalActivityTypes",
 *     repositoryClass="App\Repositories\EconomicalActivityTypeRepository"
 * )
 * @Gedmo\Tree(type="materializedPath", activateLocking=true)
 */
class EconomicalActivityType
{
    /**
     * @var string
     *
     * @ODM\Id(strategy="NONE", type="bin_uuid")
     */
    protected $id;

    /**
     * @var TranslatableString
     *
     * @ODM\EmbedOne(
     *     targetDocument="App\ValueObjects\TranslatableString"
     * )
     */
    public $names;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     * @Gedmo\TreePathSource
     */
    public $internalCode;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     * @Gedmo\TreePath(separator=".")
     */
    protected $path;

    /**
     * @var EconomicalActivityType|null
     *
     * @ODM\ReferenceOne(targetDocument="App\Models\EconomicalActivityType")
     * @Gedmo\TreeParent
     */
    protected $parent;

    /**
     * @var int
     *
     * @ODM\Field(type="int")
     * @Gedmo\TreeLevel
     */
    protected $level;

    /**
     * @var \DateTime
     * @Gedmo\TreeLockTime
     * @ODM\Field(type="date")
     */
    protected $lockTime;

    /**
     * @ODM\ReferenceMany(targetDocument="App\Models\EconomicalActivityType", mappedBy="parent")
     */
    public $children;

    public function __construct(array $names, $internalCode)
    {
        $this->id = Uuid::uuid4();
        $this->setNames($names);
        $this->internalCode = $internalCode;
        $this->children = new ArrayCollection();
    }

    /**
     * @return UuidInterface|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $locale
     * @return mixed
     */
    public function getName(string $locale = null) : string
    {
        return $this->names->getValue($locale);
    }

    public function getNames()
    {
        return $this->names;
    }
    /**
     * @param array $names
     */
    public function setNames(array $names)
    {
        $this->names = new TranslatableString($names);
    }

    /**
     * @param EconomicalActivityType|null $parent
     */
    public function setParent(EconomicalActivityType $parent = null)
    {
        $this->parent = $parent;
    }

    public function setCode($code)
    {
        $this->internalCode = $code;
    }

    /**
     * @return EconomicalActivityType|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->internalCode;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren() : ArrayCollection
    {
        if ($this->children instanceof PersistentCollection) {
            $this->children = new ArrayCollection($this->children->toArray());
        }
        return $this->children;
    }

    public function getParentId()
    {
        if ($this->parent) {
            return $this->parent->getId();
        }

        return '';
    }

    public static $rules = [
        'internalCode' => 'required',
        'names.en' => 'required',
        'names.ru' => 'required',
    ];

    public function formData()
    {
        $parentId = $this->getParentId();
        return [
            'internalCode' => $this->getCode(),
            'parent' => $parentId,
            'names' => [
                'en' => $this->getName('en'),
                'ru' => $this->getName('ru'),
            ]
        ];
    }
}
