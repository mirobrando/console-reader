<?php

namespace mirolabs\console;


interface ReaderInterface
{
    /**
     * @param $input
     * @param OutputInterface $output
     */
    public function __construct($input, $output);

    /**
     * @param string $default
     * @return string
     */
    public function getAnswer($default);
} 