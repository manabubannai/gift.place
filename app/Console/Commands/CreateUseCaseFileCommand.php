<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateUseCaseFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:usecase {subject : 主語 ex) Fan, Artist, Admin} {usecaseName : The name of usecase}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create usecase files including usecase, usecase`s interface';
    private $domain;
    private $usecaseName;
    private $fullName;
    private $usecaseBasePath;
    private $usecaseInterfaceFileName;
    private $usecaseResponseFileName;
    private $usecaseInputFileName;
    private $interactorFileName;

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
        $this->subject      = $this->argument('subject');
        $this->usecaseName  = $this->argument('usecaseName');

        $USE_CASE_PATH = 'packages/'.$this->subject.'/'.$this->usecaseName.'/Usecase/';
        $DOMAIN_PATH   = 'packages/'.$this->subject.'/'.$this->usecaseName.'/Domain/Application/';

        $REPOSITORY_PATH = 'packages/'.$this->subject.'/'.$this->usecaseName.'/Domain/Domain/Repository';
        $ELOQUENT_PATH   = 'packages/'.$this->subject.'/'.$this->usecaseName.'/Infrastructure\Eloquent';

        $VALUEOBJECCT_PATH = 'packages/'.$this->subject.'/'.$this->usecaseName.'/Domain/Domain/ValueObject';

        $this->fullName        = $this->usecaseName;
        $this->usecaseBasePath = $USE_CASE_PATH;

        if (is_null($this->subject) || is_null($this->usecaseName)) {
            $this->error('Name invalid');
        }

        if (!$this->isExistDirectory($USE_CASE_PATH)) {
            $this->createDirectory($USE_CASE_PATH);
        }

        if (!$this->isExistDirectory($DOMAIN_PATH)) {
            $this->createDirectory($DOMAIN_PATH);
        }

        if (!$this->isExistDirectory($REPOSITORY_PATH)) {
            $this->createDirectory($REPOSITORY_PATH);
        }

        if (!$this->isExistDirectory($ELOQUENT_PATH)) {
            $this->createDirectory($ELOQUENT_PATH);
        }

        if (!$this->isExistDirectory($VALUEOBJECCT_PATH)) {
            $this->createDirectory($VALUEOBJECCT_PATH);
        }

        $this->usecaseInterfaceFileName = $this->usecaseBasePath.'/'.$this->fullName.'UseCaseInterface.php';
        // $this->usecaseResponseFileName  = $this->usecaseBasePath.'/'.$this->fullName.'Response.php';
        $this->usecaseInputFileName     = $this->usecaseBasePath.'/'.$this->fullName.'Input.php';

        $this->interactorFileName = $DOMAIN_PATH.'/'.$this->fullName.'Interactor.php';

        if ($this->isExistFiles()) {
            $this->error('already exist');

            return;
        }

        // $this->createUsecaseResponse();
        $this->createUsecaseInterface();
        $this->createInteractorFile();

        $this->info('create successfully');
        $this->line('');
        $this->comment('Add the following route to app/Providers/UseCaseServiceProvider.php:');
        $this->line('');
        $this->info("    \$this->app->bind(
            \\packages\\$this->subject\\$this->usecaseName\\UseCase\\$this->fullName"."UseCaseInterface::class,
            \\packages\\$this->subject\\$this->usecaseName\\Domain\\Application\\$this->fullName".'Interactor::class
        );');
        $this->line('');
    }

    /**
     * Repositoryのfileを作成する.
     *
     * @return void
     */
    private function createInteractorFile(): void
    {
        $usecasePath   = "packages\\$this->subject\\$this->usecaseName\\UseCase\\$this->fullName".'UseCaseInterface';

        $content = "<?php\n\nnamespace packages\\$this->subject\\$this->usecaseName\\Domain\\Application;\n\nuse $usecasePath;\n\nclass $this->fullName"."Interactor implements $this->fullName"."UseCaseInterface\n{\n\t\tpublic function handle() "."\n\t\t{\n\t\t\t"."\n\t\t}\n}\n";
        file_put_contents($this->interactorFileName, $content);
    }

    /**
     * @return void
     */
    private function createUsecaseResponse(): void
    {
        $content = "<?php\n\nnamespace packages\\$this->subject\\$this->usecaseName\\UseCase\\$this->usecaseName;\n\nclass $this->fullName"."Response\n{\n\t\tpublic function __construct(){}\n}\n";
        file_put_contents($this->usecaseResponseFileName, $content);
    }

    /**
     * @return void
     */
    private function createUsecaseInterface(): void
    {
        $content = "<?php\n\nnamespace packages\\$this->subject\\$this->usecaseName\\UseCase;\n\ninterface $this->fullName"."UseCaseInterface\n{\n\t\tpublic function handle(): ".$this->fullName."Response;\n}\n";
        file_put_contents($this->usecaseInterfaceFileName, $content);
    }

    /**
     * 同名fileの確認.
     *
     * @return bool
     */
    private function isExistFiles(): bool
    {
        return file_exists($this->usecaseInterfaceFileName)
            || file_exists($this->usecaseResponseFileName)
            || file_exists($this->interactorFileName);
    }

    /**
     * directoryの存在確認.
     *
     * @return bool
     */
    private function isExistDirectory($path): bool
    {
        return file_exists($path);
    }

    /**
     * 指定名でdirectoryの作成.
     *
     * @return void
     */
    private function createDirectory($path): void
    {
        mkdir($path, 0755, true);
    }
}
