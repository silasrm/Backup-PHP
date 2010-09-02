<?php

    /**
     * Classe que salva os dados no arquivo em formato serializado e comprimido
     *
     * @package Backup
     * @name Backup_Salva
     * @version 0.1
     * @author Silas Ribas Martins < silasrm@gmail.com >
     * @example $x = new Backup_Salva( 'pasta/onde/sera/salvo/o/arquivo', $vetorDados ); $x->setNomeArquivo( 'secao_bkp' )->salvaArquivo();
     */
    class Backup_Salva
    {
        /**
         * Dados serializados e comprimidos
         * @var string
         */
        protected $dados = null;
        /**
         * Nome do arquivo onde será salvo os dados
         * @var string
         */
        protected $nomeArquivo = null;
        /**
         * Caminho da pasta onde será gravado o arquivo com os dados
         * @var string
         */
        protected $destino = null;

        /**
         * Construtor podendo passar o destino e os dados na inicialização ou não
         * @param string|null $destino
         * @param array $dados
         * @return Backup_Salva 
         */
        public function __construct( $destino = null, array $dados = array() )
        {
            if( !empty( $destino ) )
                $this->setDestino( $destino );

            if( !empty( $dados ) )
                $this->setDados( $dados );

            return $this;
        }

        /**
         * Seta o destino, que é o caminho da pasta onde será criado o arquivo de Backup
         * @param string $destino
         * @return Backup_Salva
         */
        public function setDestino( $destino )
        {
            if( is_string( $destino ) && !is_dir( $destino ) )
                throw new InvalidArgumentException ( 'Esse destino não existe.' );

            if( is_null( $destino ) )
                throw new InvalidArgumentException ( 'Destino do arquivo não informado ou inválido.' );
            
            if( !is_writable( $destino ) )
                throw new Exception( 'Destino não tem permissão para escrita. Destino: ' . $destino );

            $this->destino = $destino;

            return $this;
        }

        /**
         * Retorna o destino, que é o caminho da pasta onde será criado o arquivo de Backup
         * @return string
         */
        public function getDestino()
        {
            return $this->destino;
        }

        /**
         * Seta o vetor com os dados a serem feito Backup, podendo passar o nome do arquivo a ser criado que conterá os dados
         * @param array $dados
         * @param string|null $nomeArquivo
         * @return Backup_Salva
         */
        public function setDados( array $dados, $nomeArquivo = null )
        {
            if( is_array( $dados ) && empty( $dados ) )
                throw new InvalidArgumentException( 'Formata dos dados incorreto. Não pode ser um (array) vazio' );

            $this->dados = gzcompress( serialize( $dados ) );
            $this->setNomeArquivo( $nomeArquivo );

            return $this;
        }

        /**
         * Seta o nome do arquivo a ser criado que conterá os dados do Backup
         * @param string $nomeArquivo
         * @return Backup_Salva
         */
        public function setNomeArquivo( $nomeArquivo )
        {
            $nomeArquivo = str_replace( array( ' ', ',', '.', '?', 'ç', 'Ç'
                                                , 'ã', 'Ã', 'ä', 'Ä', 'á', 'Á', 'à', 'À', 'â', 'Â'
                                                , 'ẽ', 'Ẽ', 'ë', 'Ë', 'é', 'É', 'è', 'È', 'ê', 'Ê'
                                                , 'ĩ', 'Ĩ', 'ï', 'Ï', 'í', 'Í', 'ì', 'Ì', 'î', 'Î'
                                                , 'õ', 'Õ', 'ö', 'Ö', 'ó', 'Ó', 'ò', 'Ò', 'ô', 'Ô'
                                                , 'ũ', 'Ũ', 'ü', 'Ü', 'ú', 'Ú', 'ù', 'Ù', 'û', 'Û' ), '_', $nomeArquivo );

            $this->nomeArquivo = strtolower( $nomeArquivo );

            return $this;
        }

        /**
         * Retorna o nome do arquivo que será criado com os dados do Backup
         * @return string
         */
        public function getNomeArquivo()
        {
            return $this->nomeArquivo;
        }

        /**
         * Faz as verificações e cria e grava os dados no arquivo informado no destino informado
         * @return boolean
         */
        public function salvaArquivo( $sobescrever = false )
        {
            if( is_null( $this->dados ) )
                throw new Exception( 'Sem dados para salvar.' );

            if( strlen( $this->getNomeArquivo() ) == 0 )
                throw new Exception( 'Nome do Arquivo não informado.' );

            if( is_null( $this->destino ) )
                throw new InvalidArgumentException ( 'Destino do arquivo não informado ou inválido.' );

            if( !is_writable( $this->destino ) )
                throw new Exception( 'Destino não tem permissão para escrita. Destino: ' . $this->destino );

            if( $sobescrever === false )
                if( file_exists( $this->destino . $this->getNomeArquivo() ) )
                    throw new Exception( 'Arquivo já existe.' );

            if( file_put_contents( $this->getDestino() . $this->getNomeArquivo() , $this->dados ) === false )
                throw new LengthException( 'Erro ao Salvar o arquivo ' . $this->getNomeArquivo() . ' em ' . $this->getDestino() );

            return true;
        }
    }

?>