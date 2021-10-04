<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class PdfTestController extends Controller
{
    public function index(){
        $snappy = App::make( "snappy.pdf" );
        $html = "<style>html{ font-size: 72px }</style><h1>Bill</h1><p>You owe me money, dude.</p>";
        $fileName = "file.pdf";

        return response(
            $snappy->getOutputFromHTML( $html ),
            200,
            [
                "content-type" => "application/pdf",
                "content-disposition" => "attachment; filename=\"$fileName\""
            ]
        );
    }
}
