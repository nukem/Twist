<? require ("tpl/inc/head.php"); ?>
<body> 
<div id="page"> 
  <? require ("tpl/inc/header.php"); ?> 
  <? require ("tpl/inc/path.php"); ?> 
  <div id="content"> 
    <div id="left-col"> 
      <div id="left-col-border"> 
        <? if (isset ($errors)) require ("tpl/inc/error.php"); ?> 
        <? if (isset ($messages)) require ("tpl/inc/message.php"); ?> 
        <? if (isset ($_SESSION['epClipboard'])) require ("tpl/inc/clipboard.php"); ?> 
        <? require ("tpl/inc/structure.php"); ?> 
      </div> 
    </div> 
    <div id="right-col"> 
      <h2 class="bar green"><span>Blog</span></h2> 
      <!--<form action=".?id=<?= $id ?>" method="post" enctype="multipart/form-data">-->  
        <div class="right-col-padding1"> 
          <div class="width-99pct"> 
            <!--table class="rec-table"> 
              <tr>
				<td-->
				  <div class="blog-main">
					<?php
						if (isset($blog_errors)) foreach ($blog_errors as $err)
						{
							echo $err, '<br />';	
						}
					?>
					<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
						<table class="blog-rec-table">
						  <tr>
							<td colspan="3">
							  <label>Title*</label><br />
							  <input type="text" class="textfield width-100pct" name="title" value="<?php if (isset($_POST['create_blog'])) echo htmlentities($_POST['title'], ENT_QUOTES); else if (isset ($edit_blog['0']['title'])) echo htmlentities($edit_blog['0']['title'], ENT_QUOTES); ?>" />
							</td>
						  </tr>
						  <tr>
							<td>
							  <label>Online</label><br />
							  <input type="checkbox" name="online" value="1"<? if (isset($_POST['online']) && $_POST['online'] == 1) echo ' checked="checked"'; elseif (isset($edit_blog['0']['online']) && $edit_blog['0']['online'] == 1) echo ' checked="checked"'; ?> />
							</td>
							<td>
							  <label>Author*</label><br />
							  <select class="textfield width-100pct" name="author">
							    <?php
							    foreach($agents as $agent){
							    ?>
							     <option value = "<?php echo $agent['id']; ?>" <?php if(isset($_POST['create_blog']) && $_POST['author'] == $agent['id']) echo 'selected="selected"'; elseif(isset ($edit_blog['0']['tags']) && $edit_blog['0']['author'] == $agent['id']) echo 'selected="selected"'; ?>><?php echo $agent['title']; ?></option>
							    <?php
							    }
							    ?>
							  </select>
							</td>
							<td>
							  <label>Tags</label><br />
							  <input type="text" class="textfield width-100pct" name="tags" value="<? if (isset($_POST['create_blog'])) echo htmlentities($_POST['tags'], ENT_QUOTES); else if (isset ($edit_blog['0']['tags'])) echo htmlspecialchars ($edit_blog['0']['tags']); ?>" />
							</td>
						  </tr>
			              <tr> 
			                <td colspan="3"> 
							<label><?= $lang[59] ?></label><br />
			         		<textarea name="content" cols="30" rows="10" class="textfield height-200 tinymce"><? if (isset($_POST['create_blog'])) echo htmlentities($_POST['content'], ENT_QUOTES); else if (isset($edit_blog['0']['content'])) echo htmlspecialchars ($edit_blog['0']['content']); ?></textarea>
			                </td> 
			              </tr>
			              <tr>
			              	<td></td><td></td><td><input style="float: right;" class="button" type="submit" value="<?php echo (isset($_GET['blog'])) ? 'Save' : 'Create' ?>" name="create_blog" /></td>
	              		  </tr>
						</table>
					</form>
					
					<table class="blog-rec-table">
					<?php
						if(isset($blog_comments) && is_array($blog_comments) && $blog_comments !== ''){
					?>
					<?php
							foreach($blog_comments as $comment){
								echo <<<HTML
									<tr class="border-bottom">
										<td>
											<label>Date</label>
										</td>
										<td>
											<label>User</label>
										</td>
										<td>
											<label>Website</label>
										</td>
										<td>
											<a href="?id={$cfg['blog']['id']}&action=comdelete&blog={$_GET['blog']}&comment={$comment['recId']}">
												<img src="images/comments_delete.gif" title="Delete Comment" />
											</a>
											&nbsp;
											&nbsp;
											&nbsp;
											<a href="#" onclick="return modifyComment({$comment['recId']});">
												<img src="images/comment_edit.gif" title="Delete Comment" />
											</a>
										</td>
									</tr>
									<tr class="blog-bg blog-comment-{$comment['recId']}">
										<td>
											{$comment['date']}
										</td>
										<td>
											{$comment['user']}
										</td>
										<td>
											{$comment['website']}
										</td>
										<td></td>
									</tr>
									<tr class="blog-bg">
										<td colspan="4" class="content-content-{$comment['recId']}">
											<label>Content</label><br />
											<div class="comment-{$comment['recId']}">{$comment['content']}</div>
										</td>
									</tr>
									<tr class="blog-bg">
										<td colspan="4">
											<div class="modify-blog-comment-{$comment['recId']}" style="display: none;">
												<label>Modify Content</label><br />
												<form onsubmit="return saveCommentChanges($(this))">
													<div class="message" style="display: none;"></div>
													<div><textarea name="content" class="textfield width-100pct" style="padding: 5px;">{$comment['content']}</textarea></div>
													<input type="hidden" name="blog_comment_id" value="{$comment['recId']}" />
													<div>
														<button type="submit" class="button" style="width: auto;">Edit comment</button>
														<button type="button" class="button" onclick="return closeComment({$comment['recId']})">Cancel</button>
													</div>
												</form>
											</div>
										</td>
									</tr>
									
									<tr>
										<td colspan="4">&nbsp;</td>
									</tr>
HTML;
							}
						}
					?>
					</table>
				  </div>
				<!--/td>
			  </tr>
            </table--> 
          </div> 
        </div> 
      <!--</form>--> 
    </div> 
    <? require ("tpl/inc/footer.php"); ?> 
  </div> 
</div> 
</body>
</html>
