<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * https://qiita.com/hironeko/items/1a2df88f7857d02a38a1
 * CreateRepositoryFileCommand class.
 */
class CreateRepositoryFileCommand extends Command
{
    /**
     * @const string repository dir path
     */
    const REPOSITORIES_PATH = 'app/Repositories/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {repositoryName : The name of repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create repository files';

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
    private $repositoryFileName;

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
        $this->fileName = $this->argument('repositoryName');
        $this->dirName  = $this->fileName;

        if (is_null($this->fileName)) {
            $this->error('Repository Name invalid');
        }
        // $this->dirName = $this->ask('new directory name. or use directory name');

        if (is_null($this->dirName)) {
            $this->error('Directory required!');
        }

        if (!$this->isExistDirectory()) {
            $this->createDirectory();
        }

        $this->repositoryFileName = self::REPOSITORIES_PATH.$this->dirName.'/'.$this->fileName.'Repository.php';
        $this->interfaceFileName  = self::REPOSITORIES_PATH.$this->dirName.'/'.$this->fileName.'RepositoryInterface.php';
        if ($this->isExistFiles()) {
            $this->error('already exist');

            return;
        }

        $this->createRepositoryFile();
        $this->createInterFaceFile();
        $this->info('create successfully');
        $this->line('');
        $this->comment('Add the following route to app/Providers/RepositoryServiceProvider.php:');
        $this->line('');
        $this->info("    \$this->app->bind(
            \\App\\Repositories\\$this->dirName\\$this->dirName"."RepositoryInterface::class,
            \\App\\Repositories\\$this->dirName\\$this->dirName".'Repository::class
        );');
        $this->line('');
    }

    /**
     * Repositoryのfileを作成する.
     *
     * @return void
     */
    private function createRepositoryFile(): void
    {
        $content = "<?php\n\nnamespace App\\Repositories\\$this->dirName;\n\nUse App\\Models\\$this->dirName;\nuse App\Repositories\Base\BaseRepository;\n\nclass $this->fileName"."Repository extends BaseRepository implements $this->fileName"."RepositoryInterface\n{\n\t\tpublic function getBlankModel()\n\t\t{\n\t\t\treturn new $this->fileName();\n\t\t}\n}\n";
        file_put_contents($this->repositoryFileName, $content);
    }

    /**
     * Interfaceのfileを作成する.
     *
     * @return void
     */
    private function createInterFaceFile(): void
    {
        $content = "<?php\n\nnamespace App\\Repositories\\$this->dirName;\n\nuse App\Repositories\Base\BaseRepositoryInterface;\n\ninterface $this->fileName"."RepositoryInterface extends BaseRepositoryInterface\n{\n\t\tpublic function getBlankModel();\n}\n";
        file_put_contents($this->interfaceFileName, $content);
    }

    /**
     * 同名fileの確認.
     *
     * @return bool
     */
    private function isExistFiles(): bool
    {
        return file_exists($this->repositoryFileName) && file_exists($this->interfaceFileName);
    }

    /**
     * directoryの存在確認.
     *
     * @return bool
     */
    private function isExistDirectory(): bool
    {
        return file_exists(self::REPOSITORIES_PATH.$this->dirName);
    }

    /**
     * 指定名でdirectoryの作成.
     *
     * @return void
     */
    private function createDirectory(): void
    {
        mkdir(self::REPOSITORIES_PATH.$this->dirName, 0755, true);
    }
}
