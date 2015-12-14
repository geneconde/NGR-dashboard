<?php
	require_once 'session.php';
	require_once 'locale.php';
	include_once 'header.php';
	include_once 'controller/Language.Controller.php';
	include_once 'controller/User.Controller.php';
	
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
	<center>
	<br/>
	<h2><?php echo _("Set of Languages"); ?></h2>
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
	</center>
	<?php
		if(isset($_SESSION['alert'])){
			unset($_SESSION['alert']);
		} 
	?>
</div>

<!-- Tip Content -->
<ol id="joyRideTipContent">
	<li data-id="check-all" 		data-text="<?php echo _('Next'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Click the box (on the left) of the language/s you want to activate. Choose the default language you want to use by clicking the radio button on the right.  Note that the default language is set to English when you first log in."); ?></p>
	</li>
	<li data-class="submit-language" 		data-text="<?php echo _('Close'); ?>" data-options="tipLocation:top;tipAnimation:fade">
		<p><?php echo _("Click the <strong>Submit</strong> button to save your changes."); ?></p>
	</li>
</ol>

<script>
  function guide() {
  	$('#joyRideTipContent').joyride({
      autoStart : true,
      postStepCallback : function (index, tip) {
      if (index == 10) {
        $(this).joyride('set_li', false, 1);
      }
    },
    'template' : {
        'link'    : '<a href="#close" class="joyride-close-tip"><?php echo _("Close"); ?></a>'
      }
    });
  }
</script>
<?php require_once "footer.php"; ?>