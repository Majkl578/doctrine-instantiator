<?php

declare(strict_types=1);

namespace Doctrine\Instantiator;

use Doctrine\Instantiator\Exception\InstantiatorException;

/**
 * Instantiator provides utility methods to build objects without invoking their constructors
 */
interface InstantiatorInterface
{
    /**
     * @throws InstantiatorException
     */
    public function instantiate(string $className) : object;
}
