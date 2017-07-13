FORMAT: 0.1

# phpList Hosted SOAP API

SOAP API for phpList accounts hosted on phpList.com. See README for setup and requirements. This file borrows conventions from [api blueprint](https://apiblueprint.org/).

### Debugging

#### HelloWorld

Check that a connection can be established with a successful response and return API and phpList version.

+ Request

		(no arguments)
		
+ Response

		string("Hi there, from phpList Hosted, API version 0.1 - rev $Rev: 2788 $ managing phpList version 3.3.1-hosted")

### Campaigns

#### getMessageLittleStats

+ Request

    	$message_id

+ Response

		Array
		(
		    [processed] => 55
		    [viewed] => 26
		    [urls] => Array
			(
			)

		) // success

### createHtmlMessage

Create a new HTML campaign.

+ Request

	    $subject
	    $content
	    $from_field
	    $footer
	    $list_id

+ Response

		int(21)		// success
		bool(false)	// failure

#### updateHtmlMessage

Update an existing campaign.

+ Request

		$message_id
		$subject
		$content
		$from_field
		$footer
		$list_id

+ Response

		int(21)		// success
		bool(false)	// failure

### submitMessage

Add an existing campaign to the message queue for sending (actual send date depends on campaign scheduling). 

[FIXME] Always returns string(1), regardless of campaign ID or outcome.

+ Request

		$messageid
		
+ Response

		string(1)	// success / failure
		
### Lists

#### getListIdByName

Get the list ID for a given list name.

[FIXME] Always returns int(-1) regardless of input

+ Request

		$list_name
		
+ Response

		int(3)	// success
		int(-1)	// failure

#### createNewList

Create a new subscriber list.

+ Request

		$name
		$description
		
+ Response

		int(11) // success

#### addListToCategory

Add an existing list to a list category. 

[NOTE] Specified category will be created if it doesn't exist.

+ Request

		$list_id
		$category_name
		
+ Response

		string(10) "category 1"	// success
		bool(false) 			// failure

### Subscribers

#### isListSubscriber

Check if a given subscriber is a member of a given list.

+ Request

		$email
		$list_id
		
+ Response

		string(1)	// true
		string(0)	// false

#### addEmail

Add a subscriber to a given list.

[NOTE] If the subscriber does not exist it will be created

+ Request

		$email
		$list
		
+ Response
		
		Array
		(
		    [0] => email@address.com
		)	// success
		bool(false)	// failure

#### removeEmailsFromList

+ Request

		$list_id
		$emails
		
+ Response

		Array
		(
		    [0] => email@address.com
		    [1] => address@email.com
		)			// success
		Array
		(
		)			// false
		bool(false) // failure
