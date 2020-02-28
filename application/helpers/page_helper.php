<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('mix')) {
	/**
	 * Get the path to a versioned Mix file.
	 *
	 * @param string $path
	 * @param string $manifestDirectory
	 * @return string
	 *
	 * @throws \Exception
	 */
	function mix($path, $manifestDirectory = 'public')
	{
		$CI =& get_instance();

		static $manifest;

		if (!$manifest) {
			if (!file_exists($manifestPath = (FCPATH . $manifestDirectory . '/mix-manifest.json'))) {
				throw new Exception('The Mix manifest does not exist.');
			}
			$manifest = json_decode(file_get_contents($manifestPath), true);
		}
		if (!starts_with($path, '/')) {
			$path = "/{$path}";
		}
		if (!array_key_exists($path, $manifest)) {
			throw new Exception(
				"Unable to locate Mix file: {$path}. Please check your " .
				'webpack.mix.js output paths and try again.'
			);
		}

		return $CI->config->item('base_url') . $manifestDirectory . $manifest[$path];
	}
}
