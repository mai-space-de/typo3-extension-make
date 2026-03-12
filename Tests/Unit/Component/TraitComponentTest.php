<?php

declare(strict_types = 1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\TraitComponent;
use PHPUnit\Framework\TestCase;

class TraitComponentTest extends TestCase
{
    protected TraitComponent $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new TraitComponent('Vendor\\Extension\\');
        $this->subject->setName('HasTimestampsTrait');
        $this->subject->setDirectory('Trait');
    }

    /**
     * @test
     */
    public function generateTraitFileContentTest(): void
    {
        $expectedFileContent = <<<'EOF'
<?php

declare(strict_types = 1);

namespace Vendor\Extension\Trait;

trait HasTimestampsTrait
{
    // Add trait methods here
}

EOF;

        self::assertEquals($expectedFileContent, $this->subject->__toString());
    }

    /**
     * @test
     */
    public function traitClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Trait\\HasTimestampsTrait', $this->subject->getClassName());
    }
}
