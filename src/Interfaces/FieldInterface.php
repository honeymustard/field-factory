<?php

namespace Honeymustard\FieldFactory\Interfaces;

/**
 * An interface for field objects.
 */
interface FieldInterface
{
    /**
     * Get the identity.
     *
     * @return string
     */
    public function getIdentity();

    /**
     * Get the translator.
     *
     * @return Translator
     */
    public function getTranslator();

    /**
     * Get the arguments.
     *
     * @return string[]
     */
    public function getArgs();

    /**
     * Convert to an array.
     *
     * @return string[]
     */
    public function toArray();
}
