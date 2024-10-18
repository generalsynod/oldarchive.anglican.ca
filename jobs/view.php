<?
require_once('base.php');

class View {
	function View($nameOfView = null, $nameOfTemplate = null) {	
		// Convention: the file name of the view is constructed from the value
		// of $nameOfView, converted entirely to lower-case, with the extension
		// .php appended to the end
		$nameOfViewFile = PATH_TO_VIEWS . '/' . strtolower($nameOfView) . '.php';
		
		// $nameOfTemplateFile is constructed the same was as $nameOfViewFile.
		$nameOfTemplateFile = PATH_TO_TEMPLATES . '/' . strtolower($nameOfTemplate) . '.php';
		
		if (file_exists($nameOfViewFile)) {			
			$theTemplate = file_get_contents($nameOfTemplateFile);
			ob_start();
			eval("?>" . file_get_contents($nameOfViewFile));
			$theView = ob_get_clean();
			eval("?>" . $theTemplate);
		}
		else {
			die("The view file for view $nameOfView does not appear to exist.");
		}
	}
}
?>