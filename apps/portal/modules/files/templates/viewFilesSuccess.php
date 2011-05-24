<div id="content_wrapper" class="container">
<div class="block_content">

<? foreach ($files as $f): ?>

	<?= link_to($f->getLatestVersion()->getName(), '@file_download?fid='.$f->getLatestVersion()->getFileId()); ?> v<?= $f->getLatestVersion()->getVersion(); ?><br/>
	

<? endforeach; ?>

<br/>

<?= link_to ('Upload new file', '@file_upload?pid='.$pid) ?>

</div>
</div>