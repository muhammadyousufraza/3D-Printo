<?php
// https://chatgpt.com/c/67dec4aa-e360-8007-a4e0-d7d5b794a51c
use ycd\AdminHelper;
?>

<div class="ycd-bootstrap-wrapper">
    <h2>Money Counter Settings</h2>
    <div class="row form-group">
        <div class="col-md-5">
            <label for="ycd-money-initial"><?php _e('Starting Value', YCD_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-5">
            <input type="number" id="ycd-money-initial" name="ycd-money-initial" value="<?php echo esc_attr($this->getOptionValue('ycd-money-initial')); ?>" step="0.01" class="form-control" />
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-5">
            <label for="ycd-money-increase-unite"><?php _e('Increase Per Second', YCD_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-5">
            <input type="number" id="ycd-money-increase-unite" name="ycd-money-increase-unite" value="<?php echo esc_attr($this->getOptionValue('ycd-money-increase-unite')); ?>" step="0.01" class="form-control" />
        </div>
    </div>
    <div class="row form-group">
		<div class="col-md-5">
			<label for="ycd-money-start-date" class="ycd-label-of-input">
				<?php _e('Date', YCD_TEXT_DOMAIN); ?>
			</label>
		</div>
		<div class="col-md-5">
			<input type="text" id="ycd-money-start-date" class="form-control ycd-money-time-picker" name="ycd-money-start-date" value="<?php echo esc_attr($this->getOptionValue('ycd-money-start-date')); ?>">
		</div>
	</div>
    <div class="row form-group">
        <div class="col-md-5">
            <label for="ycd-money-prefix"><?php _e('Perfix', YCD_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-5">
            <input type="text" id="ycd-money-prefix" name="ycd-money-prefix" value="<?php echo esc_attr($this->getOptionValue('ycd-money-prefix')); ?>" class="form-control" />
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-5">
            <label for="ycd-money-decimal-places"><?php _e('Decimal Places', YCD_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-5">
            <?php echo AdminHelper::selectBox(array(0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4),$this->getOptionValue('ycd-money-decimal-places'), array('class' => 'js-ycd-select', 'name' => 'ycd-money-decimal-places')); ?>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-5">
            <label for="ycd-money-target-value"><?php _e('Target Value(Optional)', YCD_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-5">
            <input type="number" id="ycd-money-target-value" name="ycd-money-target-value" value="<?php echo esc_attr($this->getOptionValue('ycd-money-target-value')); ?>" class="form-control" />
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-5">
            <label for="ycd-money-font-size"><?php _e('Font Size', YCD_TEXT_DOMAIN)?></label>
        </div>
        <div class="col-md-5">
            <input type="text" id="ycd-money-font-size" name="ycd-money-font-size" value="<?php echo esc_attr($this->getOptionValue('ycd-money-font-size')); ?>" class="form-control" />
        </div>
    </div>
</div>

<?php
$type = $this->getCurrentTypeFromOptions();
?>
<input type="hidden" name="ycd-type" value="<?= esc_attr($type); ?>">