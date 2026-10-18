<?php

declare(strict_types=1);

namespace Vicam\Pdf\FontsCjk;

use Vicam\Pdf\Forms\{FormFontFallbacks, FormFontPackage};

/** Static Regular Noto faces for automatic region- and style-aware form fallback. */
final class NotoCjk implements FormFontPackage
{
    /** Files are loaded lazily by Vicam PDF; only appearance glyphs are subset-embedded. */
    public static function formFallbacks(): FormFontFallbacks
    {
        return new FormFontFallbacks(
            japaneseSans: \Vicam\Pdf\FontsJa\NotoJa::path(\Vicam\Pdf\FontsJa\NotoJa::SANS),
            japaneseSerif: \Vicam\Pdf\FontsJa\NotoJa::path(\Vicam\Pdf\FontsJa\NotoJa::SERIF),
            chineseSans: \Vicam\Pdf\FontsZhHans\NotoZhHans::path(\Vicam\Pdf\FontsZhHans\NotoZhHans::SANS),
            chineseSerif: \Vicam\Pdf\FontsZhHans\NotoZhHans::path(\Vicam\Pdf\FontsZhHans\NotoZhHans::SERIF),
            koreanSans: \Vicam\Pdf\FontsKo\NotoKo::path(\Vicam\Pdf\FontsKo\NotoKo::SANS),
            koreanSerif: \Vicam\Pdf\FontsKo\NotoKo::path(\Vicam\Pdf\FontsKo\NotoKo::SERIF),
            traditionalChineseSans: \Vicam\Pdf\FontsZhHant\NotoZhHant::path(\Vicam\Pdf\FontsZhHant\NotoZhHant::SANS),
            traditionalChineseSerif: \Vicam\Pdf\FontsZhHant\NotoZhHant::path(\Vicam\Pdf\FontsZhHant\NotoZhHant::SERIF),
        );
    }
}
