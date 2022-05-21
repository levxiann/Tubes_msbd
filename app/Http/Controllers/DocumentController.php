<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DownloadController;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Section;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        session()->put('menu','document');
        session()->put('submenu','rekapdoc');

        $types = DocumentType::all();

        $sections = Section::all();

        if(Auth::user()->role == "lainnya")
        {
            $documents = Document::where('sifat_dokumen', 'umum')->orWhere('section_id', Auth::user()->section_id)->get();

            return view('repositori.rekapdocument', compact('documents', 'types', 'sections'));
        }
        else
        {
            $documents = Document::all();

            return view('repositori.rekapdocument', compact('documents', 'types', 'sections'));
        }
    }

    public function create()
    {   
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','document');

        session()->put('submenu','insertdoc');

        $document_types = DocumentType::all();

        $sections = Section::all();

        return view('repositori.inputdocument', compact('document_types', 'sections'));
    }

    public function store(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','document');

        session()->put('submenu','insertdoc');

        $request->validate([
            'no' => 'required|string|max:50|unique:documents,no',
            'nama_dokumen' => 'required|string|max:255',
            'document_type_id' => 'required',
            'section_id' => 'required',
            'sifat_dokumen' => 'required',
            'tanggal_terbit' => 'required|before:tomorrow',
            'perihal' => 'required|string|max:255',
            'file_dokumen' => 'required|mimes:pdf'
        ]);

        $name = $request->file('file_dokumen')->getClientOriginalName();
        $name = date('dmY_His_') . $name;
        $request->file('file_dokumen')->move(public_path('/documents'), $name);

        try
        {
            Document::create([
                'no' => rtrim($request->no, '/'),
                'nama_dokumen' => $request->nama_dokumen,
                'document_type_id' => $request->document_type_id,
                'section_id' => $request->section_id,
                'sifat_dokumen' => $request->sifat_dokumen,
                'tanggal_terbit' => $request->tanggal_terbit,
                'perihal' => $request->perihal,
                'file_dokumen' => $name
            ]);
        }
        catch(QueryException $e)
        {
            return redirect('/document')->with('error','Terjadi Kesalahan');
        }
         
        return redirect('/document')->with('success','Dokumen baru telah berhasil ditambah!');
    }

    public function edit($no)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','document');

        session()->put('submenu','rekapdoc');
        
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','document');

        session()->put('submenu','rekapdoc');

        $documents = Document::findOrFail($no);

        $document_types = DocumentType::all();

        $sections = Section::all();

        return view('repositori.editdocument', compact('documents', 'document_types', 'sections'));
    }

    public function update(Request $request, $no)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','document');

        session()->put('submenu','rekapdoc');

        $request->validate([
            'no' => 'required|string|max:50|unique:documents,no,'.$no.',no',
            'nama_dokumen' => 'required|string|max:255',
            'document_type_id' => 'required',
            'section_id' => 'required',
            'sifat_dokumen' => 'required',
            'tanggal_terbit' => 'required|before:tomorrow',
            'perihal' => 'required|string|max:255',
            'file_dokumen' => 'mimes:pdf'
        ]);

        try
        {
            Document::where('no', $no)
            ->update([
                'no' => rtrim($request->no, '/'),
                'nama_dokumen' => $request->nama_dokumen,
                'document_type_id' => $request->document_type_id,
                'section_id' => $request->section_id,
                'sifat_dokumen' => $request->sifat_dokumen,
                'tanggal_terbit' => $request->tanggal_terbit,
                'perihal' => $request->perihal
            ]);
        }
        catch(QueryException $e)
        {
            return redirect('/document')->with('error','Terjadi Kesalahan');
        }

        if($request->has('file_dokumen'))
        {
            $name = $request->file('file_dokumen')->getClientOriginalName();;
            $name = date('dmY_His_') . $name;
            $request->file('file_dokumen')->move(public_path('/documents'), $name);

            Document::where('no', rtrim($request->no, '/'))
            ->update([
                'file_dokumen' => $name
            ]);
        }
         
        return redirect('/document')->with('success','Dokumen telah berhasil diubah!');
    }

    public function detail($no)
    {
        session()->put('menu','document');

        session()->put('submenu','rekapdoc');
        
        $documents = Document::findOrFail($no);

        if((Auth::user()->role == 'lainnya') && $documents->section_id != Auth::user()->section_id && $documents->sifat_dokumen == 'rahasia')
        {
            return redirect('/document');
        }

        return view('repositori.detaildocument', compact('documents'));
    }

    public function destroy($no)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','document');

        session()->put('submenu','rekapdoc');

        Document::destroy($no);

        return redirect('/document')->with('success','Data Dokumen berhasil dihapus!');
    }

    public function search(Request $request)
    {
        session()->put('menu','document');
        session()->put('submenu','rekapdoc');

        $types = DocumentType::all();
        $sections = Section::all();

        if(Auth::user()->role == "lainnya")
        {
            $documents = Document::where(function($query)
                        {
                            $query->where('sifat_dokumen', 'umum')->orWhere('section_id', Auth::user()->section_id); 
                        })
                        ->when($request->type != '0', function($query) use ($request){
                            return $query->where('document_type_id', $request->type);
                        })
                        ->when($request->section != '0', function($query) use ($request){
                            return $query->where('section_id', $request->section);
                        })->get();

            return view('repositori.rekapdocument', compact('documents', 'types', 'sections'));
        }
        else
        {
            $documents = Document::select('*')
                        ->when($request->type != '0', function($query) use ($request){
                            return $query->where('document_type_id', $request->type);
                        })
                        ->when($request->section != '0', function($query) use ($request){
                            return $query->where('section_id', $request->section);
                        })->get();

            return view('repositori.rekapdocument', compact('documents', 'types', 'sections'));
        }
    }
}
