<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['db_invalid_connection_str'] = 'Die Datenbankeinstellungen konnten nicht aus der von Ihnen ├╝bermittelten Verbindungszeichenfolge ermittelt werden.';
$lang['db_unable_to_connect'] = 'Mit den bereitgestellten Einstellungen konnte keine Verbindung zum Datenbankserver hergestellt werden.';
$lang['db_unable_to_select'] = 'Die angegebene Datenbank konnte nicht ausgew├Ąhlt werden: %s';
$lang['db_unable_to_create'] = 'Die angegebene Datenbank konnte nicht angelegt werden: %s';
$lang['db_invalid_query'] = 'Die von Ihnen gesendete Abfrage ist ung├╝ltig.';
$lang['db_must_set_table'] = 'Sie m├╝ssen die f├╝r die Abfrage genutzte Tabelle der Datenbank festlegen.';
$lang['db_must_use_set'] = 'Sie m├╝ssen die "set"-Methode verwenden, um einen Eintrag zu aktualisieren.';
$lang['db_must_use_index'] = 'Sie m├╝ssen einen Index angeben, f├╝r den die Batch-Aktualisierungen angewandt werden soll.';
$lang['db_batch_missing_index'] = 'F├╝r eine oder mehrere Zeilen, die zur Batch-Aktualisierung festgelegt werden, fehlt der angegebene Index.';
$lang['db_must_use_where'] = 'Aktualisierungen sind nur erlaubt, wenn sie einen WHERE-Filter enthalten.';
$lang['db_del_must_use_where'] = 'L├Âschungen sind nur erlaubt, wenn sie einen WHERE- oder LIKE-Filter enthalten.';
$lang['db_field_param_missing'] = 'Zum Abrufen von Feldern ist der Name der Tabelle als Parameter erforderlich.';
$lang['db_unsupported_function'] = 'Diese Funktion steht f├╝r die von Ihnen verwendete Datenbank nicht zur Verf├╝gung.';
$lang['db_transaction_failure'] = 'Transaktionsfehler: Alle ├änderungen wurden r├╝ckg├Ąnig gemacht.';
$lang['db_unable_to_drop'] = 'Die angegebene Datenbank konnte nicht gel├Âscht werden.';
$lang['db_unsupported_feature'] = 'Die von Ihnen verwendete Datenbank unterst├╝tzt diese Funktionalit├Ąt leider nicht.';
$lang['db_unsupported_compression'] = 'Das von Ihnen gew├Ąhlte Dateikomprimierungsformat wird von Ihrem Server nicht unterst├╝tzt.';
$lang['db_filepath_error'] = 'Der von Ihnen angegebene Dateipfad ist nicht beschreibbar.';
$lang['db_invalid_cache_path'] = 'Der von Ihnen angegebene Cache-Pfad ist nicht beschreibbar.';
$lang['db_table_name_required'] = 'F├╝r diese Operation ist ein Tabellenname erforderlich.';
$lang['db_column_name_required'] = 'F├╝r diese Operation ist ein Spaltenname erforderlich.';
$lang['db_column_definition_required'] = 'F├╝r diese Operation ist eine Spaltendefinition erforderlich.';
$lang['db_unable_to_set_charset'] = 'Der Zeichensatz konnte nicht gesetzt werden: %s';
$lang['db_error_heading'] = 'Es ist ein Datenbankfehler aufgetreten';
