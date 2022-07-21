<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Product;
use Dompdf\Dompdf;
use Dompdf\Options;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Tutorial extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'Product',
            'product'   => Product::all()
        ];


        return view('tutorial/index', $data);
    }

    // Qr code
    public function qrcode()
    {
        $data = [
            'title' => 'Qr Code'
        ];

        // DOMPDF

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', TRUE);
        $options->set('debugKeepTemp', TRUE);
        $options->set('isHtml5ParserEnabled', true);
        // $options->set('chroot', base_url('assets/img/'));
        $pdf = new Dompdf($options);

        $pdf = new Dompdf();

        $pdf->loadHtml(view('tutorial/qrcode', $data));
        $pdf->setPaper('A4', 'landscape');

        $pdf->render();
        $pdf->stream(hash('ripemd160', 'Data-Product'), array("Attachment" => false));
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'Product.xlsx');
    }

    public function import(Request $request)
    {
        $fileImport = $request->file('my-file')->store('Excel');
        // Import File
        $import = new ProductImport;
        $import->import($fileImport);
        // dd($import->failures());
        if ($import->failures()->isNotEmpty()) {
            return redirect()->route('tutorial')->withFailures($import->failures());
        }

        // Ubah file ke collection
        // $importToCollection = $import->toCollection($fileImport);

        // Validation
        // Validator::make($importToCollection[0]->toArray(), [
        //     '*.name' => 'unique:product,name'
        // ], [
        //     '*.name.unique' => 'Produk :input sudah ada di dalam data sebelumnya!'
        // ])->validate();

        // // Import collection
        // $import->collection($importToCollection);
        // dd($import->errors());
        // // dd($import->failures());



        // Excel::import(new ProductImport, $fileImport);
        return redirect()->route('tutorial')->with('message', 'All Goods!');
    }
}
