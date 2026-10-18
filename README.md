# PapyrusPDF CJK font umbrella

```sh
composer require vicam/papyrus-pdf-fonts-cjk:^0.4.0
```

This compatibility umbrella requires four free language packs: `fonts-ja`,
`fonts-zh-hans`, `fonts-zh-hant` and `fonts-ko` (all prefixed `vicam/papyrus-pdf-`).
It contains no font binaries. PHP 8.3+ and PapyrusPDF ^0.3.4 are required.
Install just the needed language pack to reduce download and deployment size.

The `PapyrusPDF\FontsCjk\NotoCjk::formFallbacks()` API still provides JP, SC and KR
Sans/Serif files, now in their packages, and additionally TC Sans/Serif. Automatic
form discovery works without application changes. CNS1 and zh-Hant hints select
TC regional shapes. Japanese never uses Chinese shapes.

`PapyrusPDF\FontsCjk\NotoSansCjk` keeps its constants, `path()`, `paths()` and
`fontFiles()`. The latter two still return **SC then KR only**, preserving overlay
behaviour. `JAPANESE` still resolves JP; `TRADITIONAL_CHINESE` is a new opt-in path.
For Japanese or Traditional Chinese overlays, put the corresponding
`new OverlayFontFile(NotoSansCjk::path(...))` first in your fallback list.
No synthetic bold or italic. Each language pack records its font provenance and
ships unmodified SIL OFL licence texts. PHP package licence terms are unchanged.
