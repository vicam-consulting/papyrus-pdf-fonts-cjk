<?php

declare(strict_types=1);

namespace PapyrusPDF\FontsCjk;

use PapyrusPDF\Papyrus\Overlay\OverlayFontFile;

/**
 * Static Noto Sans SC and Noto Sans KR Regular, for overlay text in Chinese, Japanese kana and Korean.
 *
 * Pass them as fallbacks: `OverlayFonts::bundled(NotoSansCjk::fontFiles())`. The overlay reads each file only when
 * text needs one of its characters. Both fonts are under the SIL Open Font License 1.1; see notices/OFL.txt.
 */
final class NotoSansCjk
{
    /** Simplified Chinese (Han), Japanese kana and bopomofo; about 10.6 MB. */
    public const string SIMPLIFIED_CHINESE = 'NotoSansSC-Regular.ttf';

    /** Korean Hangul; about 6.2 MB. Han characters come from the Chinese font when it is listed first. */
    public const string KOREAN = 'NotoSansKR-Regular.ttf';

    public const string JAPANESE = 'NotoSansJP-Regular.ttf';

    public const string TRADITIONAL_CHINESE = 'NotoSansTC-Regular.ttf';

    /** The absolute path of one of the bundled font files, such as self::KOREAN. */
    public static function path(string $file): string
    {
        return match ($file) {
            self::SIMPLIFIED_CHINESE => \PapyrusPDF\FontsZhHans\NotoZhHans::path($file),
            self::KOREAN => \PapyrusPDF\FontsKo\NotoKo::path($file),
            self::JAPANESE => \PapyrusPDF\FontsJa\NotoJa::path($file),
            self::TRADITIONAL_CHINESE => \PapyrusPDF\FontsZhHant\NotoZhHant::path($file),
            default => throw new \InvalidArgumentException('Unknown CJK font file.'),
        };
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
