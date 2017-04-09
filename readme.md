# SilverStripe Crazy Egg

[![Build Status](http://img.shields.io/travis/robbieaverill/silverstripe-crazy-egg.svg?style=flat-square)](https://travis-ci.org/robbieaverill/silverstripe-crazy-egg)
[![Code Quality](http://img.shields.io/scrutinizer/g/robbieaverill/silverstripe-crazy-egg.svg?style=flat-square)](https://scrutinizer-ci.com/g/robbieaverill/silverstripe-crazy-egg)
[![Version](http://img.shields.io/packagist/v/silverstripe/crazy-egg.svg?style=flat-square)](https://packagist.org/packages/silverstripe/silverstripe-crazy-egg)
[![License](http://img.shields.io/packagist/l/silverstripe/crazy-egg.svg?style=flat-square)](LICENSE.md)

Integrate Crazy Egg tracking.

## Overview

This module integrates Crazy Egg tracking with SilverStripe.

## Roadmap

- Create snapshots in CMS

## Requirements

- SilverStripe ^4.0
- PHP 5.6 or above

## Installation

```
$ composer require silverstripe/crazy-egg
```

You'll also need to run `dev/build`.

## Documentation

See the [docs/en](docs/en/introduction.md) folder.

## Versioning

This library follows [Semver](http://semver.org). According to Semver, you will be able to upgrade to any minor or patch version of this library without any breaking changes to the public API. Semver also requires that we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All other methods are not part of the public API. Where possible, we'll try to keep `protected` methods backwards-compatible in minor/patch versions, but if you're overriding methods then please test your work before upgrading.

## Reporting Issues

Please [create an issue](http://github.com/robbieaverill/silverstripe-crazy-egg/issues) for any bugs you've found, or features you're missing.
