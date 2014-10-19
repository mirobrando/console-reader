<?php

namespace mirolabs\console\Output;


use mirolabs\console\OutputInterface;

class StandardOutput implements OutputInterface
{

    /**
     * @var resource
     */
    private $output;

    public function __construct()
    {
        $this->output = STDOUT;
    }


    /**
     * @param $message
     * @return void
     */
    public function write($message)
    {
        fwrite($this->output, $message);
    }

    /**
     * @param string $message
     * @param string $format
     * @return void
     */
    public function writeFormat($message, $format = 'info')
    {
        $format = new Format($format);
        $this->writeStyle($message, $format->getStyle());
    }

    /**
     * @param string $message
     * @param string $colorText
     * @param string $background
     * @param string $style
     * @return void
     */
    public function writeOptions($message, $colorText = '', $background = '', $style = '')
    {
        $this->writeStyle($message, new Style($colorText, $background, $style));
    }

    /**
     * @param $message
     * @param Style $style
     * @return void
     */
    public function writeStyle($message, Style $style)
    {
        $this->write(sprintf("\033[%sm%s\033[0m", $style->getStyle(), $message));
    }

    /**
     * @param $message
     * @return void
     */
    public function writeln($message)
    {
        $this->write($message) . $this->write("\n");
    }

    /**
     * @param string $message
     * @param string $format
     * @return void
     */
    public function writelnFormat($message, $format = 'info')
    {
        $this->writeFormat($message, $format) . $this->write("\n");
    }

    /**
     * @param string $message
     * @param string $colorText
     * @param string $background
     * @param string $style
     * @return void
     */
    public function writelnOptions($message, $colorText = '', $background = '', $style = '')
    {
        $this->writeOptions($message, $colorText, $background, $style) . $this->write("\n");
    }

    /**
     * @param $message
     * @param Style $style
     * @return void
     */
    public function writelnStyle($message, Style $style)
    {
        $this->writeStyle($message, $style) . $this->write("\n");
    }


} 