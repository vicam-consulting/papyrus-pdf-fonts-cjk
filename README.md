# PapyrusPDF CJK fonts

Optional static Noto Sans and Noto Serif **JP, SC and KR Regular**, under SIL OFL
1.1. Font files and provenance stay in this package, outside the core library.

```sh
composer require vicam/papyrus-pdf-fonts-cjk
```

With PapyrusPDF 0.2.10+, `PdfEngineFactory` discovers `NotoCjk` automatically.
`fillForm()` and stored-value refresh use these fonts only when the source font
and explicit caller fonts cannot draw the displayed text. No caller font loading
is needed. Mincho/Min/Ming/Song/Batang/Myeongjo/serif requests select Serif;
Gothic/Go/Hei/Dotum/Gulim/sans select Sans. Kana and Hangul disambiguate text;
otherwise the source CID collection/CMap and face select JP, SC or KR. Japanese
never falls through to SC. CNS1 uses the SC face: Traditional Chinese regional
shape parity is not claimed. Unknown shared-Han text needs a regional source
hint or an explicit caller font.

The report includes `form.font-substituted` and `fontSubstitutions` with the field,
requested face and replacement face. Fonts are loaded lazily once per engine,
and appearances subset-embed used glyphs. Stored-value editable refresh keeps
the original editing DA; subsequent viewer editing may use viewer fonts.

Disable discovery with `new PdfEngineFactory(discoverFormFonts: false)`, or inject
`formFallbacks: NotoCjk::formFallbacks()` once at application setup. Explicit
request fonts retain priority. Old package releases keep their overlay-only
behaviour when used with new core releases.

## Overlays

The existing helper keeps its SC/KR order for compatibility:

```php
use PapyrusPDF\FontsCjk\NotoSansCjk;
use PapyrusPDF\Stamp\OverlayFonts;

$fonts = OverlayFonts::bundled(NotoSansCjk::fontFiles());
```

For Japanese overlays, put `new OverlayFontFile(NotoSansCjk::path(NotoSansCjk::JAPANESE))`
first in your fallback list. Form region/style matching is independent of that
legacy overlay helper. Regular weights only; no synthetic bold/italic.

See [PROVENANCE.md](PROVENANCE.md), `fonts/OFL.txt` and `fonts/OFL-Serif.txt` for
upstream URLs, versions, build method, checksums and licence grants. The PHP
package retains its existing licence; the font licences permit redistribution.
