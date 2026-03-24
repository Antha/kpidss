<?php

namespace App\Models;

use CodeIgniter\Model;

class ReplaceDataModel extends Model
{
    public function isAllowedTable(string $table): bool
    {
        // cek pola kpi_YYYYMM
        if (preg_match('/^kpi_data[_-]\d{6}$/', $table)) {
            return true;
        }

        return false;
    }

    protected function assertAllowed(string $table): void
    {
        if (!$this->isAllowedTable($table)) {
            throw new \InvalidArgumentException('Table not allowed');
        }
    }

    public function getTableColumns(string $table): array
    {
        return array_column(
            $this->db->getFieldData($table),
            'name'
        );
    }

    public function validateCSVHeader(array $csvHeader, array $tableColumns): array
    {
        $missing = array_diff($tableColumns, $csvHeader);
        $extra   = array_diff($csvHeader, $tableColumns);

        return [
            'valid'   => empty($missing) && empty($extra),
            'missing' => $missing,
            'extra'   => $extra
        ];
    }

    public function backupTable(string $table): string
    {
        if (!$this->isAllowedTable($table)) {
            throw new \InvalidArgumentException('Table not allowed');
        }

        $backupTable = $table . '_backup_' . date('Ymd_His');

        $this->db->query("CREATE TABLE {$backupTable} LIKE {$table}");
        $this->db->query("INSERT INTO {$backupTable} SELECT * FROM {$table}");

        return $backupTable;
    }

    public function insertBatchDynamic(string $table, array $data)
    {
        $this->assertAllowed($table);
        
        if (empty($data)) {
            return false;
        }

        return $this->db
            ->table($table)
            ->insertBatch($data);
    }

    public function truncateTable(string $table)
    {
        $this->assertAllowed($table);

        return $this->db->table($table)->truncate();
    }

}