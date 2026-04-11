<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\ExceptionComponent;
use PHPUnit\Framework\TestCase;

class ExceptionComponentTest extends TestCase
{
    protected ExceptionComponent $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new ExceptionComponent('Vendor\\Extension\\');
        $this->subject->setName('InvalidArgumentException');
        $this->subject->setDirectory('Exception');
    }

    /**
     * @test
     */
    public function generateExceptionFileContentTest(): void
    {
        $expectedFileContent = <<<'EOF'
            <?php

            declare(strict_types=1);

            namespace Vendor\Extension\Exception;

            class InvalidArgumentException extends \RuntimeException
            {
            }

            EOF;

        self::assertEquals($expectedFileContent, $this->subject->__toString());
    }

    /**
     * @test
     */
    public function customParentClassIsApplied(): void
    {
        $this->subject->setParentClass('\\LogicException');

        $content = $this->subject->__toString();
        self::assertStringContainsString('extends \\LogicException', $content);
    }

    /**
     * @test
     */
    public function parentClassLeadingBackslashIsNormalized(): void
    {
        $this->subject->setParentClass('RuntimeException');
        self::assertEquals('\\RuntimeException', $this->subject->getParentClass());
    }

    /**
     * @test
     */
    public function exceptionClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Exception\\InvalidArgumentException', $this->subject->getClassName());
    }
}
