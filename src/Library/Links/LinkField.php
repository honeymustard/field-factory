<?php

namespace Honeymustard\FieldFactory\Library\Links;

use Honeymustard\FieldFactory\Fields;
use Honeymustard\FieldFactory\Utils\Maps;

/**
 * A link field implementation.
 */
class LinkField implements Fields\AbstractField
{
    private $factory = null;
    private $key = '';
    private $name = '';
    private $args = [];
    private $prefix = '';
    private $triggers = [];
    private $fields = [];

    /**
     * Construct new link factory.
     *
     * @param string[] $params A list of required parameters.
     * @param string[] $args   A list of optional arguments.
     * @param Factory $factory An optional factory instance.
     */
    public function __construct($params, $args = [], $factory = new Factory())
    {
        $this->factory = $factory;
        $this->key = Maps::require('key', $params);
        $this->name = Maps::require('name', $params);
        $this->args = $this->parseArgs($args);
        $this->prefix = $this->key . '_' . $this->name;
        $this->fields = $this->setFields($factory);
    }

    /**
     * Get the prefix.
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Get post types for internal links.
     *
     * @return string[] A list of post types.
     */
    public function getPostTypes()
    {
        $args = $this->getArgs();
        $default = ['post', 'page'];

        return Maps::get('post_types', $args, $defalt);
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
     * Add default arguments to args list.
     *
     * @param string[] $args argument list.
     *
     * @return string[] updated argument list.
     */
    protected function parseArgs($args)
    {
        if (Maps::empty('link_title', $args)) {
            $args['link_title'] = true;
        }

        if (Maps::empty('style', $args)) {
            $args['style'] = false;
        }

        if (Maps::empty('internal_link', $args)) {
            $args['internal_link'] = true;
        }

        return $args;
    }

    /**
     * Get arguments for a given field.
     *
     * @param string $type value to get from args.
     *
     * @return string[]
     */
    public function getArgsType($type)
    {
        return Maps::get($type, $this->getArgs(), []);
    }

    /**
     * Set all link fields.
     *
     * @param Factory $factory
     *
     * @return string[] List of fields.
     */
    public function setFields($factory)
    {
        $args = $this->getArgs();

        $fields[] = $this->addType();

        if ($args['style']) {
            $fields[] = $this->getStyle();
        }

        if ($args['link_title']) {
            $fields[] = $this->getTitle();
        }

        if ($args['internal_link']) {
            $fields[] = $this->getInternal();
        }

        if (isset($args['document'])) {
            $fields[] = $this->getDocument();
        }

        if (isset($args['email'])) {
            $fields[] = $this->getEmail();
        }

        if (isset($args['trigger'])) {
            $fields[] = $this->getTriggerFields();
        }

        if (!isset($args['anchor_disable'])) {
            $fields[] = $this->getAnchor();
        }

        $fields[] = $this->getExternal();

        if (isset($args['archive'])) {
            $fields[] = $this->getArchive();
        }

        return $fields;
    }

    /**
     * Add a trigger to the list of triggers.
     *
     * @param string $name  trigger event name.
     * @param string $label description of what is triggered.
     *
     * @return void
     */
    public function addTrigger($name, $label)
    {
        $this->triggers[$name] = $label;
    }

    /**
     * Get list of registered triggers.
     *
     * @return string[] Map of trigger => description.
     */
    public function getTriggers()
    {
        return $this->triggers;
    }

    /**
     * Get list of type choices.
     *
     * @return string[] A list of choices.
     */
    protected function getTypeChoices()
    {
        $args = $this->getArgs();

        $types = [
            'none'     => esc_html__('None', 'field-factory'),
            'internal' => esc_html__('Internal', 'field-factory'),
            'external' => esc_html__('External', 'field-factory'),
        ];

        /* override link type labels */
        if (isset($args['settings']['link_type_labels'])) {
            $labels = $args['settings']['link_type_labels'];

            foreach ($labels as $k => $label) {
                if (isset($types[$k])) {
                    $types[$k] = $label;
                }
            }
        }

        if (!$args['internal_link']) {
            unset($types['internal']);
        }

        if (isset($args['document'])) {
            $types['document'] = esc_html__('Document', 'field-factory');
        }

        if (isset($args['email'])) {
            $types['email'] = esc_html__('E-mail', 'field-factory');
        }

        if (isset($args['archive'])) {
            $types['archive'] = esc_html__('Archive', 'field-factory');
        }

        if (isset($args['trigger'])) {
            $types['trigger'] = esc_html__('Trigger', 'field-factory');
        }

        return $types;
    }

    /**
     * Get list of style choices.
     *
     * @return string[] A list of choices.
     */
    protected function getStyleChoices()
    {
        return [
            'regular' => esc_html__('Regular', 'field-factory'),
            'button'  => esc_html__('Button', 'field-factory'),
        ];
    }

    /**
     * Get the field key for link type.
     *
     * @return string
     */
    public function getTypeKey()
    {
        return $this->prefix . 'link_type';
    }

    /**
     * Get link type field.
     *
     * @return string[]
     */
    protected function addType($factory)
    {
        $args = [
            'key'     => $this->getTypeKey(),
            'label'   => esc_html__('Link', 'field-factory'),
            'name'    => $this->name . '_link_type',
            'instr'   => esc_html__('Select the type of link that you want.', 'field-factory'),
            'choices' => $this->getTypeChoices(),
            'default' => 'none',
        ]);

        return $factory->radio($this->merge($args, $this->getArgsType('link_type_args'));
    }

    /**
     * Get link style field.
     *
     * @return string[]
     */
    protected function getStyle()
    {
        $fields = new AcfFactory();
        $conds = new AcfConds();
        $conds->subjoin(new AcfCond($this->getTypeKey(), '!=', 'none'));

        $fields->radio([
            'key'     => $this->prefix . 'link_style',
            'label'   => esc_html__('Link style', 'field-factory'),
            'name'    => $this->name . '_link_style',
            'instr'   => esc_html__('Select the type of appearance for this link.', 'field-factory'),
            'choices' => $this->getStyleChoices(),
            'default' => 'regular',
            'conds'   => $conds->toArray(),
        ]);

        return array_merge($fields->getField(0), $this->getArgsType('link_style_args'));
    }

    /**
     * Get link title field.
     *
     * @return string[]
     */
    protected function getTitle()
    {
        $fields = new AcfFactory();
        $conds = new AcfConds();
        $conds->subjoin(new AcfCond($this->getTypeKey(), '!=', 'none'));

        $fields->text([
            'key'       => $this->prefix . 'link_title',
            'label'     => esc_html__('Link title', 'field-factory'),
            'name'      => $this->name . '_link_title',
            'instr'     => esc_html__('Add a custom title.', 'field-factory'),
            'maxlength' => '',
            'conds'     => $conds->toArray(),
        ]);

        return array_merge($fields->getField(0), $this->getArgsType('link_title_args'));
    }

    /**
     * Get post object field for documents.
     *
     * @return string[]
     */
    protected function getDocument()
    {
        $fields = new AcfFactory();
        $conds = new AcfConds();
        $conds->subjoin(new AcfCond($this->getTypeKey(), '==', 'document'));

        $fields->postObject([
            'key'       => $this->prefix . 'link_doc',
            'label'     => esc_html__('Link to document', 'field-factory'),
            'name'      => $this->name . '_link_doc',
            'instr'     => esc_html__('Select a link to a document.', 'field-factory'),
            'conds'     => $conds->toArray(),
            'post_type' => [
                '0' => 'attachment',
            ],
        ]);

        return array_merge($fields->getField(0), $this->getArgsType('link_document_args'));
    }

    /**
     * Get post object field for email adress.
     *
     * @return string[]
     */
    protected function getEmail()
    {
        $fields = new AcfFactory();
        $conds = new AcfConds();
        $conds->subjoin(new AcfCond($this->getTypeKey(), '==', 'email'));

        $fields->email([
            'key'   => $this->prefix . 'link_email',
            'label' => esc_html__('E-mail address', 'field-factory'),
            'name'  => $this->name . '_link_email',
            'instr' => esc_html__('Add a recipient e-mail address.', 'field-factory'),
            'conds' => $conds->toArray(),
        ]);

        return array_merge($fields->getField(0), $this->getArgsType('link_email_args'));
    }

    /**
     * Get fields for all triggers.
     *
     * @return string[]
     */
    protected function getTriggerFields()
    {
        $fields = new AcfFactory();
        $conds = new AcfConds();
        $conds->subjoin(new AcfCond($this->getTypeKey(), '==', 'trigger'));

        $fields->select([
            'key'     => $this->prefix . 'link_trigger',
            'label'   => esc_html__('Triggers', 'field-factory'),
            'name'    => $this->name . '_link_trigger',
            'instr'   => esc_html__('Select a predefined action for this trigger.', 'field-factory'),
            'choices' => $this->getTriggers(),
            'default' => '',
            'conds'   => $conds->toArray(),
        ]);

        return array_merge($field->getField(0), $this->getArgsType('link_trigger_args'));
    }

    /**
     * Get internal post object field.
     *
     * @return string[]
     */
    protected function getInternal()
    {
        $fields = new AcfFactory();
        $conds = new AcfConds();
        $conds->subjoin(new AcfCond($this->getTypeKey(), '==', 'internal'));

        $fields->postObject([
            'key'       => $this->prefix . 'link_int',
            'label'     => esc_html__('Link to page', 'field-factory'),
            'name'      => $this->name . '_link_int',
            'instr'     => esc_html__('Select an internal post link.', 'field-factory'),
            'post_type' => $this->getPostTypes(),
            'conds'     => $conds->toArray(),
        ]);

        return array_merge($fields->getField(0), $this->getArgsType('link_internal_args'));
    }

    /**
     * Get anchor field.
     *
     * @return string[]
     */
    protected function getAnchor()
    {
        $fields = new AcfFactory();
        $conds = new AcfConds();
        $conds->subjoin(new AcfCond($this->getTypeKey(), '==', 'internal'));

        $fields->text([
            'key'       => $this->prefix . 'link_anchor',
            'label'     => esc_html__('Link anchor', 'field-factory'),
            'name'      => $this->name . '_link_anchor',
            'instr'     => esc_html__('Add an anchor to a specific page section e.g. #section-name.', 'field-factory'),
            'maxlength' => 50,
            'conds'     => $conds->toArray(),
        ]);

        return array_merge($fields->getField(0), $this->getArgsType('link_anchor_args'));
    }

    /**
     * Get archive choice field.
     *
     * @return string[]
     */
    protected function getArchive()
    {
        $fields = new AcfFactory();
        $conds = new AcfConds();
        $conds->subjoin(new AcfCond($this->getTypeKey(), '==', 'archive'));

        $fields->select([
            'key'   => $this->prefix . 'link_archive',
            'label' => esc_html__('Link to archive', 'field-factory'),
            'name'  => $this->name . '_link_archive',
            'instr' => esc_html__('Select a link to a post archive.', 'field-factory'),
            'conds' => $conds->toArray(),
        ]);

        $linkArgs = $this->getArgs();

        if (isset($linkArgs['post_types'])) {
            $fields['choices'] = $linkArgs['post_types'];
        }

        return array_merge($fields->getField(0), $this->getArgsType('link_archive_args'));
    }

    /**
     * Get external link url field.
     *
     * @return string[]
     */
    protected function getExternal($args = [])
    {
        $conds = new AcfConds();
        $conds->subjoin(new AcfCond($this->getTypeKey(), '==', 'external'));

        $fields->url([
            'key'   => $this->prefix . 'link_ext',
            'label' => esc_html__('Link to page', 'field-factory'),
            'name'  => $this->name . '_link_ext',
            'instr' => esc_html__('Add an external link. Must include http:// or https://.', 'field-factory'),
            'conds' => $conds->toArray(),
        ]);

        return array_merge($fields->getField(0), $this->getArgsType('link_external_args'));
    }

    /**
     * Get the factory instance.
     *
     * @return FieldFactory
     */
    protected function getFactory()
    {
        return $this->factory;
    }
}
