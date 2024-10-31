<?php

declare(strict_types=1);

namespace Database\Factories\Tools;

use Faker\Provider\Lorem;
use InvalidArgumentException;

class MarkdownFakerProvider extends Lorem
{
    public static function markdown(): string
    {
        $parts = [
            self::markdownH1(),
            self::markdownP(),
        ];

        do {
            $parts[] = self::markdownH2();

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownP();
            }

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownBlockquote();
            }

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownBulletedList();
            }

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownNumberedList();
            }

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownCode();
            }

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownInlineCode();
            }

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownInlineItalic();
            }

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownInlineBold();
            }

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownInlineLink();
            }

            if (self::randomDigit() > 3) {
                $parts[] = self::markdownInlineImg();
            }

        } while (self::randomDigit() > 5 || count($parts) < 3);

        return implode("\n\n", $parts);
    }

    public static function markdownP(int $maxNbChars = 200): string
    {
        return (new MarkdownBuilder())->p(self::text($maxNbChars))->getMarkdown();
    }

    public static function markdownH1(int $nbWords = 6, bool $variableNbWords = true): string
    {
        return (new MarkdownBuilder())->h1(self::sentence($nbWords, $variableNbWords))->getMarkdown();
    }

    public static function markdownH2(int $nbWords = 6, bool $variableNbWords = true): string
    {
        return (new MarkdownBuilder())->h2(self::sentence($nbWords, $variableNbWords))->getMarkdown();
    }

    public static function markdownH3(int $nbWords = 6, bool $variableNbWords = true): string
    {
        return (new MarkdownBuilder())->h3(self::sentence($nbWords, $variableNbWords))->getMarkdown();
    }

    public static function markdownBlockquote(int $maxNbChars = 200): string
    {
        return (new MarkdownBuilder())->blockquote(self::text($maxNbChars))->getMarkdown();
    }

    public static function markdownBulletedList(int $nb = 3): string
    {
        $list = self::sentences($nb);

        if (!is_array($list)) {
            throw new InvalidArgumentException('faker "sentences" should return an array');
        }

        return (new MarkdownBuilder())->bulletedList($list)->getMarkdown();
    }

    public static function markdownNumberedList(int $nb = 3): string
    {
        $list = self::sentences($nb);

        if (!is_array($list)) {
            throw new InvalidArgumentException('faker "sentences" should return an array');
        }

        return (new MarkdownBuilder())->numberedList($list)->getMarkdown();
    }

    public static function markdownCode(int $maxNbChars = 200): string
    {
        return (new MarkdownBuilder())->code("export default function testComponent({\n\tstate,\n}) {\n\treturn {\n\t\tstate,\n\t\tinit: function () {\n\t\t\t// Initialise the Alpine component here, if you need to.\n\t\t},\n\t}\n}", 'javascript')->getMarkdown();
    }

    public static function markdownInlineCode(): string
    {
        return (new MarkdownBuilder())->inlineCode(self::word());
    }

    public static function markdownInlineItalic(): string
    {
        return (new MarkdownBuilder())->inlineItalic(self::word());
    }

    public static function markdownInlineBold(): string
    {
        return (new MarkdownBuilder())->inlineBold(self::word());
    }

    public static function markdownInlineLink(): string
    {
        return (new MarkdownBuilder())->inlineLink('http://google.com', self::word());
    }

    public static function markdownInlineImg(): string
    {
        return (new MarkdownBuilder())->inlineImg(
            'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Einstein_1921_portrait2.jpg/800px-Einstein_1921_portrait2.jpg',
            self::word()
        );
    }
}
