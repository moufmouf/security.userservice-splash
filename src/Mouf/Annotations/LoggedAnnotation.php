<?php
namespace Mouf\Annotations;

use Mouf\MoufManager;

use Mouf\Mvc\Splash\Filters\AbstractFilter;

use Mouf\Mvc\Splash\Services\FilterUtils;


// FIXME: HOW TO REGISTER THIS???
FilterUtils::registerFilter("Logged");

/**
 * The @Logged filter should be used to check whether a user is logged or not.
 * It will try to do so by querying the "userService" instance, that should
 * be an instance of the "UserService" class (or a class extending the UserServiceInterface).
 * 
 * You can pass an additional parameter to overide the name of the instance.
 * For instance: @Logged("myUserService") will verify that the user is logged or not
 * using the "myUserService" instance.
 *
 */
class LoggedAnnotation extends AbstractFilter
{
	
	public function __construct($value) {
		$this->value = trim($value, " (\"'");
	}
	
	/**
	 * The value passed to the filter.
	 */
	protected $value;

	
	/**
	 * Function to be called before the action.
	 */
	public function beforeAction() {
		
		if (!empty($this->value)) {
			$value = $this->value;
		} else {
			$value = "userService"; 
		}
		try {

			// FIXME
			// FIXME
			// FIXME
			// FIXME
			// FIXME
			// FIXME!
			// We must think out of the box!!!!
			// An annotation is NOT a filter.
			// We must split the notion of filter from the notion of annotation!!!!
			// Filters are :
			// Run on EACH action
			// They have a chance to catch annotations!
			// Annotations are simple objects coming from classes.
			// We can use Doctrine annotations (why not!)
			// This will make PLENTY of things WAY easier!!!
			// THIS IS SPLASH 6!!!!

			$userService = MoufManager::getMoufManager()->getInstance($value);
		} catch (MoufInstanceNotFoundException $e) {
			if (!empty($this->value))
				throw new MoufException("Error using the @Logged annotation: unable to find the UserService instance named: ".$this->value, $e);
			else
				throw new MoufException("Error using the @Logged annotation: by default, this annotation requires a component named 'userService', and that extends the UserServiceInterface interface.", $e);
		}
		
		$is_logged = $userService->isLogged();
		if(!$is_logged){
			$userService->redirectNotLogged();
		}
	}

	/**
	 * Function to be called after the action.
	 */
	public function afterAction() {

	}
}
