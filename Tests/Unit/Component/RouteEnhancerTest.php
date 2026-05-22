<?php

declare(strict_types=1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\RouteEnhancer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RouteEnhancerTest extends TestCase
{
    protected RouteEnhancer $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new RouteEnhancer('Vendor\\Extension\\');
        $this->subject->setName('BlogRouteEnhancer');
        $this->subject->setDirectory('Routing/Enhancer');
    }

    #[Test]
    public function generateRouteEnhancerFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Routing\Enhancer;', $content);
        self::assertStringContainsString('class BlogRouteEnhancer implements EnhancerInterface', $content);
        self::assertStringContainsString('public function enhanceForMatching(RouteCollection $collection): void', $content);
        self::assertStringContainsString('public function enhanceForGeneration(RouteCollection $collection, array $originalParameters): void', $content);
    }

    #[Test]
    public function routeEnhancerClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Routing\\Enhancer\\BlogRouteEnhancer', $this->subject->getClassName());
    }
}
