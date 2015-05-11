<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/Language.Controller.php';
	include_once 'controller/User.Controller.php';
	
	$uc = new UserController();
	if(isset($_SESSION['uname'])){
		$user = $uc->loadUser($_SESSION['uname']);
	}
	$teacher_id = $user->getUserid();
	
	$lc = new LanguageController();
	$languages = $lc->getAllLanguages();
	$teacher_languages = $lc->getLanguageByTeacher($teacher_id);
	
	if(isset($_POST['submit-language']))
	{
		if(isset($_POST['locale']))
		{
			if(isset($_POST['cbx']))
			{
				$lc->deleteTeacherLanguage($teacher_id);
				
				foreach($_POST['cbx'] as $language_id)
				{
					$tl = new TeacherLanguage();
					$tl->setTeacher_id($teacher_id);
					$tl->setLanguage_id($language_id);
					$tl->setIs_default(0);
					$lc->addTeacherLanguage($tl);
				}
			}
			else
			{
				$lc->deleteTeacherLanguage($teacher_id);
			}
			
			$langs = $lc->getLanguage($_POST['locale']);
			$lc->updateDefaultLanguage($teacher_id, $langs->getLanguage_id(), 1);	
			$lang = $langs->getLanguage_code();	
			
			$_SESSION['alert'] = 1;
			session_write_close();
			header("Location: teacher-languages.php?lang=$lang");	
			exit;
			
		} else {
			$_SESSION['alert'] = 2;
		}
	}
	

?>

<script type="text/javascript" src="scripts/language-scripts.js"></script>
<div id="container">
	<a class="link fleft" href="teacher.php">&laquo <?php echo _("Go Back to Dashboard"); ?></a>
	<div class="fleft" id="language" style="margin-left: 10px; margin-top: -2px;">
		<?php echo _("Language"); ?>:
		<select id="language-menu">
			<?php
				if(!empty($teacher_languages)) :
					foreach($teacher_languages as $tl) : 
						$lang = $lc->getLanguage($tl['language_id']);
			?>
						<option value="<?php echo $lang->getLanguage_code(); ?>" <?php if($language == $lang->getLanguage_code()) { ?> selected <?php } ?>><?php echo $lang->getLanguage(); ?></option>
			<?php 
					endforeach; 
				else :
			?>
				<option value="en_US" <?php if($language == "en_US") { ?> selected <?php } ?>><?php echo _("English"); ?></option>
			<?php endif; ?>
		</select>
	</div>
	<br/><br/>

	<div class="language-container">
		<br/>
		<h2><?php echo _("Language Settings"); ?></h2>
		<br/>
		<?php if($_SESSION['alert'] == 1){ ?>
			<script type="text/javascript">
				$(document).ready(function (){
					alert("<?php echo _('Language settings have been updated. You can now go back to the dashboard.'); ?>");
				});
			</script>
		<?php } ?>
		<?php if($_SESSION['alert'] == 2) { ?>
			<script language="javascript">
				$(document).ready(function() {
					alert("<?php echo _('Please select at least one default language. Thank you.'); ?>");
				});
			</script>
		<?php } ?>
	
		<!--<?php //if(isset($_GET['msg'])) : ?>
			<?php //if($_GET['msg'] == 1) : ?>
				<p style="color: green;"><?php //echo _("Language settings have been updated. You can now go back to the dashboard."); ?></p>
			<?php //endif; ?>
		<?php //endif; ?>
		
		<?php //if(isset($_GET['err'])) : ?>
			<?php //if($_GET['err'] == 1) : ?>
				<p style="color: red;"><?php //echo _("Please select at least one default language. Thank you."); ?></p>
			<?php //endif; ?>
		<?php //endif; ?>
		<br/>-->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="language_form">
			<table border="1" class="language-table">
				<tr>
					<th><input type="checkbox" name='checkall' id="check-all"></th>
					<th><?php echo _("Languages"); ?></th>
					<th><?php echo _("Default"); ?></th>
				</tr>
				<?php
					$ctr = 0;
					foreach($languages as $language) : 
					$ctr++;
				?>
					<tr>
						<td>
							<?php 
								$found = false;
								foreach($teacher_languages as $tl):
									if($tl['language_id'] == $language->getLanguage_id()): 
										$found = true;
							?>
								<input type="checkbox" name="cbx[]" value="<?php echo $language->getLanguage_id(); ?>" checked id="lang_<?php echo $ctr; ?>" />
							<?php  
									endif; 
								endforeach; 
							?>
								
							<?php if(!$found):	?>
								<input type="checkbox" name="cbx[]" value="<?php echo $language->getLanguage_id(); ?>" id="lang_<?php echo $ctr; ?>" />
							<?php endif; ?>
						</td>
						<td><?php echo $language->getLanguage(); ?></td>
						<td>
							<center>
								<?php 
									$found2 = false;
									foreach($teacher_languages as $tl2):
										if($tl2['language_id'] == $language->getLanguage_id() && $tl2['is_default'] == 1) : 
											$found2 = true;
								?>
									<input type="radio" value="<?php echo $language->getLanguage_id(); ?>" name="locale" id="locale_<?php echo $ctr; ?>" checked />
								<?php 
										endif; 
									endforeach;
								?>
								<?php if(!$found2):	?>
									<input type="radio" value="<?php echo $language->getLanguage_id(); ?>" name="locale" id="locale_<?php echo $ctr; ?>" />
								<?php endif; ?>
							</center>
						</td>
					</tr>
				<?php endforeach; ?>
				<tr>
					<td colspan="3"><center><input type="submit" class="submit-language" name="submit-language" value="<?php echo _("Submit"); ?>"></center></td>
				</tr>
			</table>
		</form>
	</div>
	<?php
		if(isset($_SESSION['alert'])){
			unset($_SESSION['alert']);
		} 
	?>
</div>
<?php require_once "footer.php"; ?>