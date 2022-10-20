# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.0.4
### Changed
- Convert Interop Containers to PSR

## 1.0.2 - 2021-11-05
### Changed
- Employees assigned department based on PTG, not DEPT CODE
Any employee included in import is marked as Active.  Flush out old
employees by marking them all as inactive before running import.
- Remove auto generated email address on import.  Emails update on
relationship.

## 1.0.1 - 2021-10-28
### Added
- Retrieve list of all employees from Department Model.

## 1.0.0 - 2021-10-06