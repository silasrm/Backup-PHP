<?php

    require_once 'BackupInterface.php';
    require_once 'Backup_Salva.php';
    require_once 'Backup_Ler.php';

    /**
     * Classe que gerencia a gravação e leitura dos arquivos de Backup
     *
     * @package Backup
     * @name Backup
     * @version 0.1
     * @author Silas Ribas Martins < silasrm@gmail.com >
     * @example 
     */
    class Backup implements BackupInterface
    {
        protected static $instance;
        protected $classeSalva = null;
        protected $classeLer = null;

        /**
         * Carrega as classe Backup_Salva e Backup_Ler
         */
        public function  __construct()
        {
            $this->classeSalva = new Backup_Salva();
            $this->classeLer = new Backup_Ler();
        }

        public function  __clone()
        {
            trigger_error( 'Clonagem não é permitida.', E_USER_ERROR );
        }

        public static function getInstance()
        {
            if( !( self::$instance instanceof Backup ) )
                self::$instance = new Backup();

            return self::$instance;
        }

        /**
         * Interface para salvar os dados no arquivo criado no destino informado, que pode ser sobescrito ou não caso já exista.
         * @param array $dados
         * @param string $destino
         * @param string $nomeArquivo
         * @param boolean $sobescrever
         * @return boolean
         */
        public function salva( array $dados, $destino, $nomeArquivo, $sobescrever = false )
        {
            return $this->classeSalva->setDestino( $destino )
                                     ->setDados( $dados, $nomeArquivo )
                                     ->salvaArquivo( $sobescrever );
        }

        /**
         * Interface que Ler os dados do arquivo, deserializa e descomprimi e retorna o vetor
         * @param string $arquivo
         * @return array
         */
        public function ler( $arquivo )
        {
            $dados = $this->classeLer->setArquivo( $arquivo )->getDados();
            $this->classeLer->destroi();
            
            return $dados;
        }

        /**
         * Checa se a classe ZipArchive está ativa para ser usada na compactação e extração dos dados em formato zip, apenas um método fácil para compactar pastas
         */
        public function checkZip()
        {
            if( !class_exists( 'ZipArchive' ) )
                throw new Exception( 'ZipArchive não disponível.' );
        }

        /**
         * Varre a pasta e cria o arquivo em formato zip com o conteudo da pasta
         * @param string $pasta
         * @param string $arquivo
         */
        public function zipa( $pasta, $arquivo )
        {
            $this->checkZip();

            $zip = new ZipArchive();

            if( $zip->open( $arquivo, ZIPARCHIVE::CREATE ) !== TRUE )
                throw new Exception( "Não foi possível criar/abrir o arquivo: " . $arquivo );

            $arquivos = scandir( $pasta, 1 );

            unset( $arquivos[ count($arquivos) - 1 ] ); // remove a posição de valor '.'
            unset( $arquivos[ count($arquivos) - 1 ] ); // remove a posição de valor '..'
            
            foreach( $arquivos as $arquivo )
            {
                $zip->addFile( $pasta . $arquivo, $arquivo );
            }
            
            if( $zip->numFiles <> count($arquivos) )
                throw new Exception( 'Houve problema, nem todos os arquivos foram adicionados ao arquivo zipado.' );

            if( $zip->status != 0 )
                throw new Exception( 'Houve um problema com o arquivo zipado. O status acusa: ' . $zip->status );
            
            $zip->close();
        }

        /**
         * Descompacta o arquivo no destino
         * @param string $arquivo
         * @param string $destino
         * @return boolean
         */
        public function dezipa( $arquivo, $destino )
        {
            $this->checkZip();
            
            $zip = new ZipArchive();

            if( $zip->open( $arquivo ) !== TRUE )
                throw new Exception( "Não foi possível abrir o arquivo: " . $arquivo );

            if( !is_writable( $destino ) )
                throw new Exception( 'Não tem permissão para descompactar na pasta de destino. Pasta: ' . $destino );

            $zip->extractTo( $destino );
            $zip->close();

            return true;
        }
    }

?>
