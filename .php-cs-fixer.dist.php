<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('vendor')
    ->files();

return (new PhpCsFixer\Config())
    ->setRules([
        'no_unused_imports' => true,
        'single_quote' => true,
        'trailing_comma_in_multiline' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['operators' => ['=>' => 'align_single_space_minimal']],
        'blank_line_before_statement' => ['statements' => ['return']],
        'braces' => [
            'allow_single_line_closure' => true,
            'position_after_anonymous_constructs' => 'same',
            'position_after_control_structures' => 'next',
            'position_after_functions_and_oop_constructs' => 'next',
        ],
    ])
    ->setFinder(iterator_to_array($finder->getIterator()));
