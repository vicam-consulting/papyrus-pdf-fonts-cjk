<?php

declare(strict_types=1);

namespace PapyrusPDF\FontsCjk;

use PapyrusPDF\Stamp\OverlayFontFile;

/**
 * Static Noto Sans SC and Noto Sans KR Regular, for overlay text in Chinese, Japanese kana and Korean.
 *
 * Pass them as fallbacks: `OverlayFonts::bundled(NotoSansCjk::fontFiles())`. The overlay reads each file only when
 * text needs one of its characters. Both fonts are under the SIL Open Font License 1.1; see fonts/OFL.txt.
 */
final class NotoSansCjk
{
    /** Simplified and Traditional Chinese (Han), Japanese kana and bopomofo; about 10.6 MB. */
    public const string SIMPLIFIED_CHINESE = 'NotoSansSC-Regular.ttf';

    /** Korean Hangul; about 6.2 MB. Han characters come from the Chinese font when it is listed first. */
    public const string KOREAN = 'NotoSansKR-Regular.ttf';

    /** The absolute path of one of the bundled font files, such as self::KOREAN. */
    public static function path(string $file): string
    {
        if (!in_array($file, [self::SIMPLIFIED_CHINESE, self::KOREAN], true)) {
            throw new \InvalidArgumentException('Unknown CJK font file.');
        }

        return dirname(__DIR__).'/fonts/'.$file;
    }

    /**
     * Absolute paths of both fonts, Chinese first.
     *
     * @return list<string>
     */
    public static function paths(): array
    {
        return [self::path(self::SIMPLIFIED_CHINESE), self::path(self::KOREAN)];
    }

    /**
     * Both fonts as lazily read overlay fallbacks, Chinese first.
     *
     * @return list<OverlayFontFile>
     */
    public static function fontFiles(): array
    {
        return array_map(static fn (string $path): OverlayFontFile => new OverlayFontFile($path), self::paths());
    }
}
