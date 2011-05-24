<?php use_helper('jQuery') ?>
<script>
  $(document).ready(function(){
    $("#commentForm").validate();
  });
</script>

			<? foreach ($comments as $comment): ?>
				<?= $comment->getCommentText() ?>
				-- <?= $comment->getCreated() ?>
				<hr />
			<? endforeach; ?>
			
			
 			<fieldset>
 			
 			<?php echo form_tag('@add_comment?id='.$id.'&mode='.$mode, array('id'=>"commentForm", 'name'=>"commentForm", 'method'=>"post"))?>
            
            <div class="req"><b>*</b> Indicates required field</div>
            
            <input type="hidden" name="id" value="<?= $id ?>" />
            <input type="hidden" name="mode" value="<?= $mode ?>" />
            
           
            <?php if ($sf_request->hasErrors()): ?>
                <p>The data you entered seems to be incorrect.
                Please correct the following errors and resubmit:</p>
                <ul>
                    <?php foreach($sf_request->getErrors() as $name => $error): ?>
                        <li><?php echo $name ?>: <?php echo $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <label for="comment"><b><span class="req">*</span>Comment:</b>
                <textarea name="comment" id="comment"></textarea><br />
            </label>
            
       
             <div class="f-submit-wrap">
             <?php echo jq_submit_to_remote('comment', 'Add comment', array(
      				'update'   => 'zone',
      				'url'      => '@add_comment?id='.$id.'&mode='.$mode,
  			)) ?><br />
            </div>
            
            </form>	
            
            </fieldset>