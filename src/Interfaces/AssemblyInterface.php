<?php

namespace Honeymustard\FieldFactory\Interfaces;

/**
 * An interface for Assembly objects.
 */
interface AssemblyInterface
{
    /**
     * Construct object and get the assembled data.
     *
     * @param string $name     The field name.
     * @param string|int $type The ACF Field type.
     *
     * @return StdClass
     */
    public static function assemble($name, $type = '');

    /**
     * Get the assembled data.
     *
     * @return StdClass
     */
    public function getData();
}
