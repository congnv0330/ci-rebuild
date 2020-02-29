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
	} elseif ($_SERVER["argv"][1] === 'serve') {
		$port = 8001;
		
		if (!empty($_SERVER['argv'][2])) {
			if (is_numeric($_SERVER['argv'][2])) {
				$port = $_SERVER['argv'][2];
			} else {
				echo "Cutstom port is invalid";
				die();
			}
		}

		echo 'PHP version ' . phpversion() . "\n";
		echo "Listening on http://localhost:" . $port . "\n";
		echo "Press Ctrl-C to quit.\n";
		echo shell_exec('php -S localhost:' . $port . ' -t public/');
	} else {
		echo "To run server: php ciscript serve {custom port} \n- Default port is 8001 \nTo create file: php ciscript make:{module} {module name} \n- make:controller \t Create controller \n- make:model \t\t Create model \n- make:helper \t\t Create helper \n- make:library \t\t Create library";
	}
}

echo "\n";
