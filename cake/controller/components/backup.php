<?php

    /*
        Classe BackupComponent. Classe que cria um component para CakePHP que integra o Backup-PHP com o CakePHP,
        ficando disponível para ser usado nos controllers.
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
