<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title"><?php echo __('Question'); ?></span>
		<span class="um-panel-title-right"><?php echo $this->Html->link('Index', array('action' => 'index')); ?></span>
	</div>
	<div class="um-panel-content">
		<div class="row">
			<div class="span12">
			<?php if (!empty($question)) : ?>
				<div class="left span5" style="margin:5px">
					<table class="table table-striped table-bordered">
						<tbody>
							<tr>
								<td><strong><?php echo __('ID');?></strong></td>
								<td><?php echo h($question['Question']['id']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Category');?></strong></td>
								<td><?php echo $this->Html->link($question['Category']['name'], array('controller' => 'categories', 'action' => 'view', $question['Category']['id'])); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Title');?></strong></td>
								<td><?php echo h($question['Question']['title']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Type');?></strong></td>
								<td><?php echo h($question['Question']['type']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Survey-ID');?></strong></td>
								<td><?php echo h($question['Question']['sid']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Group-ID');?></strong></td>
								<td><?php echo h($question['Question']['gid']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Question-ID');?></strong></td>
								<td><?php echo h($question['Question']['qid']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Question');?></strong></td>
								<td><?php echo h($question['Question']['question']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Relevance');?></strong></td>
								<td><?php echo h($question['Question']['relevance']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Answer');?></strong></td>
								<td><?php echo nl2br($question['Question']['answer']); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Language');?></strong></td>
								<td><?php echo $this->Html->link($question['Lang']['name'], array('controller' => 'langs', 'action' => 'view', $question['Lang']['id'])); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo __('Actions')?></strong></td>
								<td>
									<div class="btn-group">
									<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
									<ul class="dropdown-menu">
									<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $question['Question']['id'])); ?></li>
									<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $question['Question']['id']), null, __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?></li>
									</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="left span5">
				<?php echo $this->Form->input('question_data', array('value'=>$question['Question']['question_data'], 'type'=>'textarea', 'class'=>'span6', 'rows'=>'40', 'readonly'=>true)); ?>
				</div>
			<?php endif; //quesiton ?>
			</div>
		</div>
	</div>
</div>
