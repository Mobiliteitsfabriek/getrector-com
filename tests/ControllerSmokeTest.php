<?php

declare(strict_types=1);

namespace Rector\Website\Tests;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

final class ControllerSmokeTest extends WebTestCase
{
    #[DataProvider('provideUrls')]
    public function test(string $url): void
    {
        $kernelBrowser = $this->createClient();
        $kernelBrowser->request(Request::METHOD_GET, $url);

        $this->assertResponseIsSuccessful();
    }

    public static function provideUrls(): Iterator
    {
        yield ['/'];
        yield ['/blog'];
        yield ['/book'];
        yield ['/demo'];
        yield ['/contact'];
        yield ['/hire-team'];
    }
}
