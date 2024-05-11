# Lekarna Coding Standard

PHP coding standard used in all [LCZ](https://www.lekarna.cz/) and [MLSK](https://www.mojalekaren.sk/) related applications. The standard is based on [PSR-12](https://www.php-fig.org/psr/psr-12/) and a few Slevomat rules.

The package consists of:

- [EasyCodingStandard](https://github.com/easy-coding-standard/easy-coding-standard)
- [SlevomatCodingStandard](https://github.com/slevomat/coding-standard)

## Installation

1. Add the following repository to your composer.json:

```bash
"repositories": [
    {
        "type": "vcs",
        "url":  "git@github.com:lekarnacz/Lekarna.cz.git"
    }
]
```

2. Add the following to your require:

```bash
"require-dev": {
    "lekarna/coding-standard": "dev-main"
}
```

3. Run:

```bash
composer install
```

## Usage

Running the command:

```bash
vendor/bin/ecs --config=vendor/lekarna/coding-standard/ecs.php
```

## Generating Baseline

We have the option to generate a baseline for older projects, where we do not want to be fixing the errors manually for years.

```bash
vendor/bin/generate-ecs-baseline
```

This will generate `ecs-baseline.php` into the root of the project for us. This file contains all the rules and their files for skipping.

*Note that due to the fact that ECS never generates all errors within one run, the baseliner is automatically run multiple times. But it automatically stops itself if it can't generate the whole baseline within 10 ECS re-runs.*

## Overriding The Default Config

We may need to override the default `ecs.php` sometimes. For example, when we want to add Symfony specific rules. We can do this via `ecs-override.php` in the root directory of our project (alongside `vendor`).

The syntax for the file goes like this:

```php
<?php

//This file serves only as an override, it does not define the default ECS configuration

$paths = [];
$additionalSets = [];
$additionalDynamicSets = [];
$additionalRules = [];
$additionalConfiguredRules = [];
$additionalSkips = [];
```

| Variable                   | What it is for                                                                                   |
|----------------------------|--------------------------------------------------------------------------------------------------|
| $paths                     | Allows us to define paths. We need to pass the paths via the CLI if we do not have the override. |
| $additionalSets            | Allows us to add additional pre-defined sets from ECS.                                           |
| $additionalDynamicSets     | Allows us to add additional dynamic sets, such as @Symfony.                                      |
| $additionalRules           | Allows us to define additional rules.                                                            |
| $additionalConfiguredRules | Allows us to define additional rules with configuration.                                         |
| $additionalSkips           | Allows us to add additional skips, in case that we need to ignore a rule, error, or file.        |

`$additionalConfiguredRules` has a specific syntax, and it goes like this:

```php
$configuredRules = [
	'sniffOrFixerClass' => ['itsConfigurationArray']
	UnusedUsesSniff::class => [
		'searchAnnotations' => true,
	]
];
```

## IDE Integration

For integration with PHPStorm etc., follow the instructions in EasyCodingStandard [README](https://github.com/symplify/easy-coding-standard#your-ide-integration).

## List Of Dangerous Auto-fixer Rules

There are a few auto-fixer rules that are considered dangerous. The baseline generator will automatically ignore them as if they were an error. You can also (and should on Legacy code without a baseline) ignore them via the ECS config overrider.

- SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff
- SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff
- SlevomatCodingStandard\Sniffs\Commenting\ForbiddenAnnotationsSniff
- SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff
- SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff
- SlevomatCodingStandard\Sniffs\Operators\DisallowEqualOperatorsSniff
