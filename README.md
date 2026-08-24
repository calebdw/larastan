<p align="center">
    <img src="https://raw.githubusercontent.com/calebdw/larastan/master/docs/logo.png" alt="Larastan Logo" width="300">
    <br><br>
    <img src="https://raw.githubusercontent.com/calebdw/larastan/master/docs/example.png" alt="Larastan Example" height="300">
</p>

<p align="center">
  <a href="https://packagist.org/packages/calebdw/larastan"><img src="https://badge.laravel.cloud/badge/calebdw/larastan" alt="Laravel Compatibility"></a>
  <a href="https://github.com/calebdw/larastan/actions"><img src="https://github.com/calebdw/larastan/actions/workflows/tests.yml/badge.svg" alt="Test Results"></a>
  <a href="https://packagist.org/packages/calebdw/larastan"><img src="https://img.shields.io/packagist/dt/calebdw/larastan.svg" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/calebdw/larastan"><img src="https://img.shields.io/packagist/v/calebdw/larastan.svg" alt="Latest Version"></a>
  <a href="https://github.com/calebdw/larastan/blob/master/LICENSE.md"><img src="https://img.shields.io/github/license/calebdw/larastan" alt="License"></a>
</p>

------

> [!IMPORTANT]
> **This fork has moved to [calebdw/phpstan-laravel][phpstan-laravel].**
>
> The work here outgrew what a fork could carry. Living downstream of Larastan
> meant every change had to stay compatible with it, which ruled out renaming
> confusing options, dropping old version shims, or reorganising anything.
> [phpstan-laravel][phpstan-laravel] is the same work as its own package, free
> to make those decisions, with [documentation][docs] to match.
>
> ```bash
> composer remove --dev calebdw/larastan
> composer require --dev calebdw/phpstan-laravel
> ```
>
> The [migration guide][migration] covers the rest: options now nest under
> `laravel:`, error identifiers are prefixed `laravel.` instead of `larastan.`,
> and a few names changed to say what they actually do.
>
> This fork is no longer maintained and will not be updated.

## ⚗️ About This Fork

Hello! 👋

This was my fork of [larastan/larastan][larastan], carrying features and improvements that had been proposed upstream but were not yet available there.
It existed to give the community immediate access to those enhancements while staying compatible with the upstream package.

> [!TIP]
> For [Laravel Livewire][livewire] support, check out [larastan-livewire][larastan-livewire]!

## 🔄 Changes and Upstream PRs

This fork includes the following changes and enhancements:

- [fix: conditionable calls on relations](https://github.com/larastan/larastan/pull/2510)
- [fix: mark macro methods as static only if the closure is static](https://github.com/larastan/larastan/pull/2398)
- [feat: add support for Collection, Builder, and Arr pluck](https://github.com/larastan/larastan/pull/2346)
- [fix: self::query() for final models](https://github.com/larastan/larastan/pull/2338)
- [feat: add optional noModelForwardingToBuilder and noModelStaticForwardingToBuilder](https://github.com/larastan/larastan/pull/2317)
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
[docs]: https://phpstan-laravel.dev
[migration]: https://phpstan-laravel.dev/latest/migrating-from-larastan/
[phpstan-laravel]: https://github.com/calebdw/phpstan-laravel
[larastan]: https://github.com/larastan/larastan
[larastan-livewire]: https://github.com/calebdw/larastan-livewire
[livewire]: https://github.com/livewire/livewire
