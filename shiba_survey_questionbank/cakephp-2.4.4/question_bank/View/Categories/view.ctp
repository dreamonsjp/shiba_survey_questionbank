<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title"><?php echo __('Category View'); ?></span>
		<span class="um-panel-title-right"><?php echo $this->Html->link('Index', array('action' => 'index')); ?></span>
	</div>
	<div class="um-panel-content">
		<div class="row">
			<div class="span12">
			<?php if (!empty($category)) : ?>
				<div class="left span5" style="margin:5px">
					<table class="table table-striped table-bordered">
						<tbody>
							<tr>
								<td><strong><?php echo __('ID');?></strong></td>
								<td><?php echo h($category['Category']['id']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Parent Category');?></strong></td>
								<td><?php if(!empty($category['Category']['parent_category_id'])) echo $this->Html->link($topCategories[$category['Category']['parent_category_id']], array('controller' => 'categories', 'action' => 'view', $category['Category']['parent_category_id'])); ?>&nbsp;</td>
							</tr>
							<tr>
								<td><strong><?php echo __('Name');?></strong></td>
								<td><?php echo h($category['Category']['name']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Language');?></strong></td>
								<td><?php echo $category['Lang']['name']; ?>&nbsp;</td>
							</tr>
							<tr>
								<td><strong><?php echo __('Actions')?></strong></td>
								<td>
									<div class="btn-group">
									<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
									<ul class="dropdown-menu">
									<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?></li>
									<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?></li>
									</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php endif; //quesiton ?>
			</div>
		</div>
	</div>
</div>