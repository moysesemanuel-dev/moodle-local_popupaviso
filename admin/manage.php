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
 * TODO describe file manage
 *
 * @package    local_popupaviso
 * @copyright  2025 YOUR NAME <
 */

 
// Sempre subir três níveis para alcançar o config.php na raiz do Moodle.
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

require_login();
require_capability('moodle/site:config', context_system::instance());

// Configuração da página administrativa.
$PAGE->set_url(new moodle_url('/local/popupaviso/admin/manage.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('managepopups', 'local_popupaviso'));
$PAGE->set_heading(get_string('managepopups', 'local_popupaviso'));

// Integra com a árvore de administração do Moodle (se você registrar a página no settings.php).
admin_externalpage_setup('local_popupaviso_manage');

echo $OUTPUT->header();

global $DB;

// Busca todos os popups cadastrados.
$popups = $DB->get_records('local_popupaviso_popups');

echo html_writer::tag('h2', get_string('popupslist', 'local_popupaviso'));

// Botão para adicionar novo.
$newurl = new moodle_url('/local/popupaviso/admin/edit.php');
echo $OUTPUT->single_button($newurl, get_string('newpopup', 'local_popupaviso'));

// Verifica se existem registros.
if ($popups) {
    echo html_writer::start_tag('table', ['class' => 'generaltable']);
    echo html_writer::tag('tr',
        html_writer::tag('th', get_string('name', 'local_popupaviso')) .
        html_writer::tag('th', get_string('mensagem', 'local_popupaviso')) .
        html_writer::tag('th', get_string('actions', 'local_popupaviso'))
    );

    foreach ($popups as $popup) {
        $editurl = new moodle_url('/local/popupaviso/admin/edit.php', ['id' => $popup->id]);
        $deleteurl = new moodle_url('/local/popupaviso/admin/delete.php', ['id' => $popup->id]);

        echo html_writer::tag('tr',
            html_writer::tag('td', format_string($popup->name)) .
            html_writer::tag('td', shorten_text(strip_tags($popup->mensagem), 50)) .
            html_writer::tag('td',
                html_writer::link($editurl, get_string('edit')) . ' | ' .
                html_writer::link($deleteurl, get_string('delete'))
            )
        );
    }

    echo html_writer::end_tag('table');
} else {
    echo $OUTPUT->notification(get_string('nopopups', 'local_popupaviso'), 'info');
}

echo $OUTPUT->footer();
