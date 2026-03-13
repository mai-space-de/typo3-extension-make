<?php

declare(strict_types = 1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    protected Validator $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Validator('Vendor\\Extension\\');
        $this->subject->setName('NotEmptyValidator');
        $this->subject->setDirectory('Validator');
    }

    /**
     * @test
     */
    public function generateValidatorFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Validator;', $content);
        self::assertStringContainsString('class NotEmptyValidator extends AbstractValidator', $content);
        self::assertStringContainsString('protected function isValid(mixed $value): void', $content);
    }

    /**
     * @test
     */
    public function validatorClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Validator\\NotEmptyValidator', $this->subject->getClassName());
    }
}
