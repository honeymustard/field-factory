<?php

namespace Honeymustard\FieldFactory\Abilities;

/**
 * Enables an object to merge field arguments.
 */
trait Mergable
{
    /**
     * Verify a list of arguments.
     *
     * @param string[] $args List of arguments.
     *
     * @return string[]
     */
    abstract protected function verify($args);

    /**
     * Get the translator.
     *
     * @return Translator
     */
    abstract protected function getTranslator();

    /**
     * Parse a list of argument lists.
     *
     * @param string[][] $args List of argument lists.
     *
     * @return string[]
     */
    public function parse($args = [])
    {
        if (count($args) <= 1) {
            $args = $this->translate($args);
        } else {
            $args = $this->combine($args);
        }

        return $this->verify($args);
    }

    /**
     * Recursively combine a list of argument lists.
     *
     * @param string[][] $lists List of argument lists.
     *
     * @return string[]
     */
    protected function combine($lists)
    {
        $length = count($lists);
        $head = $lists[0];

        if ($length === 1) {
            return $head;
        } else {
            $tail = array_slice($lists, 1, $length);
            return $this->merge($head, $this->combine($tail));
        }
    }

    /**
     * Merge two argument lists.
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
     * Translate a list of arguments.
     *
     * @param string[] $args List of arguments.
     *
     * @return string[]
     */
    protected function translate($args)
    {
        return $this->getTranslator()->translate($args);
    }
}
