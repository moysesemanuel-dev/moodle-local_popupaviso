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
 * TODO describe file forms
 *
 * @package    local_popupaviso
 * @copyright  2025 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
global $CFG;
require_once($CFG->libdir . '/formslib.php');

class popupaviso_form extends moodleform {
    public function definition() {
        $mform = $this->_form;

        // Campo oculto para o ID (usado na edição)
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        // Campo Nome
        $mform->addElement('text', 'name', get_string('name', 'local_popupaviso'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        // Campo Mensagem
        $mform->addElement('editor', 'mensagem', get_string('mensagem', 'local_popupaviso'), null, ['rows' => 10]);
        $mform->setType('mensagem', PARAM_RAW);

        // Campo URL
        $mform->addElement('text', 'url', get_string('url', 'local_popupaviso'));
        $mform->setType('url', PARAM_URL);

        // Campo Vídeo
        $mform->addElement('text', 'video', get_string('video', 'local_popupaviso'));
        $mform->setType('video', PARAM_TEXT);

        // Campo Cor
        $mform->addElement('text', 'cor', get_string('cor', 'local_popupaviso'));
        $mform->setType('cor', PARAM_TEXT);
        $mform->setDefault('cor', '#f8d7da');

        // Campo Limite
        $mform->addElement('text', 'limite', get_string('limite', 'local_popupaviso'));
        $mform->setType('limite', PARAM_INT);
        $mform->setDefault('limite', 1);

        // Campo Ativo
        $mform->addElement('advcheckbox', 'active', get_string('active', 'local_popupaviso'));
        $mform->setType('active', PARAM_INT);
        $mform->setDefault('active', 1);

        // Seletor de funções
        $roles = [
        'student' => get_string('role_student', 'local_popupaviso'),
        'teacher' => get_string('role_teacher',     'local_popupaviso'),
        'manager' => get_string('role_manager', 'local_popupaviso')
];
        $mform->addElement('select', 'targetrole', get_string('targetrole', 'local_popupaviso'), $roles);
        $mform->setDefault('targetrole', 'student');


        $this->add_action_buttons();
    }
}