<?php
Class Formatter {

	// Show form value first from old input, secondly from the model, and lastly empty
	public static function formValue($field, $modelField = '') {
		if (old($field)) {
			return old($field);
		} else {
			return $modelField;
		}
	}

	public static function dateWebToDatabase($date) {
		if (trim($date)) {
			return date('Y-m-d H:i:s', strtotime($date));
		} else {
			return null;
		}
	}

	public static function dateDatabaseToWeb($date) {
		if (trim($date)) {
			return date('m/d/Y h:i a', strtotime($date));
		} else {
			return null;
		}
	}

	public static function dateDatabaseToWebPretty($date) {
		if (trim($date)) {
			$result = '<b>';
			$result .= date('g:ia', strtotime($date));
			$result .= '</b> on <b>';
			$result .= date('n/d/Y', strtotime($date));
			$result .= '</b>';
			return $result;
		} else {
			return null;
		}
	}

}