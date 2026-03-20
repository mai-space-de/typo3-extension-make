<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\TypeConverter;
use PHPUnit\Framework\TestCase;

class TypeConverterTest extends TestCase
{
    protected TypeConverter $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new TypeConverter('Vendor\\Extension\\');
        $this->subject->setName('StringToDateTimeConverter');
        $this->subject->setDirectory('Property/TypeConverter');
    }

    /**
     * @test
     */
    public function generateTypeConverterFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Property\TypeConverter;', $content);
        self::assertStringContainsString('class StringToDateTimeConverter extends AbstractTypeConverter', $content);
        self::assertStringContainsString('public function convertFrom(', $content);
    }

    /**
     * @test
     */
    public function typeConverterClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Property\\TypeConverter\\StringToDateTimeConverter', $this->subject->getClassName());
    }
}
