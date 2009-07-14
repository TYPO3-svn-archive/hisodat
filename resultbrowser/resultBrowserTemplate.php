<?php if (!defined ('TYPO3_MODE'))     die ('Access denied.'); ?>
<?php if($this->get('browserKey') == 'listBrowser'): ?>
	<div class="browse">
		<ul class="resultBrowser">
				<li class="search"><a href="index.php?id=496">Neue Suche</a></li>		
			<?php if($this->get('previousViewIsVisible')): ?>
				<li class="prev"><a href="<?php print $this->get('previousViewUrl'); ?>">&laquo;</a></li>
			<?php endif; ?>

			<?php if($this->get('firstViewIsVisible')): ?>
				<li class="first"><a href="<?php print $this->get('firstViewUrl'); ?>"><?php print $this->get('firstViewNumber'); ?></a></li>
			<?php endif; ?>

			<?php if($this->get('precedingDotsAreVisible')): ?>
				<li class="dots">... </li>
			<?php endif; ?>

			<?php print $this->get('precedingViewsString'); ?>

			<?php if($this->get('precedingViewsAreVisible')): ?>
				<?php foreach($this->get('precedingViews') as $view): ?>
					<li class="preceding"><a href="<?php print $view['url']; ?>"><?php print $view['number']; ?></a></li>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if($this->get('currentViewIsVisible') && $this->controller->configurations->get('totalResultCount') > 10): ?>
				<li class="current"><?php print $this->get('currentViewNumber'); ?></li>
			<?php endif; ?>

			<?php if($this->get('succeedingViewsAreVisible')): ?>
				<?php foreach($this->get('succeedingViews') as $view): ?>
					<li class="succeeding"><a href="<?php print $view['url']; ?>"><?php print $view['number']; ?></a></li>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if($this->get('succeedingDotsAreVisible')): ?>
				<li class="dots">... </li>
			<?php endif; ?>

			<?php if($this->get('lastViewIsVisible')): ?>
				<li class="last"><a href="<?php print $this->get('lastViewUrl'); ?>"><?php print $this->get('lastViewNumber'); ?></a></li>
			<?php endif; ?>

			<?php if($this->get('nextViewIsVisble')): ?>
				<li class="next"><a href="<?php print $this->get('nextViewUrl'); ?>">&raquo;</a></li>
			<?php endif; ?>
		</ul>
	</div>
<?php endif; ?>
<?php if ($this->get('browserKey') == 'singleBrowser'): ?>
	<div class="browse">
		<ul class="resultBrowser">
				<li class="search"><a href="index.php?id=496">Neue Suche</a></li>
				
			<?php if($this->get('backToList')): ?>
				<li class="backToList"><a href="<?php print $this->get('backToList'); ?>">Trefferliste</a></li>
			<?php endif; ?>
								
			<?php if($this->get('linkToPrevious')): ?>
				<li class="prev"><a href="<?php print $this->get('linkToPrevious'); ?>">&laquo;</a></li>
			<?php endif; ?>

			<?php if($this->get('linkToNext')): ?>
				<li class="next"><a href="<?php print $this->get('linkToNext'); ?>">&raquo;</a></li>
			<?php endif; ?>
		</ul>
	</div>
<?php endif; ?>