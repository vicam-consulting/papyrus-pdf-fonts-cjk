<?php

declare(strict_types=1);

namespace PapyrusPDF\FontsCjk;

use PapyrusPDF\Forms\{FormFontFallbacks, FormFontPackage};

/** Static Regular Noto faces for automatic region- and style-aware form fallback. */
final class NotoCjk implements FormFontPackage
{
    /** Files are loaded lazily by PapyrusPDF; only appearance glyphs are subset-embedded. */
    public static function formFallbacks(): FormFontFallbacks
    {
        return new FormFontFallbacks(
            japaneseSans: \PapyrusPDF\FontsJa\NotoJa::path(\PapyrusPDF\FontsJa\NotoJa::SANS),
            japaneseSerif: \PapyrusPDF\FontsJa\NotoJa::path(\PapyrusPDF\FontsJa\NotoJa::SERIF),
            chineseSans: \PapyrusPDF\FontsZhHans\NotoZhHans::path(\PapyrusPDF\FontsZhHans\NotoZhHans::SANS),
            chineseSerif: \PapyrusPDF\FontsZhHans\NotoZhHans::path(\PapyrusPDF\FontsZhHans\NotoZhHans::SERIF),
            koreanSans: \PapyrusPDF\FontsKo\NotoKo::path(\PapyrusPDF\FontsKo\NotoKo::SANS),
            koreanSerif: \PapyrusPDF\FontsKo\NotoKo::path(\PapyrusPDF\FontsKo\NotoKo::SERIF),
            traditionalChineseSans: \PapyrusPDF\FontsZhHant\NotoZhHant::path(\PapyrusPDF\FontsZhHant\NotoZhHant::SANS),
            traditionalChineseSerif: \PapyrusPDF\FontsZhHant\NotoZhHant::path(\PapyrusPDF\FontsZhHant\NotoZhHant::SERIF),
        );
    }
}
