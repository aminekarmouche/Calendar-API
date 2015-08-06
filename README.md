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
### iCal Support
Calendars and events can be exposed in ical/ics format by using the query format=ical

```
\?format=ical
```
### Endpoints

Calendars

```
Method  HTTP request                    Description
---------------------------------------------------------------------------------------------
Clear  	POST                            Clears a calendar by deleting all corresponding events 
        /calendars/{calendarID}/clear
Delete  DELETE 	                 		Deletes a calendar
        /calendars/{calendarID}
Get 	GET 	                		Returns a calendar
        /calendars/{calendarID} 
Insert 	POST 					        Creates a calendar
        /calendars
List	GET		        				Lists all calendars        
        /calendars
Patch 	PATCH 	                	    Updates partial data of a calendar
        /calendars/{calendarID}	
Update  PUT                             Updates an entire calendar
        /calendars/{calendarID} 		
```
Events
```
Method  HTTP request                    Description
------------------------------------------------------------------------------------------------
Delete  DELETE 	 	                    Deletes a calendar
        /calendars/{calendarID}/events/{eventID}
Get 	GET 		                	Lists a calendar
        /calendars/{calendarID}/events/{eventID}
Insert 	POST                        	Creates a calendar
        /calendars/{calendarID}/events	
List	GET		                		List all calendar events
        /calendars/{calendarID}/events
Patch 	PATCH 	                    	Updates partial data of an event
        /calendars/{calendarID}/events/{eventID}
Update  PUT                             Updates an entire event
        /calendars/{calendarID}/events/{eventID}
```

### TODO List
- OAuth authentication
- Apply HATEOAS
- improve doc on [Read the docs!](http://calendar-api.readthedocs.org/en/latest/)
- Shift towards fat models and skinny controllers 
- Add multiple timezones
- Provide iCal support according to accept headers instead of query string
- Configure testing database for better speed
- Improve tests and use BDD


