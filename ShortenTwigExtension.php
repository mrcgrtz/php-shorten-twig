<?php

declare(strict_types=1);

namespace Marcgoertz\Shorten;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;
use Marcgoertz\Shorten\Shorten;

class ShortenTwigExtension extends AbstractExtension
{
    private Shorten $shorten;

    public function __construct()
    {
        $this->shorten = new Shorten();
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('shorten', [$this, 'shorten']),
        ];
    }

    /**
     * Shorten text or markup using the `marcgoertz/shorten` library.
     *
     * @param string $markup The text or markup to shorten
     * @param int $length The maximum length (default: `400`)
     * @param string $suffix The suffix (default: `'…'`)
     * @param bool $appendixInside Appendix inside tags (default: `false`)
     * @param bool $wordsafe Wordsafe truncation (default: `false`)
     * @param string $delimiter The delimiter for words (default: `' '`)
     * @return string The shortened text or markup
     */
    public function shorten(string $markup, int $length = 400, string $suffix = '…', bool $appendixInside = false, bool $wordsafe = false, string $delimiter = ' '): string
    {
        return $this->shorten->truncateMarkup($markup, $length, $suffix, $appendixInside, $wordsafe, $delimiter);
    }
}
