# Font provenance

| File | Bytes | SHA-256 |
| --- | --- | --- |
| `fonts/NotoSansSC-Regular.ttf` | 10,595,876 | `9cdb15629d85f80bc058033b0b3b5444d63f69e976e54a9ae4c2d6f37f96c565` |
| `fonts/NotoSansKR-Regular.ttf` | 6,224,812 | `adaf517dd462c1ad9da1e115c36975b4deb579aa1ad71364ad9f235a073b8398` |
| `fonts/OFL.txt` | 4,388 | `1c05c68c34f9708415aada51f17e1b0092d2cea709bf4a94cd38114f9e73d7d9` |

Both are static TrueType (`glyf`) instances at weight 400, with `OS/2.fsType` 0 (installable embedding, subsetting allowed). The PapyrusPDF overlay refuses variable fonts, and Google Fonts publishes these families only as variable fonts, so the static instances were made from them:

- Origin: <https://github.com/google/fonts> at commit `66928797f271fed5ee428544e7229685e2d90127`:
  - `ofl/notosanssc/NotoSansSC[wght].ttf`, SHA-256 `a3041811a78c361b1de50f953c805e0244951c21c5bd412f7232ef0d899af0da`;
  - `ofl/notosanskr/NotoSansKR[wght].ttf`, SHA-256 `194018e6b2b293a7964f037b25c0249ce1418bc9ab3c971060a03aa57861e252`;
  - `ofl/notosanssc/OFL.txt`, identical to `ofl/notosanskr/OFL.txt`, copied unmodified as `fonts/OFL.txt`.
- Instancing (a development step, not run by the package): `fonttools varLib.instancer 'NotoSansSC[wght].ttf' wght=400 --update-name-table`, and the same for KR, with fontTools 4.66.1.
- Check (2026-10-13): the variable sources were downloaded again at that commit and matched the hashes above. Re-instancing them gives files of the same size whose tables are byte-identical except `head.modified` and the `head.checkSumAdjustment` derived from it, so the committed files are those instances.

The upstream fonts are Noto Sans CJK, derived from Source Han Sans: "Copyright 2014-2021 Adobe (http://www.adobe.com/), with Reserved Font Name 'Source'". Instancing changes the font program, so these are Modified Versions under the OFL. They keep the upstream family names (`Noto Sans SC`, `Noto Sans KR`), which are not Reserved Font Names; the only Reserved Font Name, "Source", is not used. Google Fonts distributes the variable fonts under these names.
