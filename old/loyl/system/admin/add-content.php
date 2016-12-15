<?php 
	require_once( "admin-includes/admin-functions.inc.php" ); 
	
	checkLogin( USER_ADMIN );
	
	$errors = array();
	$message = "";
	
	if( isset( $_POST[ "title" ] ) )
	{	
		$_POST[ "url" ] = stringToURL( $_POST[ "url" ] );
		
		if( strlen( $_POST[ "title" ] ) < 1 )
		{
			// no title
			$errors[ "title" ] = "<p class=\"error\">Please enter a title.</p>";
		}
		
		if( strlen( $_POST[ "url" ] ) < 1 )
		{
			// no url
			$errors[ "url" ] = "<p class=\"error\">Please enter a url.</p>";
		}
		
		if( strlen( $_POST[ "content" ] ) < 1 )
		{
			// no content
			$errors[ "content" ] = "<p class=\"error\">Please enter some content.</p>";
		}
		
		if( strlen( $_POST[ "template" ] ) < 1 )
		{
			// no template
			$errors[ "template" ] = "<p class=\"error\">Please pick a template.</p>";
		}
		
		if( count( $errors ) < 1 )
		{
			addContent();
			// clear post array out
			clearFormData();
			$message = "<p class=\"success\">Your content was saved.</p>";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Add Content - <?php echo  $_SERVER[ "HTTP_HOST" ]; ?></title>
		<link rel="stylesheet" type="text/css" href="css/admin-style.css">
		<script type="text/javascript" src="js/tiny_mce/tiny_mce.js" ></script>
		<script type="text/javascript">
		tinyMCE.init({
		        mode : "exact",
				elements : "editor-content",
		        theme : "advanced",
				theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,formatselect,|,insertdate,inserttime,|,spellchecker,removeformat,|,sub,sup,|,charmap",
		        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code",
		        theme_advanced_buttons3 : "",      
		        theme_advanced_toolbar_location : "top",
		        theme_advanced_toolbar_align : "center",
		        theme_advanced_statusbar_location : "bottom",
		        theme_advanced_resizing : true
		});
		</script>
	</head>
	<body>
		<div id="wrapper">
			<h1 class="icon-add heading"> Add Content</h1>
			<?php require_once("templates/admin-nav-small.inc.php");  ?>
			<?php echo $message; ?>
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				<fieldset>
					<ol>
						<li>
							<label>Title<span>*</span>:</label>
							<?php echo $errors[ "title" ];  ?>
							<input type="text" name="title" 
								size="60" value="<?php echo $_POST[ "title" ]; ?>" />
						</li>
						<li>
							<label>URL<span>*</span>:</label>
							<?php echo $errors[ "url" ];  ?>
							<input type="text" name="url" 
								size="60" value="<?php echo $_POST[ "url" ]; ?>" />
						</li>
						<li>
							<label>Content<span>*</span>:</label>
							<?php echo $errors[ "content" ];  ?>
							<textarea id="editor-content" name="content" rows="8" cols="60"><?php 
								echo $_POST[ "content" ]; ?></textarea>
						</li>
						<li>
							<label>Summary:</label>
							<textarea name="summary" rows="3" cols="60"><?php 
								echo $_POST[ "summary" ]; ?></textarea>
						</li>
						<li>
							<label>Template<span>*</span>:</label>
							<?php echo $errors[ "template" ];  ?>
							<?php templateSelect( $_POST[ "template" ] ); ?>
						</li>
						<li>
							<label>User Level<span>*</span>:</label>
							<select name="user_level">
								<option value="<?php echo USER_ADMIN; ?>">Admin</option>
								<option value="<?php echo USER_EDITOR; ?>">Editor</option>
								<option value="<?php echo USER_WRITER; ?>">Writer</option>
								<option value="<?php echo USER_PUBLIC; ?>">Public</option>
							</select>
						</li>
						<li>
							<input type="submit" value="Save" />
						</li>
					</ol>
				</fieldset>
			</form>
		</div>
	</body>
</html>