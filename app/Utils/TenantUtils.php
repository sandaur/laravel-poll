<?php

namespace App\Utils;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class TenantUtils
{
    /**
     * Prefijo que identifica una base de datos de una votacion
     * 
     * @var string
     */
    protected static $dbPrefix = "poll_";

    /**
     * Crea una base de datos utilizando el prefijo en @dbPrefix
     * @param string $dbName Nombre de la base de datos
     * @return boolean Verdadero si se logro crear la base de datos
     */
    public static function createDatabase($dbName)
    {
        $dbFullName = self::$dbPrefix.$dbName;

        try{
            if (self::existDatabase($dbFullName)){
                return false;
            } else{
                DB::statement("CREATE DATABASE {$dbFullName}");
            }
        } catch (\Illuminate\Database\QueryException $e){
                return false;
        }

        if (self::existDatabase($dbFullName)){
            self::migrateDatabase($dbName); // TODO: Comprobar correcta ejecucion de migracion
            return true;
        } else{
            return false;
        }
    }

    /**
     * Elimina una base de datos
     * @param string $dbName Nombre de la base de datos sin prefijo
     * @return boolean Verdadero si la base de datos se elimino
     */
    public static function destroyDatabase($dbName) // TODO: Implementar soft delete
    {
        $dbFullName = self::$dbPrefix.$dbName;

        try{
            if (self::existDatabase($dbFullName)){
                DB::statement("DROP DATABASE {$dbFullName}");
            } else{
                return false;
            }
        } catch (\Illuminate\Database\QueryException $e){
                return false;
        }

        if (self::existDatabase($dbFullName)){
            return false;
        } else{
            return true;
        }
    }

    /**
     * Comprueba si existe una base de datos
     * @param string $dbName Nombre de la base de datos con prefijo
     * @return boolean Verdadero si la base de datos existe
     */
    private static function existDatabase($dbName)
    {
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $db = DB::select($query, [$dbName]);

        return !empty($db);
    }

    /**
     * Ejecuta las migraciones para una base de datos de votacion
     * @param string $dbName Nombre de la base de datos sin prefijo
     */
    private static function migrateDatabase($dbName)
    {
        $dbFullName = self::$dbPrefix.$dbName;

        self::tenant_connect($dbFullName);

        return Artisan::call('migrate', [
            '--path' => 'database/migrations/tenancy',
            '--force' => true,
            '--database' => 'tenancy',
        ]);

    }

    private static function tenant_connect($database)
    {
        DB::purge('tenancy');
        config(['database.connections.tenancy.database' => $database]);
        DB::reconnect('tenancy');
        Schema::connection('tenancy')->getConnection()->reconnect();
    }
}