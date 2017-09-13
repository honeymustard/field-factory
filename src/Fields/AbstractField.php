<?php

namespace Honeymustard\FieldFactory\Fields;

use Honeymustard\FieldFactory\Utils;
use Honeymustard\FieldFactory\Dictionaries\FieldDictionary;

/**
 * Base class for all fields.
 */
abstract class AbstractField
{
    private $type = '';
    private $args = [];
    private $translator = null;

    /**
     * Construct a new field.
     *
     * @param string $type   The type of the field.
     * @param string[] $args A list of field arguments.
     */
    public function __construct($type, $args)
    {
        $this->type = $type;
        $this->args = $args;
        $this->translator = new Utils\Translator(new FieldDictionary());
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    final protected function getDefaultArgs()
    {
        return [
            'key'       => '',
            'type'      => $this->getType(),
            'label'     => '',
            'name'      => '',
            'instr'     => '',
            'required'  => 0,
            'conds'     => 0,
            'wrapper'   => $this->getWrapArgs(),
            'placement' => 'top',
        ];
    }

    /**
     * Get the default arguments from the concrete field.
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
        Utils\Maps::require('key', $args);
        Utils\Maps::require('name', $args);

        return $args;
    }

    /**
     * Get the default wrapper arguments.
     *
     * @return string[]
     */
    protected function getWrapArgs()
    {
        return [
            'width' => '',
            'class' => '',
            'id'    => '',
        ];
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
     * Get the type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
        return $this->parse($this->getArgs());
    }
}
