<?php

    /*
        Interface Backup. Interface para a classe que gerencia a gravação e leitura dos arquivos de Backup.
        Copyright (C) 2010  Silas Ribas Martins and Hugo Henrique

        This program is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */

    /**
     * Interface para a classe que gerencia a gravação e leitura dos arquivos de Backup
     *
     * @package Backup
     * @name BackupInterface
     * @version 0.1
     * @author Silas Ribas Martins < silasrm@gmail.com >
     */
    interface BackupInterface
    {
        /**
         * Salva o arquivo com os dados no destino informado
         * @param array $dados
         * @param string $destino
         * @param string $arquivo
         */
        public function salva( array $dados, $destino, $nomeArquivo, $sobescrever = false );
        /**
         * Ler o arquivo informado
         * @param string $arquivo
         */
        public function ler( $arquivo );
    }

?>
