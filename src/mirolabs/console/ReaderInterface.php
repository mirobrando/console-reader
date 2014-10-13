<?php

namespace mirolabs\console;


interface ReaderInterface
{
    /**
     * @param $input
     * @param $output
     */
    public function __construct($input, $output);

    /**
     * @return string
     */
    public function getAnswer();
} 