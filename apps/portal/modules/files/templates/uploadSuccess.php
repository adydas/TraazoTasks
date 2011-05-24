<script type="text/javascript" language="javascript">
$(function(){ // wait for document to load 
 $('#T7').MultiFile({ 
  list: '#T7-list'
 }); 
});
</script>


<div id="content_wrapper" class="container">
<div class="block_content">

<form action   = "<?= url_for ('@file_upload?pid=' . $pid); ?>" method = "post" enctype  = "multipart/form-data">

			<?= $form [NutshellUploadForm::UPLOAD_ID]; ?>
			<?= $form [NutshellUploadForm::PROJECT_ID]; ?>

			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Browse for File</p>
				</div>
                
				<div class="upload-item-field">
					<?= $form [NutshellUploadForm::FILE]; ?>
				</div>
			</div>
			
			<div class="wipe"></div>
			
			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Directory</p>
				</div>
                
				<div class="upload-item-field">
					<?= $form [NutshellUploadForm::FOLDER]; ?>
				</div>
			</div>
			<div class="wipe"></div>
				
			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Select task</p>
				</div>
				<div class="upload-item-field">
					<?= $form [NutshellUploadForm::TASK_ID]; ?>
				</div>
            </div>
            <div class="wipe"></div>
			

			<div class="wipe"></div>
			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Description</p>
				</div>
				<div class="upload-item-field">
					<?= $form [NutshellUploadForm::DESCRIPTION]; ?>
				</div>
			</div>
			
			
			<div class="wipe"></div>
			
			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Is New Version</p>
				</div>
                
				<div class="upload-item-field">
					<?= $form [NutshellUploadForm::NEW_VERSION]; ?>
				</div>
			</div>
			

			<div class="wipe"></div>
			
			
			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel"></p>
				</div>

				<div class="upload-item-field">
                    <label class="upload-package_cabinet">
                        <input id="upload-submit" type="submit" value="Upload Package" class="upload-package_static" name="submit" />
                    </label>
				</div>
			</div>
			
</form>




    </div>
  </div>
