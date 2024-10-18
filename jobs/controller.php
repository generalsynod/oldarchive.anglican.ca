<?
require_once('base.php');
require_once('view.php');

class Controller {
	function Controller($action = null) {
		$className = get_class($this);
		
		// Convention: all sub-classes should be called ***Controller. Therefore,
		// all sub-classes should have names that are at least 11 characters long.
		// If this is not the case, convention has not been followed and kill the
		// script.
		if (strlen($className) > 10) {
			$template = substr(get_class($this), 0, strlen($className) - 10);
		}
		else {
			die("Controller: sub-classes of the controller class should follow the convention of being named <MyCustomPrefix>Controller");
		}
			
		if (is_null($action)) {
			$theView = new View('Default', 'Default');
		}
		else {
			if ( in_array("customTemplate", get_class_methods($this)) ) {
				$theView = new View($this->viewForAction($action), $this->customTemplate($action));
			}
			else {
				$theView = new View($this->viewForAction($action), $template);
			}
		}
	}
	
	function viewForAction($action) {
		return null;
	}
}
?>
