<?php

declare(strict_types=1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\Dto;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DtoTest extends TestCase
{
    protected Dto $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Dto('Vendor\\Extension\\');
        $this->subject->setName('UserDto');
        $this->subject->setDirectory('Dto');
    }

    #[Test]
    public function generateDtoFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Dto;', $content);
        self::assertStringContainsString('final class UserDto', $content);
    }

    #[Test]
    public function dtoClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Dto\\UserDto', $this->subject->getClassName());
    }
}
