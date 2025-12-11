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
 * Biblioteca de funções e definições do plugin local_popupaviso.
 *
 * @package    local_popupaviso
 * @copyright  2025 Created by Moyses Costa<
 */

 
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    // Cria uma categoria "Popup de Aviso" no menu de plugins locais.
    $ADMIN->add('localplugins', new admin_category(
        'local_popupaviso_category',
        get_string('pluginname', 'local_popupaviso')
    ));

    // Cria uma página externa de gerenciamento dentro da categoria.
    $ADMIN->add('local_popupaviso_category', new admin_externalpage(
        'local_popupaviso_manage',
        get_string('managepopups', 'local_popupaviso'),
        new moodle_url('/local/popupaviso/admin/manage.php'),
        'moodle/site:config' // capability necessária
    ));
}
/**
 * Biblioteca de funções e definições do plugin local_popupaviso.
 *
 * @package    local_popupaviso
 * @copyright  2025 Created by Moyses Costa<
 * // --- IGNORE --->
 */