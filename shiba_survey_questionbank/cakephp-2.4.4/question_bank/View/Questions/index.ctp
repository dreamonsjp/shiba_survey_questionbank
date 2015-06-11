<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title"><?php echo __('Questions'); ?></span>
		<span class="um-panel-title-right"><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?></span>
		<span class="um-panel-title-right"><?php echo $this->Html->link(__('List JSON'), array('action' => 'json_list'), array('target'=>'_blank')); ?></span>
	</div>
	<div class="um-panel-content">
		<div class="questions index">
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('category_id'); ?></th>
					<th><?php echo $this->Paginator->sort('title'); ?></th>
					<th><?php echo $this->Paginator->sort('type'); ?></th>
					<th><?php echo $this->Paginator->sort('sid'); ?></th>
					<th><?php echo $this->Paginator->sort('gid'); ?></th>
					<th><?php echo $this->Paginator->sort('qid'); ?></th>
					<th><?php echo $this->Paginator->sort('question'); ?></th>
					<th><?php echo $this->Paginator->sort('relevance'); ?></th>
					<th><?php echo $this->Paginator->sort('answer'); ?></th>
					<th><?php echo $this->Paginator->sort('lang_id'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				<?php foreach ($questions as $question): ?>
				<tr>
					<td><?php echo h($question['Question']['id']); ?>&nbsp;</td>
					<td><?php echo $this->Html->link($question['Category']['name'], array('controller' => 'categories', 'action' => 'view', $question['Category']['id'])); ?></td>
					<td><?php echo $this->Html->link(($question['Question']['title']), array('action'=>'view', $question['Question']['id'])); ?>&nbsp;</td>
					<td><?php echo h($question['Question']['type']); ?>&nbsp;</td>
					<td><?php echo h($question['Question']['sid']); ?>&nbsp;</td>
					<td><?php echo h($question['Question']['gid']); ?>&nbsp;</td>
					<td><?php echo h($question['Question']['qid']); ?>&nbsp;</td>
					<td><?php echo h($question['Question']['question']); ?>&nbsp;</td>
					<td><?php echo h($question['Question']['relevance']); ?>&nbsp;</td>
					<td><?php echo nl2br($question['Question']['answer']); ?>&nbsp;</td>
					<td><?php echo $this->Html->link($question['Lang']['name'], array('controller' => 'langs', 'action' => 'view', $question['Lang']['id'])); ?></td>
					<td class="actions">
						<div class="btn-group">
						<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><?php echo $this->Html->link(__('View'), array('action' => 'view', $question['Question']['id'])); ?></li>
						<li><?php echo $this->Html->link(__('JSON'), array('action' => 'json_get', $question['Question']['id']), array('target'=>'_blank')); ?></li>
						<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $question['Question']['id'])); ?></li>
						<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $question['Question']['id']), null, __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?></li>
						</ul>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			
			<?php if(!empty($questions)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Questions'))); } ?>
		</div>
	</div>
</div>