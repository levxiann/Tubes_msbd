<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DownloadController;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::where([
            ['no', '!=', Null], ['nama_dokumen', '!=', Null], ['tanggal_terbit', '!=', Null],
            [function ($query) use ($request){
                if(($term = $request->term)){
                    $query->orWhere('no', $term)->get();
                    $query->orWhere('nama_dokumen', 'LIKE', '%'.$term.'%')->get();
                    $query->orWhere('tanggal_terbit', 'LIKE', '%'.$term.'%')->get();
                }
            }]
        ])
        ->orderBy("no", "desc")
        ->paginate(10);

        $documents->appends(['term' => $request->term]);

        return view('repositori.rekapdocument', compact('documents'));
    }

    public function create()
    {   
        $documents = Document::all();
        $document_types = DocumentType::all();
        $sections = Section::all();
        return view('repositori.inputdocument', compact('documents', 'document_types', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no' => 'required|string|unique:documents|max:50',
            'nama_dokumen' => 'required|string|max:255',
            'document_type_id' => 'required',
            'section_id' => 'required',
            'sifat_dokumen' => 'required',
            'tanggal_terbit' => 'required|date',
            'perihal' => 'required|string|max:255',
            'file_dokumen' => 'required|mimes:pdf'
        ]);

        $name = $request->file('file_dokumen')->getClientOriginalName();
        $name = date('dFY_His') . $name;
        $request->file('file_dokumen')->move(public_path('/documents'), $name);

        Document::create([
            'no' => $request->no,
            'nama_dokumen' => $request->nama_dokumen,
            'document_type_id' => $request->document_type_id,
            'section_id' => $request->section_id,
            'sifat_dokumen' => $request->sifat_dokumen,
            'tanggal_terbit' => $request->tanggal_terbit,
            'perihal' => $request->perihal,
            'file_dokumen' => $name
        ]);
         
        return redirect('/document/inputdocument')->with('success','Dokumen baru telah berhasil ditambah!');
    }

    public function edit($no)
    {
        $documents = Document::findOrFail($no);
        $document_types = DocumentType::all();
        $sections = Section::all();
        return view('repositori.editdocument', compact('documents', 'document_types', 'sections'));
    }

    public function update(Request $request, $no)
    {
        $request->validate([
            'no' => 'required|string|max:50',
            'nama_dokumen' => 'required|string|max:255',
            'document_type_id' => 'required|integer|max:20',
            'section_id' => 'required|integer|max:20',
            'sifat_dokumen' => 'required|string',
            'tanggal_terbit' => 'required|date',
            'perihal' => 'required|string|max:255',
            'file_dokumen' => 'mimes:pdf|max:2048'
        ]);

        Document::where('no', $no)
        ->update([
            'no' => $request->no,
            'nama_dokumen' => $request->nama_dokumen,
            'document_type_id' => $request->document_type_id,
            'section_id' => $request->section_id,
            'sifat_dokumen' => $request->sifat_dokumen,
            'tanggal_terbit' => $request->tanggal_terbit,
            'perihal' => $request->perihal
        ]);

        if($request->has('file_dokumen'))
        {
            $name = $request->file('file_dokumen')->getClientOriginalName();;
            $name = date('dFY_His') . $name;
            $request->file('file_dokumen')->move(public_path('/documents'), $name);

            Document::where('no', $no)
            ->update([
                'file_dokumen' => $name
            ]);
        }
         
        return redirect('/document')->with('success','Dokumen telah berhasil diubah!');
    }

    public function detail($no)
    {
        $documents = Document::find($no);
        return view('repositori.detaildocument', compact('documents'));
    }

    public function destroy($no)
    {
        Document::destroy($no);

        return redirect('/document')->with('success','Data Dokumen berhasil dihapus!');
    }
}
