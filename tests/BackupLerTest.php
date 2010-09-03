<?php

    /*
        Teste da Classe Backup_Ler. Usa PHPUnit
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

define( 'PATH_DADOS', realpath( '' ) . '/./data/' );

require_once 'PHPUnit/Framework.php';
require_once '../Backup_Ler.php';

class BackupLerTest extends PHPUnit_Framework_TestCase
{
    protected $classBackup;
    
    protected function setUp()
    {
        $this->classBackup = new Backup_Ler();
    }

    /**
     * Testa ao setar o caminho do arquivo a ter os dados recuperados
     */
    public function testSetArquivo()
    {
        $this->assertTrue( $this->classBackup->setArquivo( PATH_DADOS . 'se__es_bkp' ) );
    }

    /**
     * Testa se o caminho não é null
     */
    public function testGetArquivo()
    {
        $this->assertNull( $this->classBackup->getArquivo() );
    }

    /**
     * Testa se está retornando um array
     */
    public function testGetDados()
    {
        $this->classBackup->setArquivo( PATH_DADOS . 'se__es_bkp' );
        $this->assertType( PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $this->classBackup->getDados() );
    }
}
