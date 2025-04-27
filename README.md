# 🚀 Company Profile

Project website Company Profile Himpunan Mahasiswa Teknik Informatika by WebDev 2025

---

## 📦 Prasyarat

Sebelum memulai, pastikan kamu sudah menginstal:

- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [MySQL / MariaDB](https://www.mysql.com/)
- [Laravel Version 11](https://laravel.com/)

---

## 🛠 Instalasi

Berikut langkah-langkah untuk menjalankan proyek ini di lokal:

### 1. Clone Repository

```bash
git clone https://github.com/WebDevHimti/Company-Profile.git
cd company-profile
cp .env.example .env
```

Buka .env dan sesuaikan sesuai konfigurasi berikut :<br/>

APP_URL=http://localhost -> APP_URL=http://127.0.0.1:8000<br/>
DB_CONNECTION=mysql<br/>
DB_HOST=127.0.0.1<br/>
DB_PORT=3306<br/>
DB_DATABASE=your_data_base<br/>
DB_USERNAME=your_username<br/>
DB_PASSWORD=your_password<br/>

Selanjutnya jalankan perintah berikut :
```bash
$ composer install
$ php artisan key:generate
$ php artisan migrate
```

---

## ❗❗❗ Penyesuaian File Vendor pada project laravel anda

<pre>
company-profile/
├── app
├── bootstrap
├── config
├── database
├── public
├── resources
├── routes
├── storage
├── tests
├── vendor
    └── open-admin-org
        └── open-admin
            └── src
                └── Console
                     └── ResourceGenerator.php 👈
</pre>
    
Temukan file ResourceGenerator.php dalam project laravel anda
dan ganti dengan isi file berikut :

```bash
<?php

namespace OpenAdmin\Admin\Console;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ResourceGenerator
{
    /**
     * @var Model
     */
    protected $model;
    private $useDoctine = true;

    /**
     * @var array
     */
    protected $formats = [
        'form_field'  => "\$form->%s('%s', __('%s'))",
        'show_field'  => "\$show->field('%s', __('%s'))",
        'grid_column' => "\$grid->column('%s', __('%s'))",
    ];

    /**
     * @var array
     */
    private $doctrineTypeMapping = [
        'string' => [
            'enum', 'geometry', 'geometrycollection', 'linestring',
            'polygon', 'multilinestring', 'multipoint', 'multipolygon',
            'point',
        ],
    ];

    /**
     * @var array
     */
    protected $fieldTypeMapping = [
        'ip'          => 'ip',
        'email'       => 'email|mail',
        'password'    => 'password|pwd',
        'url'         => 'url|link|src|href',
        'phonenumber' => 'mobile|phone',
        'color'       => 'color|rgb',
        'image'       => 'image|img|avatar|pic|picture|cover',
        'file'        => 'file|attachment',
    ];

    /**
     * ResourceGenerator constructor.
     *
     * @param mixed $model
     */
    public function __construct($model)
    {
        $this->model = $this->getModel($model);

        if (explode('.', $this->model->getTable())[0] >= 11) {
            $this->useDoctine = false;
        }
    }

    /**
     * @param mixed $model
     *
     * @return mixed
     */
    protected function getModel($model)
    {
        if ($model instanceof Model) {
            return $model;
        }

        if (!class_exists($model) || !is_string($model) || !is_subclass_of($model, Model::class)) {
            throw new \InvalidArgumentException("Invalid model [$model] !");
        }

        return new $model();
    }

    /**
     * @return string
     */
    public function generateForm()
    {
        $reservedColumns = $this->getReservedColumns();

        $output = '';

        $table = $this->model->getTable();
        foreach ($this->getTableColumns() as $column) {
            $name = $column->getName();
            if (in_array($name, $reservedColumns)) {
                continue;
            }
            if ($this->useDoctine) {
                $type = $column->getType()->getName();
            } else {
                $type = Schema::getColumnType($table, $name);
            }
            $default = $column->getDefault();

            $defaultValue = '';

            // set column fieldType and defaultValue
            switch ($type) {
                case 'boolean':
                case 'bool':
                    $fieldType = 'switch';
                    break;
                case 'json':
                case 'array':
                case 'object':
                    $fieldType = 'textarea';
                    break;
                case 'string':
                    $fieldType = 'text';
                    foreach ($this->fieldTypeMapping as $type => $regex) {
                        if (preg_match("/^($regex)$/i", $name) !== 0) {
                            $fieldType = $type;
                            break;
                        }
                    }
                    $defaultValue = "'{$default}'";
                    break;
                case 'integer':
                case 'bigint':
                case 'smallint':
                    $fieldType = 'number';
                    break;
                case 'decimal':
                case 'float':
                case 'real':
                    $fieldType = 'decimal';
                    break;
                case 'timestamp':
                case 'datetime':
                    $fieldType    = 'datetime';
                    $defaultValue = "date('Y-m-d H:i:s')";
                    break;
                case 'date':
                    $fieldType    = 'date';
                    $defaultValue = "date('Y-m-d')";
                    break;
                case 'time':
                    $fieldType    = 'time';
                    $defaultValue = "date('H:i:s')";
                    break;
                case 'text':
                case 'blob':
                    $fieldType = 'textarea';
                    break;
                default:
                    $fieldType    = 'text';
                    $defaultValue = "'{$default}'";
            }

            $defaultValue = $defaultValue ?: $default;

            $label = $this->formatLabel($name);

            $output .= sprintf($this->formats['form_field'], $fieldType, $name, $label);

            if (trim($defaultValue, "'\"")) {
                $output .= "->default({$defaultValue})";
            }

            $output .= ";\r\n";
        }

        return $output;
    }

    public function generateShow()
    {
        $output = '';

        foreach ($this->getTableColumns() as $column) {
            $name = $column->getName();

            // set column label
            $label = $this->formatLabel($name);

            $output .= sprintf($this->formats['show_field'], $name, $label);

            $output .= ";\r\n";
        }

        return $output;
    }

    public function generateGrid()
    {
        $output = '';

        foreach ($this->getTableColumns() as $column) {
            $name  = $column->getName();
            $label = $this->formatLabel($name);

            $output .= sprintf($this->formats['grid_column'], $name, $label);
            $output .= ";\r\n";
        }

        return $output;
    }

    protected function getReservedColumns()
    {
        return [
            $this->model->getKeyName(),
            $this->model->getCreatedAtColumn(),
            $this->model->getUpdatedAtColumn(),
            'deleted_at',
        ];
    }

    /**
     * Get columns of a giving model.
     *
     * @throws \Exception
     *
     * @return \Doctrine\DBAL\Schema\Column[]
     */
    protected function getTableColumns()
    {
        if ($this->useDoctine && !$this->model->getConnection()->isDoctrineAvailable()) {
            throw new \Exception(
                'You need to require doctrine/dbal: ~2.3 in your own composer.json to get database columns. '
            );
        }

        $table = $this->model->getConnection()->getTablePrefix().$this->model->getTable();
        /* @var \Doctrine\DBAL\Schema\MySqlSchemaManager $schema */

        if ($this->useDoctine) {
            $schema = $this->model->getConnection()->getDoctrineSchemaManager($table);

            // custom mapping the types that doctrine/dbal does not support
            $databasePlatform = $schema->getDatabasePlatform();

            foreach ($this->doctrineTypeMapping as $doctrineType => $dbTypes) {
                foreach ($dbTypes as $dbType) {
                    $databasePlatform->registerDoctrineTypeMapping($dbType, $doctrineType);
                }
            }

            $database = null;
            if (strpos($table, '.')) {
                list($database, $table) = explode('.', $table);
            }

            return $schema->listTableColumns($table, $database);
        } else {
            return $this->listTableColumns($table);
        }
    }

    public function checkDriver()
    {
        $config = $this->model->getConnection()->getConfig();
        if ($config['driver'] != 'mysql') {
            throw new \Exception(
                'Only mysql supported for now, sorry '
            );
        }
    }

    public function listTableColumns($table)
    {
        $this->checkDriver();
        $list    = Schema::getColumnListing($table);
        $columns = [];
        foreach ($list as $columnName) {
            $columnInfo = DB::select('SHOW COLUMNS FROM `'.$table."` LIKE '".$columnName."'")[0];

            $columns[] = new class($columnName, $columnInfo) {
                public $columnName;
                public $columnInfo;

                public function __construct($columnName, $columnInfo)
                {
                    $this->columnName = $columnName;
                    $this->columnInfo = $columnInfo;
                }

                public function getName()
                {
                    return $this->columnName;
                }

                public function getDefault()
                {
                    return $this->columnInfo->Default;
                }
            };
        }

        return $columns;
    }

    /**
     * Format label.
     *
     * @param string $value
     *
     * @return string
     */
    protected function formatLabel($value)
    {
        return ucfirst(str_replace(['-', '_'], ' ', $value));
    }
}
```

---

## ▶ Jalankan aplikasi

```bash
$ php artisan ser
```

Akses halaman admin pada http://127.0.0.1:8000/admin .untuk mengakses open admin panel
Login dengan default akun admin :<br/>
username : admin<br/>
password : admin

---

