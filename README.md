### Field Factory

A facade library for Advanced Custom Fields.

#### FieldFactory\Group
```
use Honeymustard\FieldFactory;

/* extend the default group */
class Modules extends FieldFactory\Group {

	/* the group requires a name */
	public function __construct() {
		parent::__construct( 'modules' );
	}

	/* add a group title */
	public function getTitle() {
		return esc_html__( 'Modules', 'domain' );
	}

	/* add custom fields with FieldFactory */
	protected function getFields() {

		$fields = new FieldFactory\Factory();
		$fields->flexibleContent( [
			'key'     => 'modules_1489398381',
			'name'    => 'modules',
			'label'   => esc_html__( 'Modules', 'domain' ),
			'button'  => esc_html__( 'Add layout', 'domain' ),
			'layouts' => $this->getLayouts(),
		] );

		return $fields->getFields();
	}

	/* add layouts to this group */
	protected function getLayouts() {
		return [
			(new AcfModulesTextAndLink())->getLayout(),
		];
	}

	/* add locations with FieldFactory\Conds */
	protected function getLocations() {

		$conds = new FieldFactory\Conds();
		$conds->subjoin( new AcfParam( 'post_type', '==', 'post' ) );
		$conds->subjoin( new AcfParam( 'post_type', '==', 'page' ) );

		return $conds->toArray();
	}
}
```

#### FieldFactory\Layout
```
use Honeymustard\FieldFactory;

/* extend the default abstract layout */
class AcfModulesTextAndLink extends AcfLayout {

	/* the layout requires a name */
	public function __construct() {
		parent::__construct( 'text_and_link' );
	}

	/* give the layout a title */
	protected function getLabel() {
		return esc_html__( 'Text & Link', 'domain' );
	}

	/* create subfields through AcfFactory */
	protected function getSubFields() {

		$fields = new AcfFactory();

		/* a regular text field */
		$fields->text( [
			'key'   => 'text_and_link_1489401659',
			'name'  => 'the_text',
			'label' => esc_html__( 'Text', 'domain' ),
		] );

		/* this is a special generator class */
		$fields->factory( new AcfFactoryLink( [
			'key'  => 'text_and_link_1489404568',
			'name' => 'the_link',
		], [
			'link_title' => false,
		] ) );

		return $fields->getFields();
	}
}
```

#### Register the field group
```
/* register field groups in the normal way */
function acf_register_group() {
	$group = new AcfModules();
	acf_add_local_field_group( $group->getGroup() );
}

add_action( 'init', 'acf_register_group', 10 );
```

#### AcfFactory
AcfFactory provides access to all the default custom fields. Most fields only require a field key, a field name, and a label. Some keys have an alias such as **instr** for **instructions**, **default** for  **default_value**, and **conds** instead of **conditional_logic**.

```
$fields = new AcfFactory();
$fields->text( [
   'key'     => 'text_and_link_1489401659',
   'name'    => 'the_text',
   'label'   => esc_html__( 'Text', 'domain' ),
   'instr'   => esc_html__( 'Write some text', 'domain' ),
   'default' => 'N/A',
] );
```

#### AcfFactoryLink
Link fields are created with **AcfFactoryLink**. To extract these fields you can use the corresponding **AcfLink** class. **AcfDummyLink** can be used to create links that emulates the behaviour of **AcfLink** but with dummy data.

There first parameter for the link class should be the same name as the one used for the factory. By default **AcfLink** will attempt to fetch all fields as sub fields. This can be overridden by the optional second and third parameter.

```
/* link field generator */
$link = new AcfFactoryLink( [
	'key'  => 'text_and_link_1489404568',
	'name' => 'the_link',
] );
	
/* extract fields from link */
$link = new AcfLink( 'the_link' );
```
