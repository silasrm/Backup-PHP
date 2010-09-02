<?php

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
