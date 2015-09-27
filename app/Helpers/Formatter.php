<?php
Class Formatter {

	// Format a number as US currency
	public static function currency($amount) {
		return '$' . number_format($amount, 2, '.', ',');
	}

	// Show form value first from old input, secondly from the model, and lastly empty
	public static function formValue($field, $modelField = '') {
		if (old($field)) {
			return old($field);
		} else {
			return $modelField;
		}
	}

	// Generate selectbox and select based on old, model, then empty
	public static function selectBox($field, $options, $modelField = '') {
		$selectbox = '<select name="' . $field . '" id="' . $field . '" class="form-control">';
		foreach ($options as $optionKey => $optionValue) {
			if (old($field) && old($field) == $optionKey) {
				$selectbox .= '<option value="' . $optionKey . '" selected="selected">' . $optionValue . '</option>';
			} else if ($modelField && $modelField == $optionKey) {
				$selectbox .= '<option value="' . $optionKey . '" selected="selected">' . $optionValue . '</option>';
			} else {
				$selectbox .= '<option value="' . $optionKey . '">' . $optionValue . '</option>';
			}
		}
		$selectbox .= '</select>';
		echo $selectbox;
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