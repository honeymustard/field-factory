<?php

namespace Honeymustard\FieldFactory\Layouts;

use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Utils\Maps;
use Honeymustard\FieldFactory\Utils\Translator;
use Honeymustard\FieldFactory\Abilities\MergableTrait;
use Honeymustard\FieldFactory\Dictionaries\LayoutDictionary;

/**
 * Base class for all layouts.
 */
abstract class AbstractLayout
{
    use MergableTrait;

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
        $this->translator = new Translator(new LayoutDictionary());
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
            'name'    => '',
            'label'   => $this->getLabel(),
            'subs'    => $this->getFactory()->toArray(),
            'display' => $this->getDisplay(),
            'min'     => $this->getMinLayouts(),
            'max'     => $this->getMaxLayouts(),
        ];
    }

    /**
     * Get the default arguments from a subtype.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [];
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
     * @return string|integer
     */
    public function getMinLayouts()
    {
        return '';
    }

    /**
     * Get the maximum number of layouts.
     *
     * @return string|integer
     */
    public function getMaxLayouts()
    {
        return '';
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
     * Get the arguments.
     *
     * @return string[]
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * Convert field to an array.
     *
     * @return string[]
     */
    final public function toArray()
    {
        return $this->parse([
            $this->getDefaultArgs(),
            $this->getFieldArgs(),
            $this->getArgs(),
        ]);
    }
}
