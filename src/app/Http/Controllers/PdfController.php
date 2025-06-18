<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    /**
     * PDF作成フォームを表示する
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * 入力内容を元にPDFを生成してダウンロードさせる
     */
    public function download(Request $request)
    {
        // フォームからの入力値を取得
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // PDFを生成
        // view()の第一引数にはPDFの見た目となるBladeテンプレートを指定
        // 第二引数にはテンプレートに渡すデータを指定
        $pdf = PDF::loadView('pdf.document', $data);

        // PDFをダウンロード
        // return $pdf->download('document.pdf');

        // ストリームでブラウザに表示させる場合はこちら
        return $pdf->stream('document.pdf');
    }
}
