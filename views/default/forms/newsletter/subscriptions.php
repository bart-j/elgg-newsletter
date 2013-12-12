<?php

	/**
	 * Manage the subsciptions of a specific user
	 *
	 * @uses	$vars['entity']	The user to manage the subscriptions of
	 */

	$entity = elgg_extract("entity", $vars);
	
	$processed_subscriptions = array();
	
	// description
	echo elgg_view("output/longtext", array("value" => elgg_echo("newsletter:subscriptions:description"), "class" => "mtn"));
	
	// site subscription
	$site = elgg_get_site_entity();
	$processed_subscriptions[] = $site->getGUID();
	
	$title = elgg_echo("newsletter:subscriptions:site:title");
	
	$content = elgg_view("output/longtext", array("value" => elgg_echo("newsletter:subscriptions:site:description"), "class" => "mtn mbs"));
	
	$content .= "<table class='elgg-table-alt'>";
	$content .= "<tr>";
	$content .= "<th>&nbsp;</th>";
	$content .= "<th class='newsletter-settings-small'>" . elgg_echo("on") . "</th>";
	$content .= "<th class='newsletter-settings-small'>" . elgg_echo("off") . "</th>";
	$content .= "</tr>";
	
	$on = "";
	$off = "checked='checked'";
	if (newsletter_check_user_subscription($entity, $site)) {
		$on = "checked='checked'";
		$off = "";
	}
	
	$content .= "<tr>";
	$content .= "<td>" . $site->name . "</td>";
	$content .= "<td class='newsletter-settings-small'><input type='radio' name='subscriptions[" . $site->getGUID() . "]' value='1' " . $on . " /></td>";
	$content .= "<td class='newsletter-settings-small'><input type='radio' name='subscriptions[" . $site->getGUID() . "]' value='0' " . $off . " /></td>";
	$content .= "</tr>";
	$content .= "</table>";
	
	echo elgg_view_module("info", $title, $content);
	
	// my group subscriptions
	$my_groups = get_users_membership($entity->getGUID());
	
	if (!empty($my_groups)) {
		$title = elgg_echo("newsletter:subscriptions:groups:title");
		
		$content = elgg_view("output/longtext", array("value" => elgg_echo("newsletter:subscriptions:groups:description"), "class" => "mtn mbs"));
		
		$content .= "<table class='elgg-table-alt'>";
		$content .= "<tr>";
		$content .= "<th>&nbsp;</th>";
		$content .= "<th class='newsletter-settings-small'>" . elgg_echo("on") . "</th>";
		$content .= "<th class='newsletter-settings-small'>" . elgg_echo("off") . "</th>";
		$content .= "</tr>";
		
		$group_content = array();
		$group_order = array();
		
		foreach ($my_groups as $group) {
			$processed_subscriptions[] = $group->getGUID();
			$group_order[$group->getGUID()] = $group->name;
			 
			$on = "";
			$off = "checked='checked'";
			if (newsletter_check_user_subscription($entity, $group)) {
				$on = "checked='checked'";
				$off = "";
			}
			
			$group_content[$group->getGUID()] = "<tr>";
			$group_content[$group->getGUID()] .= "<td>" . $group->name . "</td>";
			$group_content[$group->getGUID()] .= "<td class='newsletter-settings-small'><input type='radio' name='subscriptions[" . $group->getGUID() . "]' value='1' " . $on . " /></td>";
			$group_content[$group->getGUID()] .= "<td class='newsletter-settings-small'><input type='radio' name='subscriptions[" . $group->getGUID() . "]' value='0' " . $off . " /></td>";
			$group_content[$group->getGUID()] .= "</tr>";
		}
		
		natcasesort($group_order);
		foreach ($group_order as $guid => $dummy) {
			$content .= $group_content[$guid];
		}
		
		$content .= "</table>";
		
		echo elgg_view_module("info", $title, $content);
	}
	
	// other group subscriptions
	$options = array(
		"types" => array("site", "group"),
		"relationship" => NEWSLETTER_USER_SUBSCRIPTION,
		"relationship_guid" => $entity->getGUID(),
		"limit" => false,
		"wheres" => array("(e.guid NOT IN (" . implode(",", $processed_subscriptions) . "))")
	);
	
	$subscriptions = elgg_get_entities_from_relationship($options);
	
	if (!empty($subscriptions)) {
		$title = elgg_echo("newsletter:subscriptions:other:title");
		
		$content = elgg_view("output/longtext", array("value" => elgg_echo("newsletter:subscriptions:other:description"), "class" => "mtn mbs"));
		
		$content .= "<table class='elgg-table-alt'>";
		$content .= "<tr>";
		$content .= "<th>&nbsp;</th>";
		$content .= "<th class='newsletter-settings-small'>" . elgg_echo("on") . "</th>";
		$content .= "<th class='newsletter-settings-small'>" . elgg_echo("off") . "</th>";
		$content .= "</tr>";
		
		$subscriptions_order = array();
		$subscriptions_content = array();
		
		foreach ($subscriptions as $subscription) {
			$subscriptions_order[$subscription->getGUID()] = $subscription->name;
			
			$on = "";
			$off = "checked='checked'";
			if (newsletter_check_user_subscription($entity, $subscription)) {
				$on = "checked='checked'";
				$off = "";
			}
				
			$subscriptions_content[$subscription->getGUID()] = "<tr>";
			$subscriptions_content[$subscription->getGUID()] .= "<td>" . $subscription->name . "</td>";
			$subscriptions_content[$subscription->getGUID()] .= "<td class='newsletter-settings-small'><input type='radio' name='subscriptions[" . $subscription->getGUID() . "]' value='1' " . $on . " /></td>";
			$subscriptions_content[$subscription->getGUID()] .= "<td class='newsletter-settings-small'><input type='radio' name='subscriptions[" . $subscription->getGUID() . "]' value='0' " . $off . " /></td>";
			$subscriptions_content[$subscription->getGUID()] .= "</tr>";
		}
		
		natcasesort($subscriptions_order);
		foreach ($subscriptions_order as $guid => $dummy) {
			$content .= $subscriptions_content[$guid];
		}
		
		$content .= "</table>";
		
		echo elgg_view_module("info", $title, $content);
	}
	
	echo "<div class='elgg-foot'>";
	echo elgg_view("input/hidden", array("name" => "user_guid", "value" => $entity->getGUID()));
	echo elgg_view("input/submit", array("value" => elgg_echo("save")));
	echo "</div>";
	