<?php

declare(strict_types=1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    protected Event $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Event('Vendor\\Extension\\');
        $this->subject->setName('UserRegisteredEvent');
        $this->subject->setDirectory('Event');
    }

    /**
     * @test
     */
    public function generateEventFileContentTest(): void
    {
        $expectedFileContent = <<<'EOF'
<?php

declare(strict_types=1);

namespace Vendor\Extension\Event;

final class UserRegisteredEvent
{
    // Add event properties and constructor here
}

EOF;

        self::assertEquals($expectedFileContent, $this->subject->__toString());
    }

    /**
     * @test
     */
    public function eventClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Event\\UserRegisteredEvent', $this->subject->getClassName());
    }
}
