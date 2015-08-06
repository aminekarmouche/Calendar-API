# Calendar API
A backend-driven API for saving and exposing calendar events. 

## Configuration
### Usage
To intsall using composer
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/aminekarmouche/Calendar-API"
    }
],
"require": {
    ...,
    "CalendarApi": "0.1.0"
},
```
###Formats supported
##### Input
Input is supported in JSON format
##### Output
Output is provided both in JSON and  formats  [iCal/ics](https://en.wikipedia.org/wiki/ICalendar)

### API Version
First version, please include .env file:
API_VERSION=v1

### Authentication
Basic auth provided by the Laravel framework 

##Documentation
### Exposed Resources
##### Calendars
```
 {
    "id": integer,
    "summary": string,
    "description": string,
    "location": string,
    "timezone": timezone
  }
```
##### Events

```
{
    "id": integer,
    "summary": string,
    "start": dateTime,
    "end": dateTime
}
```
### Endpoints

Calendars

-------------------------------------------------------------------------------------------------------
|Clear | 	POST		| /calendars/{calendarID}/clear Clear a calendar by deleting all corresponding events |
-------------------------------------------------------------------------------------------------------
| azaz| dfdfdf|
-------------------------------------------------------------------------------------------------------
Delete DELETE 	/calendars/{calendarID} 		Delete a calendar
Get 	GET 		/calendars/{calendarID} 		Return a calendar
Insert 	POST 		/calendars				Create a calendar
List	GET		/calendars				List all calendars
Patch 	PATCH 	/calendars/{calendarID}		Updates partial data of a calendar
Update PUT 		/calendars/{calendarID} 		Updates an entire calendar

Events
Delete DELETE 	/calendars/{calendarID}/events/{eventID} 	Delete a calendar
Get 	GET 		/calendars/{calendarID}/events/{eventID}	Return a calendar
Insert 	POST 		/calendars/{calendarID}/events		Create a calendar
List	GET		/calendars/{calendarID}/events		List all calendar events
Patch 	PATCH 	/calendars/{calendarID}/events/{eventID}	Updates partial data of an event
Update PUT 		/calendars/{calendarID}/events/{eventID} 	Updates an entire event



### TODO List
- OAuth authentication
- Shift towards fat models and skinny controllers 
- Add multiple timezones
- provide iCal support according to accept headers instead of query string
- Use sqlite as testing database for better speed
- Improve tests and use BDD


