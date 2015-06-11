<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title"><?php echo __('Categories'); ?></span>
		<span class="um-panel-title-right"><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></span>
		<span class="um-panel-title-right"><?php echo $this->Html->link(__('List JSON'), array('action' => 'json_list'), array('target'=>'_blank')); ?></span>
	</div>
	<div class="um-panel-content">
		<div class="questions index">
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('parent_category_id'); ?></th>
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<th><?php echo $this->Paginator->sort('lang_id'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				<?php foreach ($categories as $category): ?>
				<tr>
					<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
					<td><?php if(!empty($category['Category']['parent_category_id'])) echo $this->Html->link($topCategories[$category['Category']['parent_category_id']], array('action'=>'view', $category['Category']['parent_category_id'])); ?>&nbsp;</td>
					<td><?php echo $this->Html->link($category['Category']['name'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>&nbsp;</td>
					<td><?php echo $this->Html->link($category['Lang']['name'], array('controller' => 'langs', 'action' => 'view', $category['Lang']['id'])); ?>&nbsp;</td>
					<td class="actions">
						<div class="btn-group">
						<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?></li>
						<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?></li>
						<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?></li>
						</ul>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			
			<?php if(!empty($categories)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Questions'))); } ?>
		</div>
	</div>
</div>