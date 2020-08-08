<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Base entity class extended from cake orm
 */
class BaseEntity extends Entity
{
    /**
     * Set first error message as error from validations array
     *
     * @return array
     */
    public function getValidationErrors()
    {
        if (empty($this->getErrors())) {
            return [];
        }

        $validations = [];
        foreach ($this->getErrors() as $field => $errors) {
            if (! is_array($errors)) {
                continue;
            }

            $validations[$field] = array_values($errors)[0];
        }

        return $validations;
    }
}
