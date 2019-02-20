#Upgrade to 2.0

## Package exception renamed to ``Doctrine\Instantiator\Exception\InstantiatorException``

The exception ``Doctrine\Instantiator\Exception\ExceptionInterface`` has been renamed to ``Doctrine\Instantiator\Exception\InstantiatorException``.

## Natively typed ``Doctrine\Instantiator\InstantiatorInterface::instantiate()``

The ``Doctrine\Instantiator\InstantiatorInterface::instantiate()`` method now declares its argument as ``string`` and return value as ``object``.

## PHP 7.2 required

PHP 7.2 is now the minimum supported version.