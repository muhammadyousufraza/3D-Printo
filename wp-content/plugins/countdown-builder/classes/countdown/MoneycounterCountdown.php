<?php
namespace ycd;

class MoneycounterCountdown extends Countdown {

    public function __construct() {
		parent::__construct();
        add_action('add_meta_boxes', array($this, 'mainOptions'));
    }

    public function mainOptions() {
		parent::mainOptions();
        add_meta_box('ycdMoneyCounterOptions', __('Countdown options', YCD_TEXT_DOMAIN), array($this, 'mainView'), YCD_COUNTDOWN_POST_TYPE, 'normal', 'high');
	}

    public function mainView() {
		$typeObj = $this;
		require_once YCD_VIEWS_PATH.'moneyCounter.php';
	}

    public function includeStyles() {
		$this->includeGeneralScripts();
		wp_enqueue_script("jquery-ui-draggable");
		ScriptsIncluder::registerScript('moneyCounter.js', array('dirUrl' => YCD_COUNTDOWN_JS_URL.'/'));
		ScriptsIncluder::enqueueScript('moneyCounter.js');
	}

    public function getViewContent() {
        $this->includeStyles();
        ob_start();
        ?>
            <div id="ycd-money-counter"
                data-initial="<?php echo esc_attr($this->getOptionValue('ycd-money-initial')); ?>"
                data-increase="<?php echo esc_attr($this->getOptionValue('ycd-money-increase-unite')); ?>"
                data-start-date="<?php echo esc_attr($this->getOptionValue('ycd-money-start-date')); ?>"
                data-decimals="<?php echo esc_attr($this->getOptionValue('ycd-money-decimal-places')); ?>"
                data-prefix="<?php echo esc_attr($this->getOptionValue('ycd-money-prefix')); ?>"
                data-target="<?php echo esc_attr($this->getOptionValue('ycd-money-target-value')); ?>"
                style="font-size: <?php echo esc_attr($this->getOptionValue('ycd-money-font-size')); ?>;">
                Loading...
            </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}