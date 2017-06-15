<?php

namespace Honeymustard\FieldFactory\Library\Links;

use Honeymustard\FieldFactory\Fields;
use Honeymustard\FieldFactory\Utils;

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

    /**
     * Construct new link factory.
     *
     * @param string[] $params      A list of required parameters.
     * @param string[] $args        A list of optional arguments.
     * @param FieldFactory $factory An optional factory instance.
     */
    public function __construct($params, $args = [], $factory = new FieldFactory())
    {
        $this->factory = $factory;
        $this->key = Utils\Maps::require('key', $params);
        $this->name = Utils\Maps::require('name', $params);
        $this->args = $this->parseArgs($args);
        $this->prefix = $this->key . '_' . $this->name . '_';
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

        if (isset($args['post_types'])) {
            return $args['post_types'];
        }

        return ['post', 'page'];
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
        if (Utils\Maps::get('link_title', $args) === '') {
            $args['link_title'] = true;
        }

        if (Utils\Maps::get('style', $args) === '') {
            $args['style'] = false;
        }

        if (Utils\Maps::get('internal_link', $args) === '') {
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
        $args = $this->getArgs();

        if (isset($args[$type])) {
            return $args[$type];
        }

        return [];
    }

    /**
     * Get all link fields.
     *
     * @return string[] list of fields.
     */
    public function getFields()
    {
        $args = $this->getArgs();

        $fields = [];
        $fields[] = $this->getType();

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
     * @return string[] map of trigger => description.
     */
    public function getTriggers()
    {
        return $this->triggers;
    }

    /**
     * Get list of type choices.
     *
     * @return string[k,v] list of choices.
     */
    protected function getTypeChoices()
    {
        $args = $this->getArgs();

        $types = [
            'none'     => esc_html__('None', 'acf-factory'),
            'internal' => esc_html__('Internal', 'acf-factory'),
            'external' => esc_html__('External', 'acf-factory'),
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
            $types['document'] = esc_html__('Document', 'acf-factory');
        }

        if (isset($args['email'])) {
            $types['email'] = esc_html__('E-mail', 'acf-factory');
        }

        if (isset($args['archive'])) {
            $types['archive'] = esc_html__('Archive', 'acf-factory');
        }

        if (isset($args['trigger'])) {
            $types['trigger'] = esc_html__('Trigger', 'acf-factory');
        }

        return $types;
    }

    /**
     * Get list of style choices.
     *
     * @return string[k,v] list of choices.
     */
    protected function getStyleChoices()
    {
        return [
            'regular' => esc_html__('Regular', 'acf-factory'),
            'button'  => esc_html__('Button', 'acf-factory'),
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
    protected function getType()
    {
        $factory = $this->getFactory();

        $args = [
            'key'     => $this->getTypeKey(),
            'label'   => esc_html__('Link', 'acf-factory'),
            'name'    => $this->name . '_link_type',
            'instr'   => esc_html__('Select the type of link that you want.', 'acf-factory'),
            'choices' => $this->getTypeChoices(),
            'default' => 'none',
        ]);

        $factory->radio($this->merge($args, $this->getArgsType('link_type_args'));
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
            'label'   => esc_html__('Link style', 'acf-factory'),
            'name'    => $this->name . '_link_style',
            'instr'   => esc_html__('Select the type of appearance for this link.', 'acf-factory'),
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
            'label'     => esc_html__('Link title', 'acf-factory'),
            'name'      => $this->name . '_link_title',
            'instr'     => esc_html__('Add a custom title.', 'acf-factory'),
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
            'label'     => esc_html__('Link to document', 'acf-factory'),
            'name'      => $this->name . '_link_doc',
            'instr'     => esc_html__('Select a link to a document.', 'acf-factory'),
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
            'label' => esc_html__('E-mail address', 'acf-factory'),
            'name'  => $this->name . '_link_email',
            'instr' => esc_html__('Add a recipient e-mail address.', 'acf-factory'),
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
            'label'   => esc_html__('Triggers', 'acf-factory'),
            'name'    => $this->name . '_link_trigger',
            'instr'   => esc_html__('Select a predefined action for this trigger.', 'acf-factory'),
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
            'label'     => esc_html__('Link to page', 'acf-factory'),
            'name'      => $this->name . '_link_int',
            'instr'     => esc_html__('Select an internal post link.', 'acf-factory'),
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
            'label'     => esc_html__('Link anchor', 'acf-factory'),
            'name'      => $this->name . '_link_anchor',
            'instr'     => esc_html__('Add an anchor to a specific page section e.g. #section-name.', 'acf-factory'),
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
            'label' => esc_html__('Link to archive', 'acf-factory'),
            'name'  => $this->name . '_link_archive',
            'instr' => esc_html__('Select a link to a post archive.', 'acf-factory'),
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
            'label' => esc_html__('Link to page', 'acf-factory'),
            'name'  => $this->name . '_link_ext',
            'instr' => esc_html__('Add an external link. Must include http:// or https://.', 'acf-factory'),
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
