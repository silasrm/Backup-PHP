<?php

    /*
        Teste da Classe Backup. Usa PHPUnit
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
require_once '../BackupInterface.php';
require_once '../Backup.php';
require_once '../Backup_Ler.php';
require_once '../Backup_Salva.php';

class BackupTest extends PHPUnit_Framework_TestCase
{
    protected $classBackup;
    protected $_data = array(
                                'PRODUCT' => null
                                , 'PROVIDERS' => null
                                , 'SECTOR' => null
                                , 'TURNOVERS' => null
                            );

    protected function setUp()
    {
        $this->_data['PRODUCT'] = unserialize( file_get_contents( PATH_DADOS . 'products.reg' ) );
        $this->_data['PROVIDERS'] = unserialize( file_get_contents( PATH_DADOS . 'providers.reg' ) );
        $this->_data['SECTOR'] = unserialize( file_get_contents( PATH_DADOS . 'sector.reg' ) );
        $this->_data['TURNOVERS'] = unserialize( file_get_contents( PATH_DADOS . 'turnovers.reg' ) );
    }

    /**
     * Testa o Salvamento do Backup
     */
    public function testSalvaBackup()
    {
        $bkp = Backup::getInstance();
        $this->assertTrue( $bkp->salva( $this->_data['PRODUCT'], './bkp/', 'product_bkp', true ) );
    }

    /**
     * Ler o arquivo de Backup
     */
    public function testLerBackup()
    {
        $bkp = Backup::getInstance();
        $this->assertType( PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $bkp->ler( './bkp/product_bkp' ) );
    }
}
