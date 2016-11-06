<?php

namespace MVsoft\Webdefault\Services;

use Mail, Session, App;
use MVsoft\Webdefault\Models\EmailTemplate;

class MVemail {

	protected $code;

	protected $emailInfo;

	protected $to;

	protected $from;

	protected $data = [];

	protected $files = [];

	protected $copyTo = [];

	protected $callback;

	public function send($code, $emailInfo, $to, $callback = false, $from = false, $copyTo = [], $files = [])
    {
    	$this->code = $code;
    	$this->emailInfo = $emailInfo;
    	$this->to = $to;
    	$this->from = $from;
    	$this->files = $files;
    	$this->copyTo = $copyTo;
    	$this->callback = $callback;

    	//Generate email template
    	$this->generateEmail();

    	//Send email
    	$this->sendEmail();
    }

    protected function sendEmail()
    {

    	$files    	= $this->files;
    	$to      	= $this->to;
    	$from    	= $this->from;
    	$copyTo  	= $this->copyTo;
    	$subject 	= $this->data['subject'];
    	$callback 	= $this->callback;

    	Mail::queue('mvsoft::emails.template', $this->data, function ($message) use ($files, $to, $from, $copyTo, $subject, $callback) {
		    
		    if($from)
		    	$message->from($from['email'], $from['name']);
		    
		    $message->to($to['email'], $to['name']);

		    $message->subject($subject);

		    if(count($copyTo) > 0)
		    	foreach($copyTo as $copy)
		    		$message->to($copy['email'], $copy['name']);

    		if(count($files) > 0)
    			foreach($files as $file)
    				$message->attachDate($file['file']->fileOutput(), $file['name']);

    		//Run callback
    		if($callback) {	
	    		$callback($message);
		}
		
		});

    }

    protected function generateEmail()
    {
    	//Get language code
    	$langCode = Session::has('lang_code') ? Session::get('lang_code') : App::getLocale();

    	$email = EmailTemplate::where('code', $this->code.'_'.$langCode)->first();

    	if(!$email)
    		$email = EmailTemplate::where('code', $this->code)->first();

    	if($email)
    	{
    		$this->data['content'] = $this->htmlEmail($email);
    		$this->data['subject'] = $email->email_title;
    	}
    	else
    	{
    		$this->data['content'] = $this->code;
    		$this->data['subject'] = $this->code;
    	}
    }

    protected function htmlEmail($email)
    {
    	$html = $email->email_text;

    	foreach($this->emailInfo AS $key => $info)
    		$html = str_replace('[['.$key.']]', $info, $html);

    	return $html;
    }

    protected function callback($boolean){}

}
