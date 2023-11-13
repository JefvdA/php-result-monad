<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('vendor')
    ->files();

return (new PhpCsFixer\Config())
    ->setRules([
        'no_unused_imports' => true,
    ])
    ->setFinder(iterator_to_array($finder->getIterator()));
