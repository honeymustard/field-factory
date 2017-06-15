<?php

namespace Honeymustard\AcfFactory\Library\Links;

/**
 * A concrete link implementation.
 */
class Link extends AbstractLink
{
    /**
     * bizarro constructor.
     *
     * @param string $prefix prefix name for link fields.
     * @param string $type   field type.
     * @param string $id     post id for regular fields.
     */
    public function __construct($prefix, $type = 'subfield', $id = '-1')
    {
        if ($type === 'option') {
            $this->title = get_field($prefix . '_link_title', 'option');
            $this->color = get_field($prefix . '_link_color', 'option');
            $this->style = get_field($prefix . '_link_style', 'option');
            $this->type = get_field($prefix . '_link_type', 'option');
            $this->int = get_field($prefix . '_link_int', 'option');
            $this->doc = get_field($prefix . '_link_doc', 'option');
            $this->email = get_field($prefix . '_link_email', 'option');
            $this->ext = get_field($prefix . '_link_ext', 'option');
            $this->archive = get_field($prefix . '_link_archive', 'option');
            $this->anchor = get_field($prefix . '_link_anchor', 'option');
            $this->trigger = get_field($prefix . '_link_trigger', 'option');
        } elseif ($type === 'field') {
            $this->title = get_field($prefix . '_link_title', $id);
            $this->color = get_field($prefix . '_link_color', $id);
            $this->style = get_field($prefix . '_link_style', $id);
            $this->type = get_field($prefix . '_link_type', $id);
            $this->int = get_field($prefix . '_link_int', $id);
            $this->doc = get_field($prefix . '_link_doc', $id);
            $this->email = get_field($prefix . '_link_email', $id);
            $this->ext = get_field($prefix . '_link_ext', $id);
            $this->archive = get_field($prefix . '_link_archive', $id);
            $this->anchor = get_field($prefix . '_link_anchor', $id);
            $this->trigger = get_field($prefix . '_link_trigger', $id);
        } else {
            $this->title = get_sub_field($prefix . '_link_title');
            $this->color = get_sub_field($prefix . '_link_color');
            $this->style = get_sub_field($prefix . '_link_style');
            $this->type = get_sub_field($prefix . '_link_type');
            $this->int = get_sub_field($prefix . '_link_int');
            $this->doc = get_sub_field($prefix . '_link_doc');
            $this->email = get_sub_field($prefix . '_link_email');
            $this->ext = get_sub_field($prefix . '_link_ext');
            $this->archive = get_sub_field($prefix . '_link_archive');
            $this->anchor = get_sub_field($prefix . '_link_anchor');
            $this->trigger = get_sub_field($prefix . '_link_trigger');
        }
    }
}
