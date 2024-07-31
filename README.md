<p align="center">
    <img src="https://raw.githubusercontent.com/calebdw/larastan/master/docs/logo.png" alt="Larastan Logo" width="300">
    <br><br>
    <img src="https://raw.githubusercontent.com/calebdw/larastan/master/docs/example.png" alt="Larastan Example" height="300">
</p>

<p align="center">
  <a href="https://github.com/calebdw/larastan/actions"><img src="https://github.com/calebdw/larastan/actions/workflows/tests.yml/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/calebdw/larastan/stats"><img src="https://poser.pugx.org/calebdw/larastan/d/total.svg" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/calebdw/larastan"><img src="https://poser.pugx.org/calebdw/larastan/v/stable.svg" alt="Latest Version"></a>
  <a href="https://github.com/calebdw/larastan/blob/master/LICENSE.md"><img src="https://poser.pugx.org/calebdw/larastan/license.svg" alt="License"></a>
</p>

------

## ⚗️ About This Fork

Hello! 👋

This is my fork of [larastan/larastan][larastan], which includes additional features and improvements that have been proposed but are not yet available in the upstream package.
This fork is intended to provide the community with immediate access to these enhancements while maintaining compatibility with the upstream package.

## 🔄 Changes and Upstream PRs

This fork includes the following changes and enhancements:

- [feat: update relation generics](https://github.com/larastan/larastan/pull/1990)
- [feat: support newFactory method when resolving factory](https://github.com/larastan/larastan/pull/1922)
- [feat: add support for config array shapes](https://github.com/larastan/larastan/pull/2004)
- [feat: support multiple database connections](https://github.com/larastan/larastan/pull/1879)
- [fix: default date casting](https://github.com/larastan/larastan/pull/1842)
- [fix: handle model property aliases](https://github.com/larastan/larastan/pull/1999)

## ✨ Getting Started

To use this fork, you may use [Composer](https://getcomposer.org) to install it as a development dependency into your Laravel project:

```bash
composer require --dev "calebdw/larastan:^2.0"
```

Or if you already have the upstream package installed, you can point your `composer.json` to this fork:

```diff
- "larastan/larastan": "^2.0"
+ "calebdw/larastan": "^2.0"
```

For more information on how to configure and use Larastan, please refer to the [official documentation][larastan]

## 👊🏻Contributing

Thank you for considering contributing to Larastan. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

## 📄 License

This fork is open-sourced software licensed under the [MIT license](LICENSE.md).

<!-- links -->
[larastan]: https://github.com/larastan/larastan
