<?php

declare(strict_types=1);

namespace PapyrusPDF\FontsCjk\Tests;

use PapyrusPDF\FontsCjk\NotoSansCjk;
use PapyrusPDF\Papyrus\Overlay\OverlayFontFile;
use PapyrusPDF\Papyrus\Overlay\OverlayFonts;
use PapyrusPDF\Papyrus\Overlay\OverlayRendererFactory;
use PHPUnit\Framework\TestCase;

final class NotoSansCjkTest extends TestCase
{
    /** The SHA-256 values recorded in PROVENANCE.md. */
    private const array SHA256 = [
        NotoSansCjk::SIMPLIFIED_CHINESE => '9cdb15629d85f80bc058033b0b3b5444d63f69e976e54a9ae4c2d6f37f96c565',
        NotoSansCjk::KOREAN => 'adaf517dd462c1ad9da1e115c36975b4deb579aa1ad71364ad9f235a073b8398',
    ];

    public function testTheFontsAreTheRecordedFiles(): void
    {
        self::assertSame([NotoSansCjk::path(NotoSansCjk::SIMPLIFIED_CHINESE), NotoSansCjk::path(NotoSansCjk::KOREAN)], NotoSansCjk::paths());
        foreach (self::SHA256 as $file => $sha256) {
            self::assertSame($sha256, hash_file('sha256', NotoSansCjk::path($file)), $file);
        }
        self::assertFileExists(dirname(__DIR__).'/notices/OFL.txt');
    }

    public function testLegacyConstantsAndNewTcPath(): void
    {
        self::assertSame('NotoSansSC-Regular.ttf', NotoSansCjk::SIMPLIFIED_CHINESE);
        self::assertSame('NotoSansKR-Regular.ttf', NotoSansCjk::KOREAN);
        self::assertSame('NotoSansJP-Regular.ttf', NotoSansCjk::JAPANESE);
        self::assertSame(\PapyrusPDF\FontsJa\NotoJa::path(\PapyrusPDF\FontsJa\NotoJa::SANS), NotoSansCjk::path(NotoSansCjk::JAPANESE));
        self::assertSame(\PapyrusPDF\FontsZhHant\NotoZhHant::path(\PapyrusPDF\FontsZhHant\NotoZhHant::SANS), NotoSansCjk::path(NotoSansCjk::TRADITIONAL_CHINESE));
        self::assertSame(['NotoSansSC-Regular.ttf', 'NotoSansKR-Regular.ttf'], array_map(basename(...), NotoSansCjk::paths()));
        self::assertSame([], glob(dirname(__DIR__).'/fonts/*.ttf'));
    }

    public function testFontFilesAreOverlayFallbacksInPathOrder(): void
    {
        $files = NotoSansCjk::fontFiles();

        self::assertSame(NotoSansCjk::paths(), array_map(static fn (OverlayFontFile $file): string => $file->path, $files));
        self::assertSame([0, 0], array_map(static fn (OverlayFontFile $file): int => $file->face, $files));
    }

    public function testTheOverlayDrawsChineseJapaneseAndKoreanWithThem(): void
    {
        $directory = sys_get_temp_dir().'/papyrus-fonts-cjk-'.bin2hex(random_bytes(6));
        self::assertTrue(mkdir($directory, 0700));
        try {
            $factory = new OverlayRendererFactory();
            $default = $factory->create($directory);
            $cjk = $factory->create($directory, null, OverlayFonts::bundled(NotoSansCjk::fontFiles()));
            $text = '王小明 東京都 ひらがな カタカナ 김민준 서울 Łukasz Дмитрий';

            self::assertFalse($default->supports($text));
            self::assertSame([], $cjk->unsupportedCharacters($text));
            self::assertSame(["\u{1F44D}"], $cjk->unsupportedCharacters("\u{1F44D} 王"));
        } finally {
            rmdir($directory);
        }
    }

    public function testUnknownFilesAreRefused(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        NotoSansCjk::path('../NotoSans-Regular.ttf');
    }
}
