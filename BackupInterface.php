<?php

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