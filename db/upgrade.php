<?php
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