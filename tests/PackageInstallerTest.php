<?php 

use Benepfist\ArtisanUtility\PackageInstaller;
use Mockery as m;

class PackageInstallerTest extends PHPUnit_Framework_TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function testCanUpdateConfig()
    {
        $file = m::mock('Illuminate\Filesystem\Filesystem')->makePartial();
        $config = m::mock('Illuminate\Config\Repository');

        $file->shouldReceive('put')
             ->with(app_path().'/config/app.php', app_path().'/config/app.php')
             ->once();

        $file->shouldReceive('get')
             ->with(DIR.'/config/app.php')
             ->andReturn();

        $config->shouldReceive('get')->with('app.providers')->andReturn(array('Illuminate\\Auth\\AuthServiceProvider'));

        $config->shouldReceive('get')->with('app.aliases')->andReturn(array('App' => 'Illuminate\\Support\\Facades\\App'));

        $installer = new PackageInstaller($file, $config);

        $providers = array('Demopackage\Demo\DemoServiceProvider');
        $aliases = array('Demo => Demopackage\Facade\Demo');

        //$installer->updateConfigurations($providers, $aliases);



    }

}

?>