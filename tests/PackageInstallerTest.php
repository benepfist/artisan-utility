<?php namespace Benepfist\ArtisanUtility;

use Benepfist\ArtisanUtility\PackageInstaller;
use Mockery as m;

function app_path(){
   return '../../../app/'; 
}

class PackageInstallerTest extends \PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function testCanUpdateConfig()
    {
        $file = m::mock('Illuminate\Filesystem\Filesystem')->makePartial();
        $config = m::mock('Illuminate\Config\Repository');

        $file->shouldReceive('put')
             ->once()
             ->andReturn(true);

        $file->shouldReceive('get')
             ->once()
             ->andReturn(
                    file_get_contents(__DIR__.'/stubs/app_old.php')
                );

        $config->shouldReceive('get')
               ->with('app.providers')
               ->andReturn(
                    array('Illuminate\\Auth\\AuthServiceProvider')
                );

        $config->shouldReceive('get')
               ->with('app.aliases')
               ->andReturn(
                    array('App' => 'Illuminate\\Support\\Facades\\App')
                );

        $installer = new PackageInstaller($file, $config);

        $providers = array('Demopackage\Demo\DemoServiceProvider');
        $aliases = array('Demo => Demopackage\Facade\Demo');

        $installer->updateConfigurations($providers, $aliases);

        $this->assertEquals($installer->getContents(), file_get_contents(__DIR__.'/stubs/app_new.php'));


    }

}

?>