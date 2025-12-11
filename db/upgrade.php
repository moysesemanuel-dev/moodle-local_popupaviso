<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Upgrade script for local_popupaviso plugin.
 *
 * @package    local_popupaviso
 * @copyright  2025 YOUR NAME <
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_local_popupaviso_upgrade($oldversion) {
    global $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 2025070700) {
        $table = new xmldb_table('local_popupaviso_popups');

        // LINHAS CORRIGIDAS: Removido o último argumento 'null' de todas as chamadas add_field
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, true, null, null); // Corrigida anteriormente, mas reconfirmando
        $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, false, 'Popup', null);
        $table->add_field('url', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, false, null, null);
        $table->add_field('mensagem', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, false, null, null);
        $table->add_field('video', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, false, '', null);
        $table->add_field('cor', XMLDB_TYPE_CHAR, '7', null, XMLDB_NOTNULL, false, '#f8d7da', null);
        $table->add_field('limite', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, false, '1', null);
        $table->add_field('active', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, false, '1', null);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, false, null, null);
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, false, null, null);

        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
    }

    return true;
}