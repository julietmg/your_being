<?php


namespace Jet_Form_Builder\Exceptions;

class Repository_Exception extends Handler_Exception {

	public function save_exception(): bool {
		return false;
	}

}
