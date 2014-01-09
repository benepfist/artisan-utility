<?php 

use Benepfist\ArtisanUtility\ArtisanUtilityCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Mockery as m;

class ArtisanUtilityCommandTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function testAddServiceProvider()
    {
        $installer = m::mock('Benepfist\ArtisanUtility\PackageInstaller');
        $installer->shouldReceive('updateConfigurations')
            ->once()
            ->andReturn(true);

        $command = new ArtisanUtilityCommand($installer);

        $tester = new CommandTester($command);
        $tester->execute(
                array('--provider' => array('Demopackage\Demo\DemoServiceProvider'))      
            );

        $this->assertEquals("Providers" . PHP_EOL . "Demopackage\Demo\DemoServiceProvider" . PHP_EOL . "has been added to app.php". PHP_EOL, $tester->getDisplay());
    }

    public function testAddAlias()
    {
        $installer = m::mock('Benepfist\ArtisanUtility\PackageInstaller');
        $installer->shouldReceive('updateConfigurations')
        	->once()
        	->andReturn(true);

        $command = new ArtisanUtilityCommand($installer);

        $tester = new CommandTester($command);
        $tester->execute(
                array('--alias' => array('Demo, Demopackage\Facade\Demo'))
            );

        $this->assertEquals("Aliases" . PHP_EOL . "Demo, Demopackage\Facade\Demo" . PHP_EOL . "has been added to app.php" . PHP_EOL, $tester->getDisplay());
    }

    public function testNoWritePermission(){
        $installer = m::mock('Benepfist\ArtisanUtility\PackageInstaller');
        $installer->shouldReceive('updateConfigurations')
            ->once()
            ->andReturn(false);

        $command = new ArtisanUtilityCommand($installer);

        $tester = new CommandTester($command);
        $tester->execute(
                array('--alias' => array('Demo, Demopackage\Facade\Demo'))
            );

        $this->assertEquals("unable to update app.php" . PHP_EOL, $tester->getDisplay());
    }

}

 ?>