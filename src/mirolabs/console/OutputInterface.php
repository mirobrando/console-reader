<?php

namespace mirolabs\console;


use mirolabs\console\Output\Style;

interface OutputInterface
{
    /**
     * @param $message
     * @return void
     */
    public function write($message);

    /**
     * @param string $message
     * @param string $format
     * @return void
     */
    public function writeFormat($message, $format = 'info');

    /**
     * @param string $message
     * @param string $colorText
     * @param string $background
     * @param string $style
     * @return void
     */
    public function writeOptions($message, $colorText = '', $background = '', $style = '');


    /**
     * @param $message
     * @param Style $style
     * @return void
     */
    public function writeStyle($message,Style $style);

    /**
     * @param $message
     * @return void
     */
    public function writeln($message);

    /**
     * @param string $message
     * @param string $format
     * @return void
     */
    public function writelnFormat($message, $format = 'info');

    /**
     * @param string $message
     * @param string $colorText
     * @param string $background
     * @param string $style
     * @return void
     */
    public function writelnOptions($message, $colorText = '', $background = '', $style = '');


    /**
     * @param $message
     * @param Style $style
     * @return void
     */
    public function writelnStyle($message,Style $style);
} 