<?php

	$english = array(
		// general
		'item:object:newsletter' => "Newsletter",
		'newsletter:add' => "New newsletter",
		
		// menu's
		'newsletter:menu:site' => "Newsletters",
		'' => "",
		
		'newsletter:breadcrumb:site' => "Newsletters",
		'' => "",
		
		// pages
		'newsletter:site:title' => "All site newsletters",
		'newsletter:add:title' => "Create a newsletter",
		'newsletter:edit:title' => "Edit newsletter: %s",
		'newsletter:schedule:title' => "%s: Schedule",
		
		// edit tabs
		'newsletter:edit:tabs:entity' => "Basic",
		'newsletter:edit:tabs:content' => "Content",
		'newsletter:edit:tabs:styling' => "Styling",
		'newsletter:edit:tabs:recipients' => "Recipients",
		'newsletter:edit:tabs:schedule' => "Schedule",

		// content
		'newsletter:edit:content:description' => "Add the content to your newsletter here. Add sections of free text or import an existing blog as content into your newsletter. You can always reorder the content of this newsletter.",
	
		// schedule
		'newsletter:schedule:description' => "Here you can configure when the newsletter will be delivered to the selected recipients.",
		'newsletter:schedule:date' => "Scheduled date",
		'newsletter:schedule:time' => "Scheduled time",

		// plugin settings
		'newsletter:settings:allow_groups' => "Allow group admins to send newsletters",
		'newsletter:settings:allow_groups:description' => "Group administrators can create a newsletter for their group members.",
		'newsletter:settings:opt_out_existing_users' => "Existing users have to opt-out of the newsletters",
		'newsletter:settings:opt_out_existing_users:description' => "When you set this setting to 'yes' users who haven't yet configured their newsletter preferences will receive a newsletter.",
		
		// entity view
		'newsletter:entity:scheduled' => "Scheduled",
		'newsletter:entity:sent' => "Sent",
		
		// actions
		// edit
		'newsletter:action:edit:error:title' => "Please provide a title for the newsletter",
		'newsletter:action:edit:error:save' => "An unknown error occured while saving the newsletter, please try again",
		'newsletter:action:edit:success' => "The newsletter was saved",
		
		// delete
		'newsletter:action:delete:error:delete' => "An unknown error occured while deleting the newsletter, please try again",
		'newsletter:action:delete:success' => "The newsletter was deleted",
		
		// schedule
		'newsletter:action:schedule:success' => "Schedule saved",
		'' => "",
	);
	
	add_translation("en", $english);
