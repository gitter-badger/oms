<?php
namespace phpOMS\Utils\IO\Cvs;

class SQLiteGenerator
{
    private $id = null;
    private $db = null;
    private $sources = [];
    private $destination = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addSource($source, $config = ['delim' => ',', 'enclosure' => '"', 'escape' => '\\'])
    {
        $this->sources[] = ['path' => realpath($source), 'config' => $config];
    }

    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    public function setAuth($account, $password) 
    {
    }

    public function generateDatabase()
    {
        $dbFile = fopen($this->destination, 'w');
        fclose($dbFile);

        $this->db->create('', [
            ]);
    }

    public function generateSchema() 
    {
        foreach($this->sources as $key => $source) 
        {
            $file = fopen($source['path'], 'r');
            $table = $source['path'];
            $columns = fgetcsv($file, 0, $source['config']['delim'], $source['config']['enclosure'], $source['config']['escape']);

            $query = new \phpOMS\DataStorage\Database\Query\Builder($this->db);
            $query->create($table);

            foreach($columns as $column) {
                $split = explode('%%%', $column);

                $c = count($split);
                if($c == 1) {
                    $query->createColumn($split[0], \phpOMS\DataStorage\Database\Query\Sqlite\ColumnType::TEXT);
                } elseif($c == 2) {
                    // TODO: test if split1 is valid type
                    $query->createColumn($split[0], $split[1]);
                } elseif($c == 3) {
                    // TODO: test if split1 is valid type
                    $query->createColumn($split[0], $split[1], null, 'NULL', \phpOMS\DataStorage\Database\Query\PrimaryKey::AUTOINCREMENT);
                } else {
                    throw new \Exception();
                }

                $this->db->prepare($query->toSql())->execute();
            }

            fclose($file);
        }
    }

    public function fillDatabase() 
    {
        foreach($this->sources as $key => $source) 
        {
            $file = fopen($source['path'], 'r');
            $table = $source['path'];
            $rawColumns = fgetcsv($file, 0, $source['config']['delim'], $source['config']['enclosure'], $source['config']['escape']);
            $columns = [];

            $query = new \phpOMS\DataStorage\Database\Query\Builder($this->db);
            $query->into($table);

            foreach($columns as $key => $column) {
                $split = explode('%%%', $column);

                $columns[$key]['name'] = $split[0];

                $c = count($split);
                if($c == 1) {
                    $columns[$key]['type'] = 'string';
                } else {
                    $columns[$key]['type'] = $split[1];
                }

                $query->columns($split[0]);
            }

            while (($line = fgetcsv($file, 0, $source['config']['delim'], $source['config']['enclosure'], $source['config']['escape'])) !== false) {
                $values = [];

                foreach($line as $key => $elment) {
                    // TODO: handle types
                    $values[] = $element;
                }

                $query->values(...$values);
            }
        }
    }
}