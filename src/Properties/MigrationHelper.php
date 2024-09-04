<?php

declare(strict_types=1);

namespace Larastan\Larastan\Properties;

use Larastan\Larastan\Internal\FileHelper;
use PHPStan\Parser\Parser;
use PHPStan\Parser\ParserErrorsException;
use SplFileInfo;

use function count;
use function database_path;
use function uasort;

class MigrationHelper
{
    public function __construct(
        private Parser $parser,
        /** @var string[] */
        private array $databaseMigrationPath,
        private FileHelper $fileHelper,
        private bool $disableMigrationScan,
    ) {
    }

    public function parseMigrations(ModelDatabaseHelper &$modelDatabaseHelper): void
    {
        if ($this->disableMigrationScan) {
            return;
        }

        if (count($this->databaseMigrationPath) === 0) {
            $this->databaseMigrationPath = [database_path('migrations')];
        }

        $schemaAggregator = new SchemaAggregator($modelDatabaseHelper);
        $filesArray       = $this->fileHelper->getFiles($this->databaseMigrationPath, '/\.php$/i');

        if (empty($filesArray)) {
            return;
        }

        uasort($filesArray, static function (SplFileInfo $a, SplFileInfo $b) {
            return $a->getFilename() <=> $b->getFilename();
        });

        foreach ($filesArray as $file) {
            try {
                $schemaAggregator->addStatements($this->parser->parseFile($file->getPathname()));
            } catch (ParserErrorsException) {
                continue;
            }
        }
    }
}
