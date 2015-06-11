<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title"><?php echo __('Add Category'); ?></span>
		<span class="um-panel-title-right"><?php echo $this->Html->link('Index', array('action' => 'index')); ?></span>
	</div>
	<div class="um-panel-content">
	<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'CategoryAddForm', 'submitButtonId' => 'CategoryAddSubmitBtn')); ?>
	<?php echo $this->Form->create('Category'); ?>
	<div class="um-form-row control-group">
		<label class="control-label required"><?php echo __('Parent Category');?></label>
		<div class="controls">
			<?php echo $this->Form->input('parent_category_id', array('options'=>$topCategories, 'default'=>0, 'label'=>false, 'div'=>false, 'empty'=>array(0=>'----'))); ?>
		</div>
	</div>
	<div class="um-form-row control-group">
		<label class="control-label required"><?php echo __('Category Name');?></label>
		<div class="controls">
			<?php echo $this->Form->input('name', array('label'=>false, 'div'=>false)); ?>
			<span class='tagline'><?php echo __('for ex. Household survey');?></span>
		</div>
	</div>
	<div class="um-form-row control-group">
		<label class="control-label required"><?php echo __('Language');?></label>
		<div class="controls">
			<?php echo $this->Form->input('lang_id', array('default'=>22, 'label'=>false, 'div'=>false)); ?>
		</div>
	</div>
	<div class="um-button-row">
		<?php echo $this->Form->Submit('Add Category', array('class'=>'btn btn-primary', 'id'=>'CategoryAddSubmitBtn')); ?>
	</div>
	</div>
</div>