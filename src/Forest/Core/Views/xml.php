<?php
/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

header('Content-Type:text/xml');

/**
 * Generate XML data
 *
 * @param array $data
 *
 * @return string $result formatted XML
 */
function generateXml($data, $level = 2) {
	$result = null;
	
	if (is_array($data) || is_object($data)) {
		foreach ($data as $key => $value) {
			$result .= str_repeat('    ', $level) . '<' . $key . '>' . "\n" . generateXml($value, ($level + 1));
			$result .= str_repeat('    ', $level) . '</' . $key . '>' . "\n";
		}
	} else {
		$result = str_repeat('    ', $level) . htmlspecialchars($data, ENT_QUOTES) . "\n";
	}
	
	return $result;
}

echo '<result>' . "\n";
echo generateXml($data);
echo '</result>' . "\n";
?>