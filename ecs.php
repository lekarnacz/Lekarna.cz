<?php

declare(strict_types = 1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\DisallowLongArraySyntaxSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Classes\DuplicateClassNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\JumbledIncrementerSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UnconditionalIfStatementSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UnnecessaryFinalModifierSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UselessOverridingMethodSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\OneClassPerFileSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\OneInterfacePerFileSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\OneTraitPerFileSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterCastSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\CyclomaticComplexitySniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\ConstructorNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DeprecatedFunctionsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Strings\UnnecessaryStringConcatSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\LanguageConstructSpacingSniff;
use PHP_CodeSniffer\Standards\MySource\Sniffs\PHP\EvalObjectFactorySniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\LowercaseClassKeywordsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\NonExecutableCodeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\FunctionSpacingSniff;
use SlevomatCodingStandard\Sniffs\Arrays\TrailingArrayCommaSniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassConstantVisibilitySniff;
use SlevomatCodingStandard\Sniffs\Classes\ModernClassNameReferenceSniff;
use SlevomatCodingStandard\Sniffs\Classes\TraitUseDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Commenting\DisallowOneLinePropertyDocCommentSniff;
use SlevomatCodingStandard\Sniffs\Commenting\EmptyCommentSniff;
use SlevomatCodingStandard\Sniffs\Commenting\ForbiddenAnnotationsSniff;
use SlevomatCodingStandard\Sniffs\Commenting\InlineDocCommentDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Commenting\UselessFunctionDocCommentSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\AssignmentInConditionSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\LanguageConstructWithParenthesesSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\NewWithParenthesesSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullCoalesceOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireShortTernaryOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\UselessIfConditionWithReturnSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\UselessTernaryOperatorSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\DeadCatchSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedInheritedVariablePassedToClosureSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\AlphabeticallySortedUsesSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\MultipleUsesPerLineSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UnusedUsesSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseDoesNotStartWithBackslashSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseFromSameNamespaceSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UselessAliasSniff;
use SlevomatCodingStandard\Sniffs\Operators\DisallowEqualOperatorsSniff;
use SlevomatCodingStandard\Sniffs\Operators\SpreadOperatorSpacingSniff;
use SlevomatCodingStandard\Sniffs\PHP\OptimizedFunctionsWithoutUnpackingSniff;
use SlevomatCodingStandard\Sniffs\PHP\ShortListSniff;
use SlevomatCodingStandard\Sniffs\PHP\TypeCastSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessParenthesesSniff;
use SlevomatCodingStandard\Sniffs\PHP\UselessSemicolonSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\LongTypeHintsSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\NullTypeHintOnLastPositionSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSpacingSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSpacingSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\UselessConstantTypeHintSniff;
use SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff;
use SlevomatCodingStandard\Sniffs\Variables\UselessVariableSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

$paths = [];
$skips = [
    'ecs-baseline.php',
    'ecs-override.php',
    __DIR__ . '/ecs.php',
    __DIR__ . '/bin/generate-ecs-baseline',
    'phpstan-baseline.php'
];
$rules = [
    DisallowLongArraySyntaxSniff::class,
    TrailingArrayCommaSniff::class,
    DuplicateClassNameSniff::class,
    ClassConstantVisibilitySniff::class,
    ModernClassNameReferenceSniff::class,
    TraitUseDeclarationSniff::class,
    LowercaseClassKeywordsSniff::class,
    JumbledIncrementerSniff::class,
    UnconditionalIfStatementSniff::class,
    UnnecessaryFinalModifierSniff::class,
    UselessOverridingMethodSniff::class,
    DisallowOneLinePropertyDocCommentSniff::class,
    EmptyCommentSniff::class,
    InlineDocCommentDeclarationSniff::class,
    UselessFunctionDocCommentSniff::class,
    AssignmentInConditionSniff::class,
    LanguageConstructWithParenthesesSniff::class,
    NewWithParenthesesSniff::class,
    RequireNullCoalesceOperatorSniff::class,
    RequireShortTernaryOperatorSniff::class,
    UselessIfConditionWithReturnSniff::class,
    UselessTernaryOperatorSniff::class,
    DeadCatchSniff::class,
    OneClassPerFileSniff::class,
    OneInterfacePerFileSniff::class,
    OneTraitPerFileSniff::class,
    SpaceAfterCastSniff::class,
    UnusedInheritedVariablePassedToClosureSniff::class,
    CyclomaticComplexitySniff::class,
    NestingLevelSniff::class,
    AlphabeticallySortedUsesSniff::class,
    MultipleUsesPerLineSniff::class,
    UselessAliasSniff::class,
    UseDoesNotStartWithBackslashSniff::class,
    UseFromSameNamespaceSniff::class,
    ConstructorNameSniff::class,
    DisallowEqualOperatorsSniff::class,
    SpreadOperatorSpacingSniff::class,
    DeprecatedFunctionsSniff::class,
    ForbiddenFunctionsSniff::class,
    EvalObjectFactorySniff::class,
    OptimizedFunctionsWithoutUnpackingSniff::class,
    ShortListSniff::class,
    TypeCastSniff::class,
    UselessParenthesesSniff::class,
    UselessSemicolonSniff::class,
    NonExecutableCodeSniff::class,
    UnnecessaryStringConcatSniff::class,
    LongTypeHintsSniff::class,
    NullTypeHintOnLastPositionSniff::class,
    ParameterTypeHintSniff::class,
    ParameterTypeHintSpacingSniff::class,
    PropertyTypeHintSniff::class,
    ReturnTypeHintSniff::class,
    ReturnTypeHintSpacingSniff::class,
    UselessConstantTypeHintSniff::class,
    UnusedVariableSniff::class,
    UselessVariableSniff::class,
    LanguageConstructSpacingSniff::class,
];
$configuredRules = [
    ForbiddenAnnotationsSniff::class => [
        'forbiddenAnnotations' => [
            '@api',
            '@author',
            '@category',
            '@copyright',
            '@created',
            '@license',
            '@package',
            '@since',
            '@subpackage',
            '@version',
        ],
    ],
    UnusedUsesSniff::class => [
        'searchAnnotations' => TRUE,
    ],
    DeclareStrictTypesSniff::class => [
        'spacesCountAroundEqualsSign' => 0,
    ],
    ForbiddenFunctionsSniff::class => [
        'forbiddenFunctions' => [
            'bdump' => NULL,
            'dump' => NULL,
            'dd' => NULL
        ]
    ],
    FunctionSpacingSniff::class => [
        'spacing' => 1,
        'spacingBeforeFirst' => 0,
        'spacingAfterLast' => 0
    ]
];
$dynamicSets = [];
$sets = [
    SetList::PSR_12,
];

if (file_exists('ecs-override.php')) {
    include 'ecs-override.php';
}
if (file_exists('ecs-baseline.php')) {
    include 'ecs-baseline.php';
}
if (file_exists(__DIR__ . '/temporary-baseline-rules-skip.php')) {
    include __DIR__ . '/temporary-baseline-rules-skip.php';
}

$sets = array_merge($sets, $additionalSets ?? []);
$dynamicSets = array_merge($dynamicSets, $additionalDynamicSets ?? []);
$rules = array_merge($rules, $additionalRules ?? []);
$skips = array_merge($skips, $additionalSkips ?? []);
$skips = array_merge($skips, $baselineErrors ?? []);
$skips = array_merge($skips, array_unique($temporaryBaselineRulesSkip ?? []));

foreach (($additionalConfiguredRules ?? []) as $ruleClass => $additionalConfiguredRuleConfig) {
    $configuredRules[$ruleClass] = $additionalConfiguredRuleConfig;
}

return static function (ECSConfig $ecsConfig) use ($paths, $skips, $rules, $configuredRules, $dynamicSets, $sets): void {
    $ecsConfig->paths($paths);
    $ecsConfig->sets($sets);
    $ecsConfig->dynamicSets($dynamicSets);
    $ecsConfig->rules($rules);
    $ecsConfig->rulesWithConfiguration($configuredRules);
    $ecsConfig->skip($skips);

    $ecsConfig->indentation(Option::INDENTATION_TAB);
    $ecsConfig->lineEnding(PHP_EOL);
};
