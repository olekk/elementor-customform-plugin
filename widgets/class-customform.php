<?php
/**
 * Customform class.
 *
 * @category   Class
 * @package    ElementorCustomform
 * @subpackage WordPress
 * @author     Aleksander Cieśla <aleksander.ciesla@protonmail.com>
 * @copyright  2020 Aleksander Cieśla
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.benmarshall.me/build-custom-elementor-widgets/,
 *             Build Custom Elementor Widgets)
 * @since      1.0.0
 * php version 7.3.9
 */

namespace ElementorCustomform\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Customform widget class.
 *
 * @since 1.0.0
 */
class Customform extends Widget_Base {
	/**
	 * Class constructor.
	 *
	 * @param array $data Widget data.
	 * @param array $args Widget arguments.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'customform', plugins_url( '/assets/css/customform.css', ELEMENTOR_CUSTOMFORM ), array());
		wp_register_script( 'customform', plugins_url( '/assets/js/customform.js', ELEMENTOR_CUSTOMFORM ), array() , 1, 1);
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'customform';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Customform', 'elementor-customform' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-pencil';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'general' );
	}
	
	/**
	 * Enqueue styles.
	 */
	public function get_style_depends() {
		return array( 'customform' );
	}

	
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Form Editor', 'elementor-customform' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
			$bicyclesList = new \Elementor\Repeater();
			
