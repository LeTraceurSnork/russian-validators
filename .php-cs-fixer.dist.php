<?php

$finder = PhpCsFixer\Finder::create()
                           ->in(__DIR__ . '/')
                           ->in(__DIR__ . '/src')
                           ->append(['.php_cs']);

$rules = [
    '@PSR12'                      => true,
    'array_syntax'                => ['syntax' => 'short'],
    'blank_line_before_statement' => true,
];

$rules['increment_style'] = ['style' => 'post'];

return (new PhpCsFixer\Config())
    ->setUsingCache(false)
    ->setRules($rules)
    ->setFinder($finder);
