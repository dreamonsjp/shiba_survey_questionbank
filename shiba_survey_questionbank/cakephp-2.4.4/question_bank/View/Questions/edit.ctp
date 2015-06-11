<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title"><?php echo __('Edit Question'); ?></span>
		<span class="um-panel-title-right"><?php echo $this->Html->link(sprintf("No.%s %s", $this->request->data['Question']['id'], $this->request->data['Question']['title']), array('action' => 'view', $this->request->data['Question']['id'])); ?></span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'QuestionEditForm', 'submitButtonId' => 'QuestionEditSubmitBtn')); ?>
		<?php echo $this->Form->create('Question', array('type'=>'file')); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Language');?>
			</label>
			<div class="controls">
				<?php echo $this->Form->input('lang_id', array('default'=>22, 'label'=>false, 'div'=>false)); ?>
				<span class='tagline'><?php echo __('for ex. English');?>
				</span>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Category');?>
			</label>
			<div class="controls">
				<?php echo $this->Form->input('category_id', array('label'=>false, 'div'=>false)); ?>
				<span class='tagline'><?php echo __('for ex. Household survey');?>
				</span>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Question Data');?>
			</label>
			<div class="controls">
				<?php echo $this->Form->input('question_data', array('type'=>'file', 'label'=>false, 'div'=>false)); ?>
				<span class='tagline'><?php echo __('for LimeSurvey .lsq file');?>
				</span>
			</div>
			<img src="/img/screen_howtoget_lsq.jpg" alt="how to get .lsq file" />
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Edit Question', array('class'=>'btn btn-primary', 'id'=>'QuestionEditSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
