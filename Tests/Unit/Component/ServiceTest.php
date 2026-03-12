<?php

declare(strict_types=1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\Service;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    protected Service $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Service('Vendor\\Extension\\');
        $this->subject->setName('UserService');
        $this->subject->setDirectory('Service');
    }

    /**
     * @test
     */
    public function generateServiceFileContentTest(): void
    {
        $expectedFileContent = <<<'EOF'
<?php

declare(strict_types=1);

namespace Vendor\Extension\Service;

class UserService
{
    // Add service methods here
}

EOF;

        self::assertEquals($expectedFileContent, $this->subject->__toString());
    }

    /**
     * @test
     */
    public function serviceClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Service\\UserService', $this->subject->getClassName());
    }
}
