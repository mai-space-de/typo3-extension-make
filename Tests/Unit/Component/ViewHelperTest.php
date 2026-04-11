<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\ViewHelper;
use PHPUnit\Framework\TestCase;

class ViewHelperTest extends TestCase
{
    protected ViewHelper $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new ViewHelper('Vendor\\Extension\\');
        $this->subject->setName('FormatDateViewHelper');
        $this->subject->setDirectory('ViewHelpers');
    }

    /**
     * @test
     */
    public function generateViewHelperFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\ViewHelpers;', $content);
        self::assertStringContainsString('class FormatDateViewHelper extends AbstractViewHelper', $content);
        self::assertStringContainsString('public function initializeArguments(): void', $content);
        self::assertStringContainsString('public static function renderStatic(', $content);
        self::assertStringContainsString('RenderingContextInterface $renderingContext', $content);
    }

    /**
     * @test
     */
    public function viewHelperClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\ViewHelpers\\FormatDateViewHelper', $this->subject->getClassName());
    }
}
