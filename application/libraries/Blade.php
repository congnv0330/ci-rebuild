<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

use Jenssegers\Blade\Blade as BladeTemplate;

class Blade
{
	protected $blade;
	protected $ci;

	public function __construct()
	{
		$path = FCPATH . 'resources/views';
		$cache = APPPATH . 'cache/views';

		if (!file_exists($path)) {
			mkdir($path, 0755);
		}

		if (!file_exists($cache)) {
			mkdir($cache, 0755);
		}

		$this->ci =& get_instance();
		$this->blade = new BladeTemplate($path, $cache);
	}

	/**
	 * Render blade view and minify
	 *
	 * @param $view
	 * @param array $data
	 */
	public function view($view, $data = array())
	{
		ini_set("pcre.recursion_limit", "16777");

		$buffer = $this->blade->make($view, $data)->render();

		if ($this->ci->config->item('env') === 'production') {
			$re = '%# Collapse whitespace everywhere but in blacklisted elements.
			(?>             # Match all whitespans other than single space.
			  [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
			| \s{2,}        # or two or more consecutive-any-whitespace.
			) # Note: The remaining regex consumes no text at all...
			(?=             # Ensure we are not in a blacklist tag.
			  [^<]*+        # Either zero or more non-"<" {normal*}
			  (?:           # Begin {(special normal*)*} construct
				<           # or a < starting a non-blacklist tag.
				(?!/?(?:textarea|pre|script)\b)
				[^<]*+      # more non-"<" {normal*}
			  )*+           # Finish "unrolling-the-loop"
			  (?:           # Begin alternation group.
				<           # Either a blacklist start tag.
				(?>textarea|pre|script)\b
			  | \z          # or end of file.
			  )             # End alternation group.
			)  # If we made it here, we are not in a blacklist tag.
			%Six';

			$buffer = preg_replace($re, " ", $buffer);

			if ($buffer === null) {
				$buffer = $buffer;
			}
		}

		echo $buffer;
	}
}
