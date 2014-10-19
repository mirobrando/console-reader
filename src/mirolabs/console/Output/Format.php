<?php

namespace mirolabs\console\Output;


class Format
{
    private static $formats = [
        'info' => ['green', '', ''],
        'info_bold' => ['green', '', 'bold'],
        'comment' => ['yellow', '', ''],
        'question' => ['black', 'cyan', ''],
        'error' => ['white', 'red', ''],
        'error_bold' => ['white', 'red', 'bold']
    ];

    /**
     * @var Style
     */
    private $style;

    public function __construct($format)
    {
        $f = 'info';
        if (array_key_exists($format, self::$formats)) {
            $f = $format;
        }
        $this->style = new Style(self::$formats[$f][0], self::$formats[$f][1], self::$formats[$f][2]);
    }

    /**
     * @return Style
     */
    public function getStyle()
    {
        return $this->style;
    }

} 