			$bicyclesList->add_control(
				'bicyclesList_model', [
					'label' => __( 'Bicycle Model', 'elementor-customform' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Model name' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$bicyclesList->add_control(
				'bicyclesList_colors', [
					'label' => __( 'Colors', 'elementor-customform' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'placeholder' => __( 'each in new line...' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$bicyclesList->add_control(
				'bicyclesList_wheelsize', [
					'label' => __( 'Wheel size', 'elementor-customform' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'placeholder' => __( 'each in new line...' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$bicyclesList->add_control(
				'bicyclesList_battery', [
					'label' => __( 'Battery', 'elementor-customform' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'placeholder' => __( 'each in new line...' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$bicyclesList->add_control(
				'bicyclesList_motor', [
					'label' => __( 'Motor', 'elementor-customform' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'placeholder' => __( 'each in new line...' , 'elementor-customform' ),
					'label_block' => true,
				]
			);	
			$bicyclesList->add_control(
				'bicyclesList_image', [
					'label' => __( 'Image', 'elementor-customform' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'label_block' => true,
				]
			);	

			$this->add_control(
				'bicyclesList',
				[
					'label' => __( 'Bicycles List', 'elementor-customform' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $bicyclesList->get_controls(),
					'title_field' => '{{{ bicyclesList_model }}}',
				]
			);
			
			$this->add_control(
				'formshortcode', [
					'label' => __( 'Contact Form Shortcode', 'elementor-customform' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'deafult' => __( '[contact-form-7 id="7" title="Contact form 1"]' , 'elementor-customform' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'fieldslabels_choosemodel', [
					'label' => __( 'Fields texts', 'elementor-customform' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Wybierz model:' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'fieldslabels_choosecolor', [
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Wybierz kolor:' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'fieldslabels_choosewheelsize', [
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Rozmiar koła:' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'fieldslabels_choosebattery', [
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Bateria:' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'fieldslabels_choosemotor', [
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Napęd:' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'fieldslabels_qty', [
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Ilość:' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'fieldslabels_addtoform', [
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Dodaj do formularza zamówienia' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'fieldslabels_yourorder', [
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Twoje zamówienie' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
			$this->add_control(
				'fieldslabels_contact', [
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Dane kontaktowe' , 'elementor-customform' ),
					'label_block' => true,
				]
			);
		
		

		$this->end_controls_section();

	}


	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$firstitem = 0;
		?>
		<div class="elementor-customform">
			<ul class="customform__bicycles">
				<!-- lista rowerow ze zdjeciami - radio inputs -->
				<?php foreach($settings['bicyclesList'] as $i => $bicycle): ?>
					<li>
					<label>
						<input type="radio" name="bicyclemodel" data-model="<?php echo htmlentities($bicycle['bicyclesList_model']); ?>" value="<?php echo $i?>" <?php if($i==0) echo 'checked'; ?>>
						<span class="customform__bicycles_title" >
							<?php echo $bicycle['bicyclesList_model'] ?>
						</span>

						<img src="<?php 
							echo ($bicycle['bicyclesList_image']['url'] ?: plugins_url('/assets/img/ebike-icon.png',ELEMENTOR_CUSTOMFORM) ); 
						?>" alt="ebike-icon" class="customform__bicycles_icon">

					</label>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="customform__details">
				<h2 class="customform__details_model"><?php if($settings['bicyclesList'][$firstitem]['bicyclesList_model']) echo $settings['bicyclesList'][$firstitem]['bicyclesList_model']; ?></h2>

				<?php if($settings['bicyclesList'][$firstitem]['bicyclesList_colors']): ?>
					<label>
						<?php echo $settings['fieldslabels_choosecolor']; ?><br>
						<select name="bicyclesList_colors" id="">
							<?php foreach(explode("\n", $settings['bicyclesList'][$firstitem]['bicyclesList_colors']) as $option): ?>
								<option value="<?php echo htmlentities($option); ?>"><?php echo $option; ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				<?php endif; ?>
				

				<?php if($settings['bicyclesList'][$firstitem]['bicyclesList_wheelsize']): ?>
					<label>
						<?php echo $settings['fieldslabels_choosewheelsize']; ?><br>
						<select name="bicyclesList_wheelsize" id="">
							<?php foreach(explode("\n", $settings['bicyclesList'][$firstitem]['bicyclesList_wheelsize']) as $option): ?>
								<option value="<?php echo htmlentities($option); ?>"><?php echo $option; ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				<?php endif; ?>


				<?php if($settings['bicyclesList'][$firstitem]['bicyclesList_battery']): ?>
					<label>
						<?php echo $settings['fieldslabels_choosebattery']; ?><br>
						<select name="bicyclesList_battery" id="">
							<?php foreach(explode("\n", $settings['bicyclesList'][$firstitem]['bicyclesList_battery']) as $option): ?>
								<option value="<?php echo htmlentities($option); ?>"><?php echo $option; ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				<?php endif; ?>


				<?php if($settings['bicyclesList'][$firstitem]['bicyclesList_motor']): ?>
					<label>
						<?php echo $settings['fieldslabels_choosemotor']; ?><br>
						<select name="bicyclesList_motor" id="">
							<?php foreach(explode("\n", $settings['bicyclesList'][$firstitem]['bicyclesList_motor']) as $option): ?>
								<option value="<?php echo htmlentities($option); ?>"><?php echo $option; ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				<?php endif; ?>

				<label>
					<?php echo $settings['fieldslabels_qty']; ?><br>
					<input type="number" name="qty" value="1" min="1">
					
				</label>

				<button class="customform__submit"><?php echo $settings['fieldslabels_addtoform']; ?></button>

				<h2><?php echo $settings['fieldslabels_yourorder']; ?></h2>
				<div class="customform__details_order">
				
				
				</div>

				<div class="customform__form">
					<h2><?php echo $settings['fieldslabels_contact']; ?></h2>

					<?php echo $settings['formshortcode']; ?>
						
				</div>

			</div>


			<script>
				var bicyclesList = <?php echo json_encode($settings['bicyclesList'], JSON_HEX_TAG); ?>;

				var rad = document.querySelectorAll("input[name=bicyclemodel]");

				var sel_colors = document.querySelector("select[name=bicyclesList_colors]");
				var sel_wheelsize = document.querySelector("select[name=bicyclesList_wheelsize]");
				var sel_battery = document.querySelector("select[name=bicyclesList_battery]");
				var sel_motor = document.querySelector("select[name=bicyclesList_motor]");

				var modelname = document.querySelector("input[name=bicyclemodel]:checked").dataset.model;

				var ordertosend = document.querySelector("#hiddenzamowienie");
				
				rad.forEach(item=> {
					item.addEventListener('change', function() {
						
						let fvalues = bicyclesList[this.value];
						modelname = this.dataset.model;

						document.querySelector('.customform__details h2').innerHTML = modelname;

						sel_colors.innerHTML = "";
						fvalues.bicyclesList_colors.split('\n').forEach(item=>{
							if (item) {
								sel_colors.disabled = false;
								let opt = document.createElement("option")
								opt.value = item
								opt.innerHTML = item
								sel_colors.appendChild(opt)
							} else {
								sel_colors.disabled = true;
							}
						})

						sel_wheelsize.innerHTML = "";
						fvalues.bicyclesList_wheelsize.split('\n').forEach(item=>{
							if (item) {
								sel_wheelsize.disabled = false;
								let opt = document.createElement("option")
								opt.value = item
								opt.innerHTML = item
								sel_wheelsize.appendChild(opt)
							} else {
								sel_wheelsize.disabled = true;
							}
						})

						sel_battery.innerHTML = "";
						fvalues.bicyclesList_battery.split('\n').forEach(item=>{
							if (item) {
								sel_battery.disabled = false;
								let opt = document.createElement("option")
								opt.value = item
								opt.innerHTML = item
								sel_battery.appendChild(opt)
							} else {
								sel_battery.disabled = true;
							}
						})

						sel_motor.innerHTML = "";
						fvalues.bicyclesList_motor.split('\n').forEach(item=>{
							if (item) {
								sel_motor.disabled = false;
								let opt = document.createElement("option")
								opt.value = item
								opt.innerHTML = item
								sel_motor.appendChild(opt)
							} else {
								sel_motor.disabled = true;
							}
						})

					});
				});

				document.querySelector('.customform__submit').addEventListener("click", ()=>{
					
					document.querySelector(".customform__details_order").innerHTML += `
					<div class="cdo__row">
						<span class="cdo__row_content">`+modelname+`; `
							+sel_colors.value+`; `
							+sel_wheelsize.value+`; `
							+sel_battery.value+`; `
							+sel_motor.value+
							`; &times;<b>`+document.querySelector("input[name=qty]").value+`</b></span>
						<span class="cdo__row_controls">
							<button class="cdo--plus">+</button>
							<button class="cdo--minus">&minus;</button>
							<button class="cdo--delete">&times;</button>
						</span>
					</div>
					`;
					updateOrderContent();
				});

				
				document.querySelector('.customform__details_order').addEventListener("click", (e)=>{
					switch(e.target.className) {
						case 'cdo--delete' : {
							e.target.parentNode.parentNode.remove();
							updateOrderContent()
						break;}
						case 'cdo--plus' : {
							let qty = e.target.parentNode.parentNode.querySelector('b');
							qty.innerHTML = Number(qty.innerHTML)+1;
							updateOrderContent()
						break;}
						case 'cdo--minus' : {
							let qty = e.target.parentNode.parentNode.querySelector('b');
							if(Number(qty.innerHTML) > 1) {
								qty.innerHTML = Number(qty.innerHTML)-1;
								updateOrderContent()
							}
							
						break;}
					}
				});

				function updateOrderContent() {
					ordertosend.value = Array.from(document.querySelectorAll('.cdo__row_content'))
					.map(i=>i.innerHTML).join("\n").replaceAll("<b>", "").replaceAll("</b>", "");
				}

				function string_to_slug (str) {
					return str.replace(/[\u00A0-\u9999<>\&]/g, i=>'&#'+i.charCodeAt(0)+';');
				}

			</script>

		</div>
		<?php
		
	}

}
