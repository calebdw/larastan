<p align="center">
    <img src="https://raw.githubusercontent.com/calebdw/larastan/master/docs/logo.png" alt="Larastan Logo" width="300">
    <br><br>
    <img src="https://raw.githubusercontent.com/calebdw/larastan/master/docs/example.png" alt="Larastan Example" height="300">
</p>

<p align="center">
  <a href="https://github.com/calebdw/larastan/actions"><img src="https://github.com/calebdw/larastan/actions/workflows/tests.yml/badge.svg" alt="Test Results"></a>
  <a href="https://packagist.org/packages/calebdw/larastan"><img src="https://img.shields.io/packagist/dt/calebdw/larastan.svg" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/calebdw/larastan"><img src="https://img.shields.io/packagist/v/calebdw/larastan.svg" alt="Latest Version"></a>
  <a href="https://github.com/calebdw/larastan/blob/master/LICENSE.md"><img src="https://img.shields.io/github/license/calebdw/larastan" alt="License"></a>
</p>

------

## ⚗️ About This Fork

Hello! 👋

This is my fork of [larastan/larastan][larastan], which includes additional features and improvements that have been proposed but are not yet available in the upstream package.
This fork is intended to provide the community with immediate access to these enhancements while maintaining compatibility with the upstream package.

> [!TIP]
> For [Laravel Livewire][livewire] support, check out [larastan-livewire][larastan-livewire]!

## 🔄 Changes and Upstream PRs

This fork includes the following changes and enhancements:

- [fix: chunkWhile generics](https://github.com/larastan/larastan/pull/2262)
- [fix: factory {has,for}* methods should return static](https://github.com/larastan/larastan/pull/2252)
- [fix: property type for uuid and ulid primary keys](https://github.com/larastan/larastan/pull/2197)
- [fix: collection template types being overwritten](https://github.com/larastan/larastan/pull/2249)
- [fix: builder stubs and builder/model forwarding](https://github.com/larastan/larastan/pull/2180)
- [fix: handle collection intersection types](https://github.com/larastan/larastan/pull/2058)
- [feat: support dynamic relation closures](https://github.com/larastan/larastan/pull/2048)
- [feat: add support for config array shapes](https://github.com/larastan/larastan/pull/2004)
- [feat: support multiple database connections](https://github.com/larastan/larastan/pull/1879)
- [feat: support wildcards in migration/schema paths](https://github.com/larastan/larastan/pull/2031)
- [fix: default date casting](https://github.com/larastan/larastan/pull/1842)
- [fix: make TGet covariant on Attribute stub](https://github.com/larastan/larastan/pull/2014)

## ✨ Getting Started

To use this fork, you may use [Composer][composer] to install it as a development dependency into your Laravel project:

```bash
composer require --dev "calebdw/larastan:^3.0"
```

Or if you already have the upstream package installed, you can point your `composer.json` to this fork:

```diff
- "larastan/larastan": "^3.0"
+ "calebdw/larastan": "^3.0"
```

If you have the [PHPStan extension installer](https://phpstan.org/user-guide/extension-library#installing-extensions) installed then nothing more is needed, otherwise you will need to manually include the extension in the `phpstan.neon(.dist)` configuration file:

```neon
includes:
    - ./vendor/calebdw/larastan/extension.neon
```

For more information on how to configure and use Larastan, please refer to the [official documentation][larastan].

## 👊🏻 Contributing

Thank you for considering contributing to Larastan. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

## 📄 License

This fork is open-sourced software licensed under the [MIT license](LICENSE.md).

<!-- links -->
[composer]: https://getcomposer.org
[larastan]: https://github.com/larastan/larastan
[larastan-livewire]: https://github.com/calebdw/larastan-livewire
[livewire]: https://github.com/livewire/livewire
