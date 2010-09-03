<?php

    set_include_path( APP . 'vendors' . PATH_SEPARATOR . get_include_path() );

    App::import( 'Vendor', 'Backup', array( 'file' => 'backup/Backup.php' ) );

    class BackupComponent extends Object
    {
        public $name = 'Backup';
        protected $backup;
        
        public function initialize( $controller )
        {
            $this->backup = Backup::getInstance();
        }

        public function salva( array $dados, $destino, $nomeArquivo, $sobescrever = false )
        {
            return $this->backup->salva( $dados, $destino, $nomeArquivo, $sobescrever );
        }

        public function ler( $arquivo )
        {
            return $this->backup->ler( $arquivo );
        }

        public function zipa( $pasta, $arquivo )
        {
            return $this->backup->zipa( $pasta, $arquivo );
        }

        public function dezipa( $arquivo, $destino )
        {
            return $this->backup->dezipa( $arquivo, $destino );
        }
    }
?>