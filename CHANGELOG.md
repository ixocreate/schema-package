# Release Notes

## [Unreleased](https://github.com/ixocreate/schema-package/compare/0.2.19...develop)

## [v0.2.19 (2020-05-13)](https://github.com/ixocreate/schema-package/compare/0.2.18...0.2.19)
### Added
- Add Countable Interface to CollectionType
- Add TableElement

## [v0.2.18 (2020-01-28)](https://github.com/ixocreate/schema-package/compare/0.2.17...0.2.18)
### Fixed
- Fix Integer TypeCheck

## [v0.2.17 (2019-11-06)](https://github.com/ixocreate/schema-package/compare/0.2.16...0.2.17)
### Added
- LinkListInterface

## [v0.2.16 (2019-10-14)](https://github.com/ixocreate/schema-package/compare/0.2.13...0.2.16)
### Changed
- HtmlType: allow to return a value even when delta or html is empty
- Less strict php native type checks for backwards compatibility

## [v0.2.13 (2019-08-02)](https://github.com/ixocreate/schema-package/compare/0.2.12...0.2.13)
### Fixed
- DateTimeType loading by DateTimeImmutable::createFromMutable

## [v0.2.12 (2019-07-31)](https://github.com/ixocreate/schema-package/compare/0.2.11...0.2.12)
### Changed
- Changed few method visibilities to public in Type to avoid duplicate code
- More lazy DateTimeType

## [v0.2.11 (2019-07-2)](https://github.com/ixocreate/schema-package/compare/0.2.10...0.2.11)
### Added
- MultiSelect element `createNewDeferred` option

## [v0.2.10 (2019-07-17)](https://github.com/ixocreate/schema-package/compare/0.2.9...0.2.10)
### Fixed
- Uuid recursion error

## [v0.2.9 (2019-07-16)](https://github.com/ixocreate/schema-package/compare/0.2.8...0.2.9)
### Changed
- Performance optimization for uuid type 

## [v0.2.8 (2019-07-10)](https://github.com/ixocreate/schema-package/compare/0.2.7...0.2.8)
### Fixed
- Fix external link type

## [v0.2.7 (2019-06-04)](https://github.com/ixocreate/schema-package/compare/0.2.6...0.2.7)
### Fixed
- request BuilderInterface instead of Builder

## [v0.2.6 (2019-05-29)](https://github.com/ixocreate/schema-package/compare/0.2.5...0.2.6)
### Added
- Builder Factory

## [v0.2.5 (2019-05-29)](https://github.com/ixocreate/schema-package/compare/0.2.4...0.2.5)
### Fixed
- Builder as BuilderInterface named service 

## [v0.2.4 (2019-05-29)](https://github.com/ixocreate/schema-package/compare/0.2.3...0.2.4)
### Changed
- Switched to ixocreate/quill-renderer
### Fixed
- SchemaType transform for transformable elements

## [v0.2.3 (2019-05-27)](https://github.com/ixocreate/schema-package/compare/0.2.2...0.2.3)
### Fixed
- Travis build clover output

## [v0.2.2 (2019-05-27)](https://github.com/ixocreate/schema-package/compare/0.2.1...0.2.2)
### Added
- Link bootstrap item & LinkManager 
### Changed
- Use LinkManager for LinkType

## [v0.2.1 (2019-05-20)](https://github.com/ixocreate/schema-package/compare/0.2.0...0.2.1)
### Fixed
- Missing StructuralGroupingInterface import in Schema class
- Schema::withElements() calling removed function

## [v0.2.0 (2019-05-06)](https://github.com/ixocreate/schema-package/compare/0.1.0...0.2.0)
### Changed
- Merged with Type package, moved CMS and Media specific Elements to their respective packages
- Upgrade to Application v0.2
- Drop Type Package

## [v0.1.0 (2019-04-19)](https://github.com/ixocreate/schema-package/compare/master...0.1.0)
### Changed
- Consolidate Package
