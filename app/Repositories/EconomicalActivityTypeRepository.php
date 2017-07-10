<?php

namespace App\Repositories;

use App\Models\EconomicalActivityType;
use Gedmo\Tree\Document\MongoDB\Repository\MaterializedPathRepository;

class EconomicalActivityTypeRepository extends MaterializedPathRepository
{
    public function getAllForDropdown()
    {
        $allTypes = $this->findAll();

        $result = [
            '' => 'No parent',
        ];
        foreach ($allTypes as $type) {
            /**
             * @var $type EconomicalActivityType
             */
            $result[$type->getId()] = $type->getCode() . ': ' . $type->getName('en') . ' / ' . $type->getName('ru');
        }

        return $result;
    }
}
