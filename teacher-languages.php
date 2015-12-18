<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/Language.Controller.php';
	include_once 'controller/User.Controller.php';

	if($language == "ar_EG") $lang = "-ar";
	else if($language == "es_ES") $lang = " spanish";
	else if($language == "zh_CN") $lang = " chinese";
	else if($language == "en_US") $lang = "";

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

<div class="top-buttons">
	<div class="wrap">
		<?php $active = ''; ?>
		<?php include "menu.php"; ?>
		<a class="link back" href="teacher.php">&laquo <?php echo _("Go Back"); ?></a>
	</div>
</div>

<div id="content">
<div class="wrap">
	<br/>
	<h2><?php echo _("Language Settings"); ?></h2>
	<br/>
	<?php if(isset($_SESSION['alert'])) { ?>
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
	
	<?php } ?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="language_form">
		<table border="1" class="language-table">
			<tr>
				<!-- <th><input type="checkbox" name='checkall' id="check-all"></th> -->
				<th><?php echo _("Enable"); ?></th>
				<th><?php echo _("Languages"); ?></th>
				<th><?php echo _("Default"); ?></th>
			</tr>
			<?php
				$ctr = 0;
				foreach($languages as $languagex) : 
				$ctr++;
			?>
				<tr>
					<td>
						<?php 
							$found = false;
							foreach($teacher_languages as $tl):
								if($tl['language_id'] == $languagex->getLanguage_id()): 
									$found = true;
						?>
							<div class="onoffswitch">
								<input type="checkbox" name="cbx[]" class="onoffswitch-checkbox" id="lang_<?php echo $ctr; ?>" value="<?php echo $languagex->getLanguage_id(); ?>" checked>
								<label class="onoffswitch-label" for="lang_<?php echo $ctr; ?>">
									<div class="onoffswitch-inner<?php echo $lang; ?>"></div>
									<div class="onoffswitch-switch<?php echo ($lang == '-ar' ? $lang : ''); ?>"></div>
								</label>
							</div>
						<?php  
								endif; 
							endforeach; 
						?>
							
						<?php if(!$found):	?>
							<!-- <input type="checkbox" name="cbx[]" value="<?php echo $language->getLanguage_id(); ?>" id="lang_<?php echo $ctr; ?>" /> -->
								<div class="onoffswitch">
									<input type="checkbox" name="cbx[]" class="onoffswitch-checkbox" id="lang_<?php echo $ctr; ?>" value="<?php echo $languagex->getLanguage_id(); ?>">
									<label class="onoffswitch-label" for="lang_<?php echo $ctr; ?>">
										<div class="onoffswitch-inner<?php echo $lang; ?>" ></div>
										<div class="onoffswitch-switch<?php echo ($lang == '-ar' ? $lang : ''); ?>"></div>
									</label>
								</div>
						<?php endif; ?>
					</td>
					<td><?php echo $languagex->getLanguage(); ?></td>
					<td>
						<center>
							<?php 
								$found2 = false;
								foreach($teacher_languages as $tl2):
									if($tl2['language_id'] == $languagex->getLanguage_id() && $tl2['is_default'] == 1) : 
										$found2 = true;
							?>
								<input type="radio" value="<?php echo $languagex->getLanguage_id(); ?>" name="locale" id="locale_<?php echo $ctr; ?>" checked />
							<?php 
									endif; 
								endforeach;
							?>
							<?php if(!$found2):	?>
								<input type="radio" value="<?php echo $languagex->getLanguage_id(); ?>" name="locale" id="locale_<?php echo $ctr; ?>" />
							<?php endif; ?>
							<?php echo _("Set as default"); ?>
						</center>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<input type="submit" class="button1 submit-language save-changes" name="submit-language" value="<?php echo _("Save Changes"); ?>"></center>
		<a href="teacher.php" class="button1 cancel-changes"><?php echo _("Cancel"); ?></a>
	</form>
	<?php
		if(isset($_SESSION['alert'])){
			unset($_SESSION['alert']);
		} 
	?>
</div>

<ul id="tlyPageGuide" data-tourtitle="Step by Step Page Guide">
  <li class="tlypageguide_left" data-tourtarget="#check-all">
    <p><?php echo _("Click the box (on the left) of the language/s you want to activate. Choose the default language you want to use by clicking the radio button on the right.  Note that the default language is set to English when you first log in."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget="#cp">
    <p><?php echo _("Update your <strong>password</strong> to something that you can easily remember."); ?></p>
  </li>
  <li class="tlypageguide_right" data-tourtarget=".submit-language">
    <p><?php echo _("Click the <strong>Submit</strong> button to save your changes."); ?></p>
  </li>
</ul>
<script>
	var language;
	var check = false;
	$(document).ready(function() {
		$('.onoffswitch-checkbox').click(function(){
			language = $(this).val();
			$(this).parent().parent().parent().find('input[type=radio]').attr('disabled', false);
			if($(this).is(':checked')) {
				check = true;
			} else {
				check = false;
			}
			if(!check) {
				$(this).parent().parent().parent().find('input[type=radio]').attr('disabled', true);
			}
		});
	});
</script>
<?php require_once "footer.php"; ?>