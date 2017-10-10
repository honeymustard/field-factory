<?php

namespace Honeymustard\FieldFactory\Library;

use Honeymustard\FieldFactory\Utils\Maps;
use Honeymustard\FieldFactory\Utils\Keymaker;
use Honeymustard\FieldFactory\Utils\Translator;
use Honeymustard\FieldFactory\Utils\Locale;
use Honeymustard\FieldFactory\Abilities\MergableTrait;
use Honeymustard\FieldFactory\Interfaces\FieldInterface;
use Honeymustard\FieldFactory\Interfaces\ArrayableInterface;
use Honeymustard\FieldFactory\Dictionaries\FieldDictionary;

/**
 * Base class for all libraries.
 */
abstract class AbstractLibrary implements FieldInterface, ArrayableInterface
{
    use MergableTrait;

    private $args = [];
    private $keymaker = null;
    private $translator = null;
    private $locale = null;

    /**
     * Construct new library.
     *
     * @param string[] $args A list of arguments.
     */
    public function __construct($args)
    {
        $key = Maps::require('key', $args);
        $name = Maps::require('name', $args);

        $this->args = $args;
        $this->keymaker = new Keymaker($key, $name);
        $this->translator = new Translator(new FieldDictionary());
        $this->locale = new Locale();
        $this->locale->addResources($this->getTranslations());
    }

    /**
     * Get the translations map.
     *
     * @return string[] A map of translation files.
     */
    protected function getTranslations()
    {
        return [];
    }

    /**
     * Get the keymaker instance.
     *
     * @return Keymaker
     */
    protected function getKeymaker()
    {
        return $this->keymaker;
    }

    /**
     * Apply disambiguation to a key.
     *
     * @param string $key A given key.
     *
     * @return string
     */
    final protected function getKey($key)
    {
        return $this->getKeymaker()->getKey($key);
    }

    /**
     * Apply disambiguation to a name.
     *
     * @param string $name A given name.
     *
     * @return string
     */
    final protected function getName($name)
    {
        return $this->getKeymaker()->getName($name);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    abstract protected function getDefaultArgs();

    /**
     * Get the list of fields.
     *
     * @return AbstractField[]
     */
    abstract protected function getFields();

    /**
     * Verify the list of arguments.
     *
     * @param string[] $args A list of arguments.
     *
     * @return string[]
     */
    protected function verify($args)
    {
        return $args;
    }

    /**
     * Get the definitive settings list.
     *
     * @return string[]
     */
    final protected function getSettings()
    {
        $default = $this->getDefaultArgs();
        $applied = array_intersect_key($this->getArgs(), $default);

        return array_merge($default, $applied);
    }

    /**
     * Get the list of args that pertain to fields.
     *
     * @return string[]
     */
    final protected function getFieldArgs()
    {
        return array_intersect_key($this->getArgs(), $this->getFields());
    }

    /**
     * Localize a given string.
     *
     * @param string $string A string to localize.
     *
     * @return string
     */
    protected function localize($string)
    {
        return $this->getLocale()->trans($string);
    }

    /**
     * Get the identity.
     *
     * @return string
     */
    final public function getIdentity()
    {
        return 'library';
    }

    /**
     * Get the locale object.
     *
     * @return Locale
     */
    public function getLocale()
    {
        return $this->locale;
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
        return array_values(
            $this->parse([$this->getFields(), $this->getFieldArgs()])
        );
    }
}
