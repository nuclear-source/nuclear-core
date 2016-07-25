<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */

require VENDORPATH."MX/Router.php";

class NC_Router extends MX_Router {
	
public function __construct()
        {
                parent::__construct();
        }
}