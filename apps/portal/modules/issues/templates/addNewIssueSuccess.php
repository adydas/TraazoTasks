


<div id="content_wrapper" class="container">
<div class="block_content">

<form action   = "<?= url_for ('@issue_create?pid=' . $pid); ?>" method = "post" enctype  = "multipart/form-data">

			<?= $form [NutshellIssueForm::UPLOAD_ID]; ?>
			<?= $form [NutshellIssueForm::PROJECT_ID]; ?>
			<?= $form [NutshellIssueForm::REPORTER_ID]; ?>

			 <div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Summary</p>
				</div>
				<div class="upload-item-field">
					<?= $form [NutshellIssueForm::SUMMARY]; ?>
				</div>
			</div>
            <div class="wipe"></div>
            
			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Description</p>
				</div>
				<div class="upload-item-field">
					<?= $form [NutshellIssueForm::DESCRIPTION]; ?>
				</div>
			</div>
			<div class="wipe"></div>
			
			 <div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Status</p>
				</div>
				<div class="upload-item-field">
					<?= $form [NutshellIssueForm::STATUS]; ?>
				</div>
            </div>
            <div class="wipe"></div>
			
			
			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Select task</p>
				</div>
				<div class="upload-item-field">
					<?= $form [NutshellIssueForm::TASK_ID]; ?>
				</div>
            </div>
            <div class="wipe"></div>
            <div class="wipe"></div>
            
            
            <div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Assign to</p>
				</div>
				<div class="upload-item-field">
					<?= $form [NutshellIssueForm::ASSIGNED_TO_ID]; ?>
				</div>
            </div>
            <div class="wipe"></div>
            
            
           
			
			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel">Browse for attachment</p>
				</div>
                
				<div class="upload-item-field">
					<?= $form [NutshellIssueForm::FILE]; ?>
				</div>
			</div>
			
			<div class="wipe"></div>
			
			<div class="upload-item">
				<div class="upload-item-label">
					<p class="formlabel"></p>
				</div>

				<div class="upload-item-field">
                    <label class="upload-package_cabinet">
                        <input id="upload-submit" type="submit" value="Create" class="upload-package_static" name="submit" />
                    </label>
				</div>
			</div>
			
</form>




    </div>
  </div>
