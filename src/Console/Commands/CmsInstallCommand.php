<?php

namespace Cms\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageServiceProviderLaravel5;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Cms\CmsProvider;

class CmsInstallCommand extends Command
{
    protected $userModelFile = 'Models/User.php';
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Cms Admin package';

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
            // ['with-dummy', null, InputOption::VALUE_NONE, 'Install with dummy data', null],
        ];
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {

        $this->info('Attempting to set Cms User model as parent to Cms\Models\User');
        if (file_exists(app_path($this->userModelFile))) {
            $str = file_get_contents(app_path($this->userModelFile));

            if ($str !== false) {
                $str = str_replace('extends Authenticatable', "extends \Cms\Models\User", $str);
                $str = str_replace('extends \Facilitador\Models\User', "extends \Cms\Models\User", $str);

                file_put_contents(app_path($this->userModelFile), $str);
            }
        } else {
            $this->warn('Unable to locate "app/Models/User.php".  Did you move this file?');
            $this->warn('You will need to update this manually.  Change "extends Authenticatable" to "extends \Cms\Models\User" in your User model');
        }

        $this->info('Successfully installed Cms! Enjoy');
    }
}