# PapyrusPDF CJK fonts

Optional fonts for the PapyrusPDF (`vicam/papyrus-pdf`) overlay renderer: static Noto Sans SC Regular (Chinese Han, Japanese kana, bopomofo) and Noto Sans KR Regular (Korean Hangul), about 16.8 MB together. The library already includes Noto Sans for Latin, Greek and Cyrillic; install this package when signers may type Chinese, Japanese or Korean names.

The package is not on Packagist. Add its repository to your application's `composer.json`, then require it:

```json
{
    "repositories": [
        { "type": "vcs", "url": "https://github.com/vicam-consulting/papyrus-pdf-fonts-cjk.git" }
    ]
}
```

```bash
composer require vicam/papyrus-pdf-fonts-cjk:^0.1
```

Then turn the fonts on in one line:

```php
use PapyrusPDF\FontsCjk\NotoSansCjk;
use PapyrusPDF\PdfEngineFactory;
use PapyrusPDF\Stamp\OverlayFonts;

$overlay = (new PdfEngineFactory())->createOverlayRenderer($workspace, null, OverlayFonts::bundled(NotoSansCjk::fontFiles()));
```

- `NotoSansCjk::fontFiles()` returns both fonts as `OverlayFontFile` fallbacks, Chinese first. `NotoSansCjk::paths()` returns the plain file paths, and `NotoSansCjk::path(NotoSansCjk::KOREAN)` one of them.
- The overlay reads a CJK file only when text needs one of its characters, so Latin-only documents never load them. Loading takes about 50 ms and 17–23 MiB per font the first time a renderer needs it.
- Bold certificate rows draw CJK characters in the regular weight; there is no bold CJK face.
- Han characters in Korean text use the Chinese font's glyph forms, because it is listed first. To prefer Korean forms, list the Korean font first: `OverlayFonts::bundled(array_reverse(NotoSansCjk::fontFiles()))`.

Requires `vicam/papyrus-pdf` 0.2.1 or later. Run the tests with `composer install && composer test`.

## Licence

The fonts are under the SIL Open Font License 1.1 ([`fonts/OFL.txt`](fonts/OFL.txt)); see [PROVENANCE.md](PROVENANCE.md) and [LICENSE.md](LICENSE.md).
