<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\Controller;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    protected Controller $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Controller('Vendor\\Extension\\');
        $this->subject->setName('BlogController');
        $this->subject->setDirectory('Controller');
        $this->subject->setActionName('index');
    }

    /**
     * @test
     */
    public function generateControllerFileContentTest(): void
    {
        $expectedFileContent = <<<'EOF'
            <?php

            declare(strict_types=1);

            namespace Vendor\Extension\Controller;

            use Psr\Http\Message\ResponseInterface;
            use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

            class BlogController extends ActionController
            {
                public function indexAction(): ResponseInterface
                {
                    // Do awesome stuff
                    return $this->htmlResponse();
                }
            }

            EOF;

        self::assertEquals($expectedFileContent, $this->subject->__toString());
    }

    /**
     * @test
     */
    public function actionNameIsSanitized(): void
    {
        $this->subject->setActionName('listAction');
        self::assertEquals('list', $this->subject->getActionName());
    }

    /**
     * @test
     */
    public function actionNameWithoutSuffixIsPreserved(): void
    {
        $this->subject->setActionName('show');
        self::assertEquals('show', $this->subject->getActionName());
    }
}
