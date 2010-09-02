<?php

    /**
     * Classe que salva os dados no arquivo em formato serializado e comprimido
     *
     * @package Backup
     * @name Backup_Ler
     * @version 0.1
     * @author Silas Ribas Martins < silasrm@gmail.com >
     * @example $x = new Backup_Ler( 'pasta/onde/esta/salvo/o/arquivo_bkp' ); $x->getDados();
     */
    class Backup_Ler
    {
        /**
         * Onde será atribuido os dados recuperados do arquivo
         * @var array
         */
        protected $dados = array();
        /**
         * Caminho do arquivo onde está os dados a ser recuperado
         * @var string
         */
        protected $arquivo = null;

        /**
         * Construtor podendo passar o nome do arquivo a ser recuperado os dados
         * @param string|null $arquivo
         * @return Backup_Ler
         */
        public function __construct( $arquivo = null )
        {
            if( !empty( $arquivo ) )
                $this->setArquivo( $arquivo );
            
            return $this;
        }

        /**
         * Seta array vazio para $dados e null para arquivo, para corrigir problema de cache de informações carregadas
         */
        public function destroi()
        {
            $this->dados = array();
            $this->arquivo = null;
        }

        /**
         * Caminho do arquvios onde está os dados a serem recuperados
         * @param string $arquivo
         * @return Backup_Ler
         */
        public function setArquivo( $arquivo )
        {
            if( !file_exists( $arquivo ) )
                throw new InvalidArgumentException ( 'Arquivo não existe.' );

            $this->arquivo = $arquivo;

            return $this;
        }

        /**
         * Retorna o caminho do arquivo
         * @return string
         */
        public function getArquivo()
        {
            return $this->arquivo;
        }

        /**
         * Retorna os dados descomprimidos e deserealizados
         * @return array
         */
        public function getDados()
        {
            if( strlen( $this->getArquivo() ) == 0 )
                throw new Exception( 'Arquivo não informado.' );

            if( !file_exists( $this->getArquivo() ) )
                throw new Exception( 'Arquivo não existe.' );

            if( empty( $this->dados ) )
                $this->dados = unserialize( gzuncompress( file_get_contents( $this->getArquivo() ) ) );

            return $this->dados;
        }
    }

?>