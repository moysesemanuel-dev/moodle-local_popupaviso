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

namespace local_popupaviso;

defined('MOODLE_INTERNAL') || die();

/**
 * Class util
 *
 * @package    local_popupaviso
 * @copyright  2025 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class util {
    /**
     * Renderiza um popup específico.
     */
    public static function render_popup($popup) {
        $mensagemhtml = format_text($popup->mensagem, FORMAT_HTML);
        $cor = (!empty($popup->cor)) ? $popup->cor : '#f8d7da';

        // Vídeo do YouTube
        $videoframe = '';
        if (!empty($popup->video)) {
            if (preg_match('/(?:v=|be\/)([a-zA-Z0-9_-]{6,})/i', $popup->video, $matches)) {
                $videoid = $matches[1];
                $videoframe = "
                    <div style='position: relative; width: 100%; padding-bottom: 56.25%; height: 0;'>
                        <iframe
                            src='https://www.youtube.com/embed/{$videoid}'
                            style='position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;'
                            allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                            referrerpolicy='strict-origin-when-cross-origin'
                            allowfullscreen>
                        </iframe>
                    </div>
                ";
            }
        }

        $limite = is_numeric($popup->limite) ? (int)$popup->limite : 0;
        $popupid = (int)$popup->id;
        $containerid = "popup-aviso-{$popupid}";
        $closeid = "fechar-popup-{$popupid}";
        $sessionkey = "popupaviso_contador_{$popupid}";

        echo "
            <style>
                #{$containerid} {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: {$cor};
                    color: #000;
                    border: 1px solid #c2c2c2;
                    padding: 15px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    z-index: 9999;
                    max-width: 90vw;
                    max-height: 90vh;
                    width: fit-content;
                    height: fit-content;
                    overflow: auto;
                    display: none;
                }
                #{$containerid} .popup-content {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }
                #{$containerid} button {
                    background-color: #3546ff;
                    color: white;
                    border: none;
                    padding: 8px 12px;
                    border-radius: 5px;
                    cursor: pointer;
                    align-self: flex-end;
                }
            </style>

            <div id='{$containerid}'>
                <div class='popup-content'>
                    <div>{$mensagemhtml}</div>
                    {$videoframe}
                    <button id='{$closeid}'>" . get_string('close', 'local_popupaviso') . "</button>
                </div>
            </div>

            <script>
                (function() {
                    var limite = {$limite};
                    var chave = '{$sessionkey}';
                    var contador = parseInt(sessionStorage.getItem(chave)) || 0;
                    var popup = document.getElementById('{$containerid}');
                    var fechar = document.getElementById('{$closeid}');

                    if (limite === 0 || contador < limite) {
                        popup.style.display = 'block';
                        fechar.addEventListener('click', function () {
                            popup.style.display = 'none';
                            contador++;
                            sessionStorage.setItem(chave, contador);
                        });
                    }
                })();
            </script>
        ";
    }
}

