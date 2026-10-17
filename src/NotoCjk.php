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
        $directory = dirname(__DIR__).'/fonts/';

        return new FormFontFallbacks(
            japaneseSans: $directory.'NotoSansJP-Regular.ttf',
            japaneseSerif: $directory.'NotoSerifJP-Regular.ttf',
            chineseSans: $directory.'NotoSansSC-Regular.ttf',
            chineseSerif: $directory.'NotoSerifSC-Regular.ttf',
            koreanSans: $directory.'NotoSansKR-Regular.ttf',
            koreanSerif: $directory.'NotoSerifKR-Regular.ttf',
        );
    }
}
