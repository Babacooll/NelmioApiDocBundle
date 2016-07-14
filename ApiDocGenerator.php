<?php

/*
 * This file is part of the ApiDocBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiDocBundle;

use EXSyst\Bundle\ApiDocBundle\Describer\DescriberInterface;
use gossi\swagger\Swagger;

class ApiDocGenerator
{
    private $swagger;
    private $describers;

    /**
     * @param DescriberInterface[] $describers
     */
    public function __construct(array $describers)
    {
        $this->describers = $describers;
    }

    /**
     * @return Swagger
     */
    public function extract()
    {
        if (null !== $this->swagger) {
            return $this->swagger;
        }

        $this->swagger = new Swagger();
        foreach ($this->describers as $describer) {
            $describer->describe($this->swagger);
        }

        return $this->swagger;
    }
}
