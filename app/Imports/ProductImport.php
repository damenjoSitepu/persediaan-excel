<?php

namespace App\Imports;

use App\Models\Product;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class ProductImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        return new Product([
            'name'  => $row['name'],
            'stock' => $row['stock'],
        ]);
    }

    // public function onError(Throwable $error)
    // {
    // }

    public function rules(): array
    {
        return [
            '*.name'    =>  'unique:product,name'
        ];
    }

    public function customValidationAttributes()
    {
        return ['name' => 'Nama Produk'];
    }

    public function customValidationMessages()
    {
        return [
            'name.unique' => 'Nama Produk :input Sudah Ada Di Dalam Data Sebelumnya!',
        ];
    }

    // public function collection(Collection $rows)
    // {
    // Validator::make($rows[0]->toArray(), [
    //     '*.name' => 'unique:product,name'
    // ], [
    //     '*.name.unique' => 'Produk :input sudah ada di dalam data sebelumnya!'
    // ])->validate();

    //     foreach ($rows[0] as $row) {
    //         Product::insertProduct($row);
    //     }
    // }
}
