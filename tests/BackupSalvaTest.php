<?php

define( 'PATH_DADOS', realpath( '' ) . '/./data/' );

require_once 'PHPUnit/Framework.php';
require_once '../Backup_Salva.php';

class BackupSalvaTest extends PHPUnit_Framework_TestCase
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
        $this->classBackup = new Backup_Salva();

        $this->_data['PRODUCT'] = unserialize( file_get_contents( PATH_DADOS . 'products.reg' ) );
        $this->_data['PROVIDERS'] = unserialize( file_get_contents( PATH_DADOS . 'providers.reg' ) );
        $this->_data['SECTOR'] = unserialize( file_get_contents( PATH_DADOS . 'sector.reg' ) );
        $this->_data['TURNOVERS'] = unserialize( file_get_contents( PATH_DADOS . 'turnovers.reg' ) );
    }

    /**
     * Teste casual, só pra saber se os dados foram carregados
     */
    public function testDataProductIsNull()
    {
        $this->assertNull( $this->_data['PRODUCT'] );
    }

    /**
     * Teste casual, só pra saber se os dados foram carregados
     */
    public function testDataProviderIsNull()
    {
        $this->assertNull( $this->_data['PROVIDERS'] );
    }

    /**
     * Teste casual, só pra saber se os dados foram carregados
     */
    public function testDataSectorIsNull()
    {
        $this->assertNull( $this->_data['SECTOR'] );
    }

    /**
     * Teste casual, só pra saber se os dados foram carregados
     */
    public function testDataTurnoverIsNull()
    {
        $this->assertNull( $this->_data['TURNOVERS'] );
    }

    /**
     * Teste casual, só pra saber se os dados é um array
     */
    public function testProductIsArray()
    {
        $this->assertType( PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $this->_data['PRODUCT'] );
    }

    /**
     * Teste casual, só pra saber se os dados é um array
     */
    public function testProviderIsArray()
    {
        $this->assertType( PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $this->_data['PROVIDERS'] );
    }

    /**
     * Teste casual, só pra saber se os dados é um array
     */
    public function testSectorIsArray()
    {
        $this->assertType( PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $this->_data['SECTOR'] );
    }

    /**
     * Teste casual, só pra saber se os dados é um array
     */
    public function testTurnovertIsArray()
    {
        $this->assertType( PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $this->_data['TURNOVERS'] );
    }

    /**
     * Testa se gera o nome correto
     */
    public function testGeraNomeArquivo()
    {
        $this->classBackup->setDados( $this->_data['SECTOR'] )
                          ->setNomeArquivo( 'sector_bkp çãê' );
        
        $this->assertNull( $this->classBackup->getNomeArquivo() );
    }

    /**
     * Testa se os dados foram salvos
     */
    public function testSalvaDados()
    {
        $this->classBackup->setDados( $this->_data['SECTOR'] )
                          ->setDestino( './data/' )
                          ->setNomeArquivo( 'seções_bkp' );
        
        $this->assertTrue( $this->classBackup->salvaArquivo() );
    }
}
