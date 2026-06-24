<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       makeitso.digital
 * @since      1.0.0
 *
 * @package    Mis_Nutrition_Label_Creator
 * @subpackage Mis_Nutrition_Label_Creator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mis_Nutrition_Label_Creator
 * @subpackage Mis_Nutrition_Label_Creator/admin
 * @author     Make It So <sushama@makeitso.digital>
 */
class Mis_Nutrition_Label_Creator_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mis_Nutrition_Label_Creator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mis_Nutrition_Label_Creator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mis-nutrition-label-creator-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mis_Nutrition_Label_Creator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mis_Nutrition_Label_Creator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mis-nutrition-label-creator-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	// Add custom Meta box to admin products pages
	public function create_product_nutritional_info_meta_box(){
		 add_meta_box(
        '_nutritional_information_meta_box',
        __( 'Nutritional Information', 'mis' ),
        array( $this, 'add_custom_content_meta_box' ),
        'product',
        'normal',
        'default'
    );
	}
	
	
// Custom metabox content in admin product pages
public function add_custom_content_meta_box( $post ){

	$nutritional_info = get_post_meta( $post->ID, '_nutritional_information', false); 
		?>

			<fieldset>
				<div>
					<label for="energy">
						Energy
					</label>
					<input
						type="text"
						name="energy"
						id="energy"
						value="<?php echo esc_attr( $nutritional_info[0]['Energy'] ); ?>"
					>
				</div><br>
				
				<div>
					<label for="fat">
						Fat
					</label>
					<input
						type="text"
						name="fat"
						id="fat"
						value="<?php echo esc_attr( $nutritional_info[0]['Fat'] ); ?>"
					>
					<label for="fat_which_saturates">
						of which saturates
					</label>
					
					<input
						type="text"
						name="fat_which_saturates"
						id="fat_which_saturates"
						value="<?php echo esc_attr( $nutritional_info[0]['of_which_saturates'] ); ?>"
					>
				</div><br>
				
				<div>
					<label for="carbohydrate">
						Carbohydrate (total)
					</label>
					<input
						type="text"
						name="carbohydrate"
						id="carbohydrate"
						value="<?php echo esc_attr( $nutritional_info[0]['Carbohydrate'] ); ?>"
					>
					<label for="carbohydrate_which_sugars">
						of which sugars
					</label>
					
					<input
						type="text"
						name="carbohydrate_which_sugars"
						id="carbohydrate_which_sugars"
						value="<?php echo esc_attr( $nutritional_info[0]['of_which_sugars'] ); ?>"
					>
				</div><br>
				
				<div>
					<label for="fibre">
						Fibre (dietary)
					</label>
					
					<input
						type="text"
						name="fibre"
						id="fibre"
						value="<?php echo esc_attr( $nutritional_info[0]['Fibre'] ); ?>"
					>
					<small style="display:block; color: #666; margin-top: 5px;">Must be less than or equal to total carbohydrate</small>
				</div><br>
				
				<div>
					<label for="protein">
						Protein
					</label>
					
					<input
						type="text"
						name="protein"
						id="protein"
						value="<?php echo esc_attr( $nutritional_info[0]['Protein'] ); ?>"
					>
				</div><br>
				
				<div>
					<label for="salt">
						Salt
					</label>
					
					<input
						type="text"
						name="salt"
						id="salt"
						value="<?php echo esc_attr( $nutritional_info[0]['Salt'] ); ?>"
					>
				</div><br>

				<div>
					<label>
						Suitable for vegetarians
						<input
							type="checkbox"
							name="suitable_for_vegetarians"
							
							 <?php echo ( $nutritional_info[0]['Suitable_for_vegetarians'] == 'on') ? 'checked'  : ''; ?>
							>
					</label>
				</div><br>
			</fieldset>

		<?php

		//wp_nonce_field( '_namespace_form_metabox_nonce', '_namespace_form_metabox_process' );

}
	
	// Save  field values from product admin pages
	public function save_product_nutritional_info_field( $post_id ) {

    if ( filter_input( INPUT_POST, 'action' ) !== 'editpost' ) {
        return;
    }

    // Sanitize inputs
    $carbs  = isset($_POST['carbohydrate']) ? floatval($_POST['carbohydrate']) : 0;
    $fibre  = isset($_POST['fibre']) ? floatval($_POST['fibre']) : 0;
    $sugars = isset($_POST['carbohydrate_which_sugars']) ? floatval($_POST['carbohydrate_which_sugars']) : 0;

    /**
     * EU RULE:
     * Total carbohydrates MUST include fibre
     */
    if ( $fibre > $carbs ) {
        // Auto-correct carbs to include fibre
        $carbs = $fibre + $sugars;
    }

    $nutritional_info = [
        'Energy' => sanitize_text_field($_POST['energy']),
        'Fat' => floatval($_POST['fat']),
        'of_which_saturates' => floatval($_POST['fat_which_saturates']),
        'Carbohydrate' => $carbs,
        'of_which_sugars' => $sugars,
        'Fibre' => $fibre,
        'Protein' => floatval($_POST['protein']),
        'Salt' => floatval($_POST['salt']),
        'Suitable_for_vegetarians' => isset($_POST['suitable_for_vegetarians']) ? 'on' : 'off',
    ];

    update_post_meta( $post_id, '_nutritional_information', $nutritional_info );
}

	
	
	// Add "'Nutritional information" product tab
	public function add_nutritional_info_product_tab($tabs ){
		 $tabs['test_tab'] = array(
        'title'         => __( 'Nutritional information', 'woocommerce' ),
        'priority'      => 50,
        'callback'      => array($this,'display_nutritional_information_product_tab_content')

    );

    return $tabs;
	}
	
	
	
	// Display "technical specs" content tab
