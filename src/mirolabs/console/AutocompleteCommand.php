<?php

namespace mirolabs\console;


interface AutocompleteCommand
{

    public function __construct($output, $hints);

    /**
     * @param string $result
     * @param string $char
     * @param int $hintIndex
     * @param string $hintMessage
     * @return string
     */
    public function execute($result, $char, &$hintIndex, &$hintMessage);

    /**
     * @return bool
     */
    public function isEnd();
}