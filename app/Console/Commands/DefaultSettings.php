<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DefaultSettings extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'settings:default';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Set all settings of all users that were not set yet to their default value.';

    private $defaults = [
        'round' => ''
    ];

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        // TODO implement this command
		$this->info("This command is not implemented yet.");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [

		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [

		];
	}

}
