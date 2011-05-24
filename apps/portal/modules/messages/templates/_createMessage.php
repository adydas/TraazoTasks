<?php use_helper('jQuery') ?>
<script>
  $(document).ready(function(){
    $("#messageForm").validate();
  });
</script>
		<fieldset>
 			
            <div class="req"><b>*</b> Indicates required field</div>
            <input type="hidden" name="messgId" value="<?= $messgId ?>" />
            
           
            <?php if ($sf_request->hasErrors()): ?>
                <p>The data you entered seems to be incorrect.
                Please correct the following errors and resubmit:</p>
                <ul>
                    <?php foreach($sf_request->getErrors() as $name => $error): ?>
                        <li><?php echo $name ?>: <?php echo $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <label for="Subject"><b><span class="req">*</span>Subject:</b>
                <input type="text" name="subject" id="subject" /><br />
            </label>
            
             <label for="Subject"><b><span class="req"></span>Text:</b>
                <textarea name="body" id="body"></textarea><br />
             </label>
             
             <label for="Tags"><b><span class="req"></span>Tags:</b>
                <input type="tags" name="tags" id="tags" /><br />
             </label>
            
             
            
            </fieldset>
            
            <? foreach ($messages as $message): ?>
				<?= $message->getSubject() ?> <br/>
				<?= $message->getBody() ?> <br/>
				-- <?= $message->getCreated() ?>
				<hr />
			<? endforeach; ?>
			
			