<?php

namespace Honeymustard\FieldFactory\Layouts;

use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Utils\Maps;
use Honeymustard\FieldFactory\Utils\Translator;
use Honeymustard\FieldFactory\Dictionaries\FieldDictionary;

/**
 * Base class for all layouts.
 */
abstract class AbstractLayout
{
    private $args = [];
    private $translator = null;

    /**
     * Construct a new layout.
     *
     * @param string[] $args A list of arguments.
     */
    public function __construct($args = [])
    {
        $this->args = $args;
        $this->translator = new Translator(new FieldDictionary());
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    final protected function getDefaultArgs()
    {
        return [
            'key'     => '',
            'label'   => $this->getLabel(),
            'name'    => '',
            'subs'    => $this->getFactory()->toArray(),
            'display' => $this->getDisplay(),
            'min'     => $this->getMinLayouts(),
            'max'     => $this->getMaxLayouts(),
        ];
    }

    /**
     * Get the default arguments from the concrete layout.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [];
    }

    /**
     * Parse a list of arguments.
     *
     * @param string[] $args List of arguments.
     *
     * @return string[]
     */
    protected function parse($args)
    {
        $a = $this->getDefaultArgs();
        $b = $this->getFieldArgs();

        return $this->verify($this->merge($a, $this->merge($b, $args)));
    }

    /**
     * Merge a list of arguments
     *
     * @param string[] $a List of arguments.
     * @param string[] $b List of arguments.
     *
     * @return string[]
     */
    protected function merge($a, $b)
    {
        return array_merge($this->translate($a), $this->translate($b));
    }

    /**
     * Translate a list of arguments
     *
     * @param string[] $args List of arguments.
     *
     * @return string[]
     */
    protected function translate($args)
    {
        return $this->getTranslator()->translate($args);
    }

    /**
     * Verify a list of arguments.
     *
     * @param string[] $args List of arguments.
     *
     * @return string[]
     */
    protected function verify($args)
    {
        Maps::require('key', $args);
        Maps::require('name', $args);
        Maps::require('sub_fields', $args);

        return $args;
    }

    /**
     * Get the factory instance.
     *
     * @return Factory
     */
    public function getFactory()
    {
        return new Factory();
    }

    /**
     * Get the label.
     *
     * @return string
     */
    public function getLabel()
    {
        return 'FieldFactory\Layout';
    }

    /**
     * Get the display value.
     *
     * @return string
     */
    public function getDisplay()
    {
        return 'block';
    }

    /**
     * Get the minimum number of layouts.
     *
     * @return string|int
     */
    public function getMinLayouts()
    {
        return '';
    }

    /**
     * Get the maximum number of layouts.
     *
     * @return string|int
     */
    public function getMaxLayouts()
    {
        return '';
    }

    /**
     * Get the arguments.
     *
     * @return string[]
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * Get the translator.
     *
     * @return Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * Convert field to an array.
     *
     * @return string[]
     */
    final public function toArray()
    {
        return $this->parse($this->getArgs());
    }
}
