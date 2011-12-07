<?php
/**
 TODO: Add command line parameters for specifying the replacements and translation files, overwriting the original, etc.
 */

// Change these two file names to match your case.
$translation_file = 'drupal-7.9.pt-pt-pre-acordo.po';
$replacements_file = 'replacements.json';


////////////////////////////////////////////////
// Don't change anything else below this line //
////////////////////////////////////////////////

// Decode the replacements json code and remove the unnecessary outer array from the result.
$replacements_json = file_get_contents($replacements_file);
$replacements = json_decode($replacements_json, true);
if ($replacements === null) {
	die('Error decoding replacements JSON, aborting.');
}
$replacements = $replacements['replacements'];

// Get the translation file contents, run through all the replacements and make the necessary changes in the translation.
$translation = file_get_contents($translation_file);
foreach ($replacements as $original => $replacement) {
	$translation = str_replace($original, $replacement, $translation);	
}
file_put_contents($translation_file, $translation);

