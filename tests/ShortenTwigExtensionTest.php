<?php

declare(strict_types=1);

namespace Marcgoertz\Shorten;

use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Marcgoertz\Shorten\ShortenTwigExtension;

final class ShortenTwigExtensionTest extends TestCase
{
    private Environment $twig;

    protected function setUp(): void
    {
        $loader = new ArrayLoader();
        $this->twig = new Environment($loader);
        $this->twig->addExtension(new ShortenTwigExtension());
    }

    public function testShortenFilter()
    {
        $template = $this->twig->createTemplate('{{ text|shorten(10) }}');
        $result = $template->render(['text' => 'This is a very long text']);

        $this->assertEquals('This is a …', $result);
    }

    public function testShortenFilterWithCustomSuffix()
    {
        $template = $this->twig->createTemplate('{{ text|shorten(10, " [more]") }}');
        $result = $template->render(['text' => 'This is a very long text']);

        $this->assertEquals('This is a  [more]', $result);
    }

    public function testShortenFilterWithBreakWords()
    {
        $template = $this->twig->createTemplate('{{ text|shorten(8, "…", true) }}');
        $result = $template->render(['text' => 'This is a text']);

        $this->assertEquals('This is …', $result);
    }

    public function testShortenFilterWithShortText()
    {
        $template = $this->twig->createTemplate('{{ text|shorten(100) }}');
        $result = $template->render(['text' => 'Short text']);

        $this->assertEquals('Short text', $result);
    }

    public function testShortenFilterWithEmptyText()
    {
        $template = $this->twig->createTemplate('{{ text|shorten(10) }}');
        $result = $template->render(['text' => '']);

        $this->assertEquals('', $result);
    }

    public function testShortenFilterWithGermanText()
    {
        $template = $this->twig->createTemplate('{{ text|shorten(20) }}');
        $result = $template->render(['text' => 'Dies ist ein sehr langer deutscher Text']);

        $this->assertEquals('Dies ist ein sehr la…', $result);
    }
}
