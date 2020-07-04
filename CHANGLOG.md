# Release Notes

## [Unreleased](https://github.com/ishanvyas22/cakephpvue-spa/compare/1.1.2...master)

## [1.1.2](https://github.com/ishanvyas22/cakephpvue-spa/compare/1.1.1...1.1.2)

### Added
- Adds CHANGLOG.md file ([#15](https://github.com/ishanvyas22/cakephpvue-spa/pull/15))

### Changed
- Bump `acorn` from 6.3.0 to 6.4.1 ([#13](https://github.com/ishanvyas22/cakephpvue-spa/pull/13))
- Bump `websocket-extensions` from 0.1.3 to 0.1.4 ([#14](https://github.com/ishanvyas22/cakephpvue-spa/pull/14))
- Add `ext-json` dependency in composer.json file ([eeae332](https://github.com/ishanvyas22/cakephpvue-spa/commit/eeae3323aec028d3d9fbe37b5a25df9270e68ac4))
- Update cakephp codesniffer package ([0438dc0](https://github.com/ishanvyas22/cakephpvue-spa/commit/0438dc0f6f7ebbadfef6e1467411d023ac58d7dd))

### Fixed
- Warning: The lock file is not up to date with the latest changes in composer.json. ([5cca1be](https://github.com/ishanvyas22/cakephpvue-spa/commit/5cca1be214881e93100a83d2a21b8fbdf542ccf4))
- Phpstan errors ([12f29d5](https://github.com/ishanvyas22/cakephpvue-spa/commit/12f29d5cd5e5bf14cd55002f1e08c3746c5c611c))

### Removed
- Remove cs check from webroot directory ([99b3c7a](https://github.com/ishanvyas22/cakephpvue-spa/commit/99b3c7aef032bb47de61cd5f669edbd53a250807))

## [1.1.1 (2019-11-09)](https://github.com/ishanvyas22/cakephpvue-spa/compare/1.1.0...1.1.1)

### Added
- Add Total Downloads, Latest Stable Version badges ([c2da9b5](https://github.com/ishanvyas22/cakephpvue-spa/pull/11/commits/c2da9b5b4ee62059559694f181a5ef2b10dd591b))

### Changed
- Update README.md to specify [Asset Mix](https://github.com/ishanvyas22/asset-mix) plugin ([c7fe2b8](https://github.com/ishanvyas22/cakephpvue-spa/pull/11/commits/c7fe2b89e5c1b42a1ae40c6f8aa4e04987f410b9))
- Upgrade project dependencies

### Fixed
- Travis build

## [1.1.0 (2019-10-28)](https://github.com/ishanvyas22/cakephpvue-spa/compare/1.0.3...1.1.0)

### Added
- Dependency of [AssetMix](https://packagist.org/packages/ishanvyas22/asset-mix) plugin

### Changed
- Call script files generated from Laravel Mix from AssetMix plugin
- Call css files generated from Laravel Mix from AssetMix plugin

## [1.0.3 (2019-10-26)](https://github.com/ishanvyas22/cakephpvue-spa/compare/1.0.2...1.0.3)

### Added
- Test for `PostsController::index` method
- MIT License added

### Changed
- Upgrade CakePHP version from 3.6.* to 3.8.* ([9220922](https://github.com/ishanvyas22/cakephpvue-spa/commit/92209220cfa5e8381479ebc47c4f62fe2a9e7202))
- Upgrade laravel mix version
- Travis CI config changes

## [1.0.2 (2019-05-09)](https://github.com/ishanvyas22/cakephpvue-spa/compare/1.0.1...1.0.2)

### Fixed
- Uncaught Error: Cannot find module "moment" ([#6](https://github.com/ishanvyas22/cakephpvue-spa/issues/6))

## [1.0.1 (2019-04-23)](https://github.com/ishanvyas22/cakephpvue-spa/compare/1.0.0...1.0.1)

### Added
- Instruction to install package via composer in README.md file
- Safelist `master` branch for travis ci ([#4](https://github.com/ishanvyas22/cakephpvue-spa/pull/4))

## [1.0.0 (2019-04-14)]

### Added
- Basic skeleton ready to use for CakePHP + Vue.js application.