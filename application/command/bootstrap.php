<?php

use Command\Script\Make\Controller;
use Command\Script\Make\Helper;
use Command\Script\Make\Library;
use Command\Script\Make\Model;

if (isset($_SERVER["argv"][1])) {
	$code = explode(':', $_SERVER["argv"][1]);

	if (count($code) == 2) {
		$instance = null;
		$classAction = null;

		switch ($code[0]) {
			case 'make':
				switch ($code[1]) {
					case 'controller':
						$instance = new Controller();
						$classAction = "Controller";
						break;
					case 'model':
						$instance = new Model();
						$classAction = "Model";
						break;
					case 'helper':
						$instance = new Helper();
						$classAction = "Helper";
						break;
					case 'library':
						$instance = new Library();
						$classAction = "Library";
						break;
					default:
						echo $code[1] . " not defined! \n";
						die();
				}

				if (!empty($_SERVER['argv'][2])) {
					$instance->create($_SERVER['argv'][2]);
					echo "Create sucsessfully " . $classAction . ": {$_SERVER['argv'][2]}\n";
					die();
				} else {
					echo "Error, Missing --name";
				}

				break;

			default:
				echo "Error: Action unsuport!\n";
				die();

		}
	} else {
		echo "Command: php ci --action --name \n\n --action \nmake:controller \t Create controller \nmake:model \t\t Create model \nmake:helper \t\t Create helper \nmake:library \t\t Create library";
	}
}

echo "\n";
