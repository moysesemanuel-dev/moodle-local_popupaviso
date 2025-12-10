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
 * TODO describe file delete
 *
 * @package    local_popupaviso
 * @copyright  2025 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 require_once(__DIR__ . '/../../../config.php');

require_login();
require_capability('moodle/site:config', context_system::instance());

$id = required_param('id', PARAM_INT);

$PAGE->set_url(new moodle_url('/local/popupaviso/admin/delete.php', ['id' => $id]));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('deletepopup', 'local_popupaviso'));
$PAGE->set_heading(get_string('deletepopup', 'local_popupaviso'));

echo $OUTPUT->header();

global $DB;

// Busca o registro
$popup = $DB->get_record('local_popupaviso_popups', ['id' => $id], '*', MUST_EXIST);

// Confirmação
$continueurl = new moodle_url('/local/popupaviso/admin/manage.php');
$cancelurl = new moodle_url('/local/popupaviso/admin/manage.php');

if (optional_param('confirm', 0, PARAM_BOOL)) {
    // Exclui o registro
    $DB->delete_records('local_popupaviso_popups', ['id' => $id]);
    redirect($continueurl, get_string('deletedpopup', 'local_popupaviso'));
} else {
    // Mostra tela de confirmação
    echo $OUTPUT->confirm(
        get_string('confirmdelete', 'local_popupaviso', $popup->name),
        new moodle_url('/local/popupaviso/admin/delete.php', ['id' => $id, 'confirm' => 1]),
        $cancelurl
    );
}

echo $OUTPUT->footer();