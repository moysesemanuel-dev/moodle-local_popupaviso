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
 * TODO describe file edit
 *
 * @package    local_popupaviso
 * @copyright  2025 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/forms.php');

require_login();
require_capability('moodle/site:config', context_system::instance());

$id = optional_param('id', 0, PARAM_INT);

$PAGE->set_url(new moodle_url('/local/popupaviso/admin/edit.php', ['id' => $id]));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('editpopup', 'local_popupaviso'));
$PAGE->set_heading(get_string('editpopup', 'local_popupaviso'));

echo $OUTPUT->header();

$mform = new popupaviso_form();

global $DB;

// Se for edição, carrega os dados existentes e inclui o id oculto
if ($id) {
    $popup = $DB->get_record('local_popupaviso_popups', ['id' => $id], '*', MUST_EXIST);
    // Ajusta o campo editor para o formato esperado
    $popup->mensagem = [
        'text' => $popup->mensagem,
        'format' => FORMAT_HTML
    ];

    $mform->set_data($popup);
}

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/local/popupaviso/admin/manage.php'));
} else if ($data = $mform->get_data()) {
    $record = new stdClass();
    $record->id = $data->id; // campo oculto do form
    $record->name = $data->name;
    $record->mensagem = $data->mensagem['text'];
    $record->url = $data->url;
    $record->video = $data->video;
    $record->cor = $data->cor;
    $record->limite = $data->limite;
    $record->active = $data->active ? 1 : 0;
    $record->timemodified = time();
    $record->targetrole = $data->targetrole;


    if ($record->id) {
        // Atualiza registro existente
        $DB->update_record('local_popupaviso_popups', $record);
    } else {
        // Cria novo registro
        $record->timecreated = time();
        $DB->insert_record('local_popupaviso_popups', $record);
    }

    redirect(new moodle_url('/local/popupaviso/admin/manage.php'), get_string('popupsaved', 'local_popupaviso'));
}

$mform->display();

echo $OUTPUT->footer();