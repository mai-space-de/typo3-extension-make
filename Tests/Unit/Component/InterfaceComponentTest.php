<?php

declare(strict_types = 1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\InterfaceComponent;
use PHPUnit\Framework\TestCase;

class InterfaceComponentTest extends TestCase
{
    protected InterfaceComponent $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new InterfaceComponent('Vendor\\Extension\\');
        $this->subject->setName('UserRepositoryInterface');
        $this->subject->setDirectory('Domain/Repository');
    }

    /**
     * @test
     */
    public function generateInterfaceFileContentTest(): void
    {
        $expectedFileContent = <<<'EOF'
            <?php

            declare(strict_types=1);

            namespace Vendor\Extension\Domain\Repository;

            interface UserRepositoryInterface
            {
                // Add interface methods here
            }

            EOF;

        self::assertEquals($expectedFileContent, $this->subject->__toString());
    }

    /**
     * @test
     */
    public function interfaceClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Domain\\Repository\\UserRepositoryInterface', $this->subject->getClassName());
    }
}
