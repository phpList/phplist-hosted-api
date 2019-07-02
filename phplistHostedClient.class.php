<?php

error_reporting(E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);

/*
 * SOAP client for phpList Hosted
 *
 * version 0.1 - 2011-07-20, Michiel Dethmers phpList Ltd
 *
 * requires nuSoap: http://sourceforge.net/projects/nusoap/
 *
 * for more info https://www.phplist.com/contactus
 * 
 */ 

class phpListHostedSoapClient {

  private $soap_url = '';
  private $soap;

  function __construct($soap_url) {
    $this->soap_url = $soap_url;
    $this->xCreateSoap();
  }

  function setCredentials($username, $password, $authtype = 'basic', $digestRequest = array(), $certRequest = array()) {
    $this->soap->setCredentials($username, $password, $authtype, $digestRequest, $certRequest);
  }

  function getMessageLittleStats($message_id) {
    return $this->soap->call('phpListHosted.getMessageLittleStats', array('message_id' => $message_id));
  }

  function getListIdByName($list_name) {
    return $this->soap->call('phpListHosted.getListIdByName', array('list_name' => $list_name));
  }

  function createNewList($name, $description) {
    return $this->soap->call('phpListHosted.createNewList', array('name' => $name, 'description' => $description));
  }

  function addListToCategory($list_id,$category_name) {
    return $this->soap->call('phpListHosted.addListToCategory', array('list_id' => $list_id, 'category_name' => $category_name));
  }

  function submitMessage($messageid) {
    return $this->soap->call('phpListHosted.submitMessage', array('msg_id' => $messageid));
  }
  
  function HelloWorld() {
    return $this->soap->call('phpListHosted.HelloWorld', array());
  }

  function xCreateSoap() {
     if (is_null($this->soap)) {
       require(dirname(__FILE__)."/lib/nusoap.php");
       $this->soap = new nusoap_client($this->soap_url);
     }
  }

  function addEmail($email,$list) {
    return $this->soap->call('phpListHosted.insertNewUser', array(
      array($email),$list));
  }

  function removeEmailsFromList($list_id,$emails) {
    return $this->soap->call('phpListHosted.removeEmailsFromList', array(
      'list_id' => $list_id,'array_email' => $emails));
  }

  function isListSubscriber($email,$list_id) {
    return $this->soap->call('phpListHosted.isListSubscriber', array(
      'email' => $email,'list_id' => $list_id));
  }
  
  function createHtmlMessage($subject, $content, $from_field, $footer, $list_id) {
    return $this->soap->call('phpListHosted.createHtmlMessage',array($subject, $content, $from_field, $footer, $list_id));
  }

  function updateHtmlMessage($message_id, $subject, $content, $from_field, $footer,  $list_id) {
    return $this->soap->call('phpListHosted.updateHtmlMessage',array($message_id, $subject, $content, $from_field, $footer, $list_id));
  }

}

