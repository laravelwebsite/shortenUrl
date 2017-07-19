<?php
	function getJobid($defaultLink)
	{
	    	$whatIWant = substr($defaultLink,strrpos($defaultLink, "-") + 1);
		if(strpos($whatIWant, '//?token') !== FALSE) $whatIWant = stristr($whatIWant, '//?token', true);
		elseif(strpos($whatIWant, '/?token') !== FALSE) $whatIWant = stristr($whatIWant, '/?token', true);
		elseif(strpos($whatIWant, '?token') !== FALSE) $whatIWant = stristr($whatIWant, '?token', true);
		if(strpos($whatIWant, '//?seeder_id') !== FALSE) $whatIWant = stristr($whatIWant, '//?seeder_id', true);
		elseif(strpos($whatIWant, '/?seeder_id') !== FALSE) $whatIWant = stristr($whatIWant, '/?seeder_id', true);
		return $whatIWant;
	}
?>