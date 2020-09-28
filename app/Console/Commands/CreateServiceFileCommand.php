<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * https://qiita.com/hironeko/items/1a2df88f7857d02a38a1
 * CreateServiceFileCommand class.
 */
class CreateServiceFileCommand extends Command
{
    /**
     * @const string Service dir path
     */
    const SERVICES_PATH = 'app/Services/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {serviceName : The name of service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Service files';

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $dirName;

    /**
     * @var string
     */
    private $ServiceFileName;

    /**
     * @var string
     */
    private $interfaceFileName;

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
    public function handle()
    {
        $this->fileName = $this->argument('serviceName');
        $this->dirName  = $this->fileName;

        if (is_null($this->fileName)) {
            $this->error('Service Name invalid');
        }
        // $this->dirName = $this->ask('new directory name. or use directory name');

        if (is_null($this->dirName)) {
            $this->error('Directory required!');
        }

        if (!$this->isExistDirectory()) {
            $this->createDirectory();
        }

        $this->ServiceFileName   = self::SERVICES_PATH.$this->dirName.'/'.$this->fileName.'Service.php';
        $this->interfaceFileName = self::SERVICES_PATH.$this->dirName.'/'.$this->fileName.'ServiceInterface.php';
        if ($this->isExistFiles()) {
            $this->error('already exist');

            return;
        }

        $this->creatServiceFile();
        $this->createInterFaceFile();
        $this->info('create successfully');
        $this->line('');
        $this->comment('Add the following route to app/Providers/ServiceServiceProvider.php:');
        $this->line('');
        $this->info("    \$this->app->bind(
            \\App\\Services\\$this->dirName\\$this->dirName"."ServiceInterface::class,
            \\App\\Services\\$this->dirName\\$this->dirName".'Service::class
        );');
        $this->line('');
    }

    /**
     * Serviceのfileを作成する.
     *
     * @return void
     */
    private function creatServiceFile(): void
    {
        $content = "<?php\n\nnamespace App\\Services\\$this->dirName;\n\nclass $this->fileName"."Service implements $this->fileName"."ServiceInterface\n{\n}\n";
        file_put_contents($this->ServiceFileName, $content);
    }

    /**
     * Interfaceのfileを作成する.
     *
     * @return void
     */
    private function createInterFaceFile(): void
    {
        $content = "<?php\n\nnamespace App\\Services\\$this->dirName;\n\ninterface $this->fileName"."ServiceInterface\n{\n}\n";
        file_put_contents($this->interfaceFileName, $content);
    }

    /**
     * 同名fileの確認.
     *
     * @return bool
     */
    private function isExistFiles(): bool
    {
        return file_exists($this->ServiceFileName) && file_exists($this->interfaceFileName);
    }

    /**
     * directoryの存在確認.
     *
     * @return bool
     */
    private function isExistDirectory(): bool
    {
        return file_exists(self::SERVICES_PATH.$this->dirName);
    }

    /**
     * 指定名でdirectoryの作成.
     *
     * @return void
     */
    private function createDirectory(): void
    {
        mkdir(self::SERVICES_PATH.$this->dirName, 0755, true);
    }
}
