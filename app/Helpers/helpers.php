<?php
//helper functions

function event_to_ical($event)
{
	$vCalendar = new \Eluceo\iCal\Component\Calendar('Calendar API V1');
	$vEvent = new \Eluceo\iCal\Component\Event();

	$vEvent->setDtStart($event->start);
	$vEvent->setDtEnd($event->start);
	$vEvent->setNoTime(true);
	$vEvent->setSummary($event->summary);

	return ($vEvent);
}

function calendar_to_ical($calendar)
{
	$vCalendar = new \Eluceo\iCal\Component\Calendar('Calendar API V1');
	
	$vCalendar->setName($calendar->summary);
	$vCalendar->setDescription($calendar->description);
	$vCalendar->setTimezone($calendar->timezone);
	
	return ($vCalendar);
}
?>