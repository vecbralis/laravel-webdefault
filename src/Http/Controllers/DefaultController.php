<?php

namespace MVsoft\Webdefault\Http\Controllers;

use Config;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    
    /**
     * Default admin page
     */
    public function getIndex()
    {

    	if(Config::get('webdefault.defaultPage.template'))
    		return view(Config::get('webdefault.defaultPage.templateLink'));
    	else
    		return redirect()->to(Config::get('webdefault.defaultPage.redirect'));

    }

}
