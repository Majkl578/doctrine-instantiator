<?php

declare(strict_types=1);

namespace DoctrineTest\InstantiatorTest\Exception;

use Doctrine\Instantiator\Exception\UnexpectedValue;
use DoctrineTest\InstantiatorTestAsset\AbstractClassAsset;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use function sprintf;

/**
 * Tests for {@see \Doctrine\Instantiator\Exception\UnexpectedValueException}
 *
 * @covers \Doctrine\Instantiator\Exception\UnexpectedValue
 */
class UnexpectedValueExceptionTest extends TestCase
{
    public function testFromSerializationTriggeredException() : void
    {
        $reflectionClass = new ReflectionClass($this);
        $previous        = new Exception();
        $exception       = UnexpectedValue::fromSerializationTriggeredException($reflectionClass, $previous);

        self::assertInstanceOf(UnexpectedValue::class, $exception);
        self::assertSame($previous, $exception->getPrevious());
        self::assertSame(
            'An exception was raised while trying to instantiate an instance of "'
            . self::class . '" via un-serialization',
            $exception->getMessage()
        );
    }

    public function testFromUncleanUnSerialization() : void
    {
        $reflection = new ReflectionClass(AbstractClassAsset::class);
        $exception  = UnexpectedValue::fromUncleanUnSerialization($reflection, 'foo', 123, 'bar', 456);

        self::assertInstanceOf(UnexpectedValue::class, $exception);
        self::assertSame(
            sprintf(
                'Could not produce an instance of "%s" '
                . 'via un-serialization, since an error was triggered in file "bar" at line "456"',
                AbstractClassAsset::class
            ),
            $exception->getMessage()
        );

        $previous = $exception->getPrevious();

        self::assertInstanceOf(Exception::class, $previous);
        self::assertSame('foo', $previous->getMessage());
        self::assertSame(123, $previous->getCode());
    }
}
