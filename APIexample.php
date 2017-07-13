<?php

/*
 * example of use of the phpList Hosted API
 *
 * requires the phpListHostedClient.class.php and NuSoap
 * http://phplist.svn.sourceforge.net/viewvc/phplist/API/
 *
 * this file is meant to be called from commandline.
 */

## settings

$phpListHostedAPI = 'https://www.phplist.com/API/soap.php';
$phpListInstall = 'xxx';
$phpListUser = 'email@server.com';
$phpListPassword = 'test';
$classLocation = dirname(__FILE__); ## place where the API client class is

include 'config.php'; ## to change the settings from a local config file

$mySoapURL = $phpListHostedAPI.'?tag='.$phpListInstall.'&user='.$phpListUser.'&pass='.$phpListPassword;

## for nuSoap, we need to suppress some error output
error_reporting(E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);

require $classLocation ."/phplistHostedClient.class.php";

/* initialise our connection to phpList Hosted */
$phpList = new phpListHostedSoapClient($mySoapURL);

/* set a name of our newsletter */
$myListName = 'My Newsletter';

/* let's just check the connection is ok */
print $phpList->HelloWorld();

/* does our list already exist ? */
$myListId = $phpList->getListIdByName($myListName);

/* if not, let's create it */
if ($myListId < 0) {
  $myListId = $phpList->createNewList($myListName,'Some List to play around with');
}

print "MyListId = $myListId\n";

/* keep track of some subscribers to remove again (just to show the functionality) */
$remove = array();

/* add a few random emails */
for ($i = 0 ; $i< 10; $i++) {
  $email = 'phplisttest-'.time().'@mailinator.com';
  if (rand(0,10) > 5) {
    $remove[] = $email;
  }
  $phpList->addEmail($email,$myListId);
}

print "Added some emails\n";

/* remove some of them from the list again */
$removed = $phpList->removeEmailsFromList($myListId,$remove);

print "Now removing a few:\n";
/* which ones were they ? */
var_dump($removed);

/* create a simple campaign */
$content = '<html><body><h1>HTML TEST CAMPAIGN</h1>
<p>What fun this is</p>
</body></html>';
$footer = '<a href="[UNSUBSCRIBEURL]">Unsubscribe</a>';

/* add it to our list */
$myCampaignID = $phpList->createHtmlMessage(
  'This is my phpList Hosted API Test message',
  $content,
  'phplist-from@mailinator.com phpList From Field',
  $footer,
  $myListId
);

$content2 = '<html><body><h1>HTML TEST CAMPAIGN, BUT THEN REPLACED</h1><p>What fun this is</p>
<p><a href="http://www.phplist.com">Let\'s put some link in</a></p>
</body></html>';

/* and then actually change the campaign again */
$phpList->updateHtmlMessage($myCampaignID,
  'Another subject',$content2,
  'phplist-from@mailinator.com Changed',
  '<div class="footer">'.$footer.'</div>',
  $myListId
);
print "Campaign create with ID $myCampaignID\n";

/* and put it in the queue for sending */
$phpList->submitMessage($myCampaignID);

