<?php namespace Benepfist\ArtisanUtility;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ArtisanUtilityCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'laravel:add';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Adds a ServiceProvider or Alias to the app.php config file.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(PackageInstaller $installer)
	{
		parent::__construct();

		$this->installer = $installer;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$providers = $this->option('provider');
		$aliases = $this->option('alias');

		$this->installer->updateConfigurations($providers, $aliases);
		$this->showMessage('Providers', $providers);
		$this->showMessage('Aliases', $aliases);

	}

	/**
	 * prints succes message
	 *
	 * @param array $items
	 * 
	 */
	protected function showMessage($key, array $items = array())
	{
		if(count($items)){
			$this->info($key);
			foreach($items as $item){
				$this->info($item);
			}
			$this->info('has been added to app.php');
		}

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
			array('alias', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'add to require-dev', null),
			array('provider', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'add to require-dev', null),			
		);
    }	

}
