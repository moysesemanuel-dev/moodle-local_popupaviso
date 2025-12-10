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
 * TODO describe file hook_callbacks
 *
 * @package    local_popupaviso
 * @copyright  2025 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 namespace local_popupaviso;

defined('MOODLE_INTERNAL') || die();

class hook_callbacks {
    /**
     * Hook chamado antes do rodapé da página.
     */
    public static function before_footer() {
        global $PAGE, $USER, $DB;

        // Busca todos os popups ativos
        $popups = $DB->get_records('local_popupaviso_popups', ['active' => 1]);
        if (!$popups) {
            return;
        }

        // Papéis do usuário
        $context = \context_system::instance();
        $roles = get_user_roles($context, $USER->id);
        if (!$roles) {
            return;
        }
        $usershortroles = array_map(function($r) { return $r->shortname; }, $roles);

        $currenturl = $PAGE->url->out(false);

        foreach ($popups as $popup) {
            // Filtro por URL
            $urlmatch = true;
            if (!empty($popup->url)) {
                $targeturl = trim($popup->url);
                $urlmatch = ($currenturl === $targeturl) || (strpos($currenturl, $targeturl) === 0);
            }
            if (!$urlmatch) {
                continue;
            }

            // Filtro por roles
            $targetroles = [];
            if (!empty($popup->targetrole)) {
                $targetroles = array_filter(array_map('trim', explode(',', $popup->targetrole)));
            }
            if (empty($targetroles)) {
                continue;
            }

            $roleallowed = count(array_intersect($usershortroles, $targetroles)) > 0;
            if (!$roleallowed) {
                continue;
            }

            // Renderiza popup
            util::render_popup($popup);
        }
    }
}