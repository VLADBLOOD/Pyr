<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Debt;

use FontLib\EOT\File;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use \PDF;
use DB;

class DebtController extends Controller{

    //Вызов вьюшки добавления записи
    public function create()
    {
        return view('create');
    }

    //Запись новой строки в БД
    public function store(Request $request)
    {
        $request->validate([
            'lastname'=> 'required',
            'firstname'=> 'required',
            'secondname'=> 'required',
            'debt'=> 'required'
        ]);

        $debt = new Debt([
            'lastname' => $request->get('lastname'),
            'firstname' => $request->get('firstname'),
            'secondname' => $request->get('secondname'),
            'debt' => $request->get('debt'),
            'statefee' => self::statefee_calculate($request->get('debt'))
        ]);

        $debt->save();

        return redirect('/')->with('success', 'Должник добавлен');
    }

    //Расчет ГП
    public function statefee_calculate($debt)
    {
        return $debt + 100 *10;
    }

    //Вызов вьюшки редактирования
    public function edit($id)
    {
        $debt = Debt::find($id);

        return view('edit', compact('debt'));
    }

    //Перезапись строки
    public function update(Request $request, $id)
    {
        $request->validate([
            'lastname'=> 'required',
            'firstname'=> 'required',
            'secondname'=> 'required',
            'debt'=> 'required'
        ]);

        $debt = Debt::find($id);
        $debt->lastname = $request->get('lastname');
        $debt->firstname = $request->get('firstname');
        $debt->secondname = $request->get('secondname');
        $debt->debt = $request->get('debt');
        $debt->statefee = self::statefee_calculate($request->get('debt'));
        $debt->save();

        return redirect('/')->with('success', 'Данные потребителя изменены');
    }

    //Скачивание Excel
    public function excel_export()
    {
        return Excel::download(new UsersExport, 'debtors.xlsx');
    }

    //Предпросмотр PDFa
    public function pdf_preview($id) {
        $debt = Debt::find($id);
        $pdf = PDF::loadView('pdf', compact('debt'));

        return $pdf->stream();
    }

    //Скачивание PDFa
    public function pdf_export($id) {
        $debt = Debt::find($id);
        $pdf = PDF::loadView('pdf', compact('debt'));

        return $pdf->download('debtor.pdf');
    }

    //Загрузка файла в БД
    public function pdf_upload_db($id) {
        $debt = Debt::find($id);
        $pdf = PDF::loadView('pdf', compact('debt'));
        $file = base64_encode($pdf->output());


        $bpdf = new Files();

        $bpdf->userid = $id;
        $bpdf->document = $file;

        $bpdf->save();

        return redirect('/')->with('success', 'Запись успешно записана в БД');
    }

    //Выгрузка файла с БД
    public function pdf_download_db($id) {

        $path = public_path()."\\".uniqid().'.pdf';
        $bpdfs = DB::table('files')->get();

        foreach ($bpdfs as $bpdf) {
            if ($bpdf->userid == $id) {
                file_put_contents($path, base64_decode($bpdf->document));
                return response()->download($path);
            }
        }
        return redirect('/')->with('success', 'Записи нет в БД ');
    }

}