public function display_nutritional_information_product_tab_content() {
    global $product;
    $nutritional_meta = $product->get_meta( '_nutritional_information' ) ;
	if(isset( $nutritional_meta) && !empty($nutritional_meta)){
	($nutritional_meta['Suitable_for_vegetarians'] == 'on') ? $nutritional_meta['Suitable_for_vegetarians'] = 'Yes': $nutritional_meta['Suitable_for_vegetarians'] = 'No';
	echo '<div class="mnlc nutrition-section lined">
			<ul class="nutrition-table" itemprop="nutrition" itemscope="" itemtype="http://schema.org/NutritionInformation">			
				<li class="nt-header b-0">
				<h2 class="nt-title">Nutrition Facts</h2>
				</li>
				<li class="nt-row sep-10 serving-size">
				<span class="nt-label col-70">Serving Size</span>
				<span class="nt-value col-30" itemprop="servingSize">100g</span>
				</li>
				<li class="nt-row font-bold b-0">
				<span class="nt-label">Amount per serving</span>
				</li>
				<li class="nt-row font-bold calories sep-8">
				<span class="nt-label col-70">Calories</span>
				<span class="nt-value col-30" itemprop="servingSize">'. $nutritional_meta['Energy'].'</span>
				</li>
				<li class="nt-head font-bold sep-4">
				<span class="nt-label nutrient-label col-40"></span>
				<span class="nt-label amount-label col-30"></span>
				<span class="pdv-label col-30">% Daily Value*</span>
				</li>
				<li>';
				// VALIDATION: Check Total Fat is numeric
				if(isset( $nutritional_meta['Fat']) && !empty($nutritional_meta['Fat']) && is_numeric($nutritional_meta['Fat'])){
					$fat_value = floatval($nutritional_meta['Fat']);
					$fat_dv = round($fat_value / 78 * 100, 2);
				echo 
				'<span class="nt-label col-40 font-bold">Total Fat</span>
				<span class="nt-amount col-30" itemprop="fatContent">'. $nutritional_meta['Fat'].' g</span>
				<span class="nt-value col-30">' . $fat_dv . '%</span>
				</li>';
				}
				// VALIDATION: Check Saturated Fat is numeric
				if(isset( $nutritional_meta['of_which_saturates']) && !empty($nutritional_meta['of_which_saturates']) && is_numeric($nutritional_meta['of_which_saturates'])){
					$sat_fat_value = floatval($nutritional_meta['of_which_saturates']);
					$sat_fat_dv = round($sat_fat_value / 20 * 100, 2);
				echo 
				'<li class="nt-sublevel-1">
				<span class="nt-label col-40">Saturated Fat</span>
				<span class="nt-amount col-30" itemprop="saturatedFatContent">'. $nutritional_meta['of_which_saturates'].' g</span>
				<span class="nt-value col-30">' . $sat_fat_dv . '%</span>
				</li>';
				}
				// FIX #1: Salt Daily Value - use 6g (EU guidance) instead of 2300
				// VALIDATION: Check Salt is numeric
				if(isset( $nutritional_meta['Salt']) && !empty($nutritional_meta['Salt']) && is_numeric($nutritional_meta['Salt'])){
					$salt_value = floatval($nutritional_meta['Salt']);
					$salt_dv = round($salt_value / 6 * 100, 2);
				echo 
				'<li>
				<span class="nt-label col-40 font-bold">Salt</span>
				<span class="nt-amount col-30" itemprop="saltContent">'. $nutritional_meta['Salt'].' g</span>
				<span class="nt-value col-30">' . $salt_dv . '%</span>
				</li>';
				}
				// VALIDATION: Check Carbohydrate is numeric
				if(isset( $nutritional_meta['Carbohydrate']) && !empty($nutritional_meta['Carbohydrate']) && is_numeric($nutritional_meta['Carbohydrate'])){
					$carb_value = floatval($nutritional_meta['Carbohydrate']);
					$carb_dv = round($carb_value / 275 * 100, 2);
				echo '<li>
                <span class="nt-label col-40 font-bold">Total Carbohydrate</span>
                <span class="nt-amount col-30" itemprop="carbohydrateContent">' . $nutritional_meta['Carbohydrate'] . ' g</span>
                <span class="nt-value col-30">' . $carb_dv . '%</span>
                </li>';
				} else {
                // Handle case where the value is not numeric or missing
                echo '<li>
                <span class="nt-label col-40 font-bold">Total Carbohydrate</span>
                <span class="nt-amount col-30">N/A</span>
                <span class="nt-value col-30">N/A</span>
                 </li>';
                }
                // VALIDATION: Check Fibre is numeric
                if (isset($nutritional_meta['Fibre']) && !empty($nutritional_meta['Fibre']) && is_numeric($nutritional_meta['Fibre'])) {
                	$fibre_value = floatval($nutritional_meta['Fibre']);
                	$fibre_dv = round($fibre_value / 28 * 100, 2);
                echo '<li class="nt-sublevel-1">
                <span class="nt-label col-40">Dietary Fiber</span>
                <span class="nt-amount col-30" itemprop="fiberContent">' . $nutritional_meta['Fibre'] . ' g</span>
                <span class="nt-value col-30">' . $fibre_dv . '%</span>
                </li>';
                } else {
                 // Handle case where the value is not numeric or missing
                 echo '<li class="nt-sublevel-1">
                 <span class="nt-label col-40">Dietary Fiber</span>
                 <span class="nt-amount col-30">N/A</span>
                 <span class="nt-value col-30">N/A</span>
                 </li>';
                }

                // VALIDATION: Check Sugars is numeric
                if (isset($nutritional_meta['of_which_sugars']) && !empty($nutritional_meta['of_which_sugars']) && is_numeric($nutritional_meta['of_which_sugars'])) {
                 echo '<li class="nt-sublevel-1">
                 <span class="nt-label col-40">Total Sugars</span>
                 <span class="nt-amount col-30" itemprop="sugarContent">' . $nutritional_meta['of_which_sugars'] . ' g</span>
                 </li>';
                } else {
                 // Handle case where the value is not numeric or missing
                 echo '<li class="nt-sublevel-1">
                <span class="nt-label col-40">Total Sugars</span>
                <span class="nt-amount col-30">N/A</span>
                </li>';
                }
                
				// VALIDATION: Check Protein is numeric
				if(isset( $nutritional_meta['Protein']) && !empty($nutritional_meta['Protein']) && is_numeric($nutritional_meta['Protein'])){
					$protein_value = floatval($nutritional_meta['Protein']);
					$protein_dv = round($protein_value / 50 * 100, 2);
				echo
				'<li class="nt-sep sep-8">
				<span class="nt-label col-40 font-bold">Protein</span>
				<span class="nt-amount col-30" itemprop="proteinContent">'. $nutritional_meta['Protein'].' g</span>
				<span class="nt-value col-30">' . $protein_dv . '%</span>
				</li>';
				}
				echo
				'<li class="nt-sep sep-8">
				<span class="nt-label col-40 font-bold">Suitable for Vegetarians</span>
				<span class="nt-amount col-30" itemprop="proteinContent">'. $nutritional_meta['Suitable_for_vegetarians']. ' </span>
				<span class="nt-value col-30"></span>
				</li>
				
				
				<li class="nt-footer b-0">* The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2,000 calories a day is used for general nutrition advice.
				</li>		
				</ul>	
				</div>';
	}

}

}
