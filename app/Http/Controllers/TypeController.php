<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentGroup;
use App\Models\DocumentType;
use App\Models\Section;
use App\Models\MailType;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function group()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','group');

        $groups = DocumentGroup::all();

        return view('Document.document_group', compact('groups'));
    }

    public function group_create()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','group');

        return view('Document.create_document_group');
    }

    public function group_insert(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','group');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DocumentGroup::create([
            'nama_kelompok_dokumen' => $request->name,
        ]);

        return redirect('document_group')->with('success','Data kelompok dokumen baru berhasil ditambah!');
    }

    public function group_edit(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','group');

        $group = DocumentGroup::findOrFail($id);

        return view('Document.editgroup', compact('group'));
    }

    public function group_update(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','group');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DocumentGroup::where('id', $id)
        ->update([
            'nama_kelompok_dokumen' => $request->name,
        ]);

        return redirect('document_group')->with('success','Data kelompok dokumen berhasil diubah!');
    }

    public function type()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','doc_type');

        $types = DocumentType::all();

        return view('Document.document_type', compact('types'));
    }

    public function type_create()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','doc_type');

        $groups = DocumentGroup::all();
        
        return view('Document.create_document_type', compact('groups'));
    }

    public function type_insert(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','doc_type');

        $request->validate([
            'name' => 'required|string|max:200',
            'group' => 'required',
        ]);

        DocumentType::create([
            'nama_jenis_dokumen' => $request->name,
            'document_group_id' => $request->group,
        ]);

        return redirect('document_type')->with('success','Data jenis dokumen baru berhasil ditambah!');
    }

    public function type_edit(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','doc_type');

        $type = DocumentType::findOrFail($id);
        $groups = DocumentGroup::all();

        return view('Document.edittype', compact('type','groups'));
    }

    public function type_update(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','doc_type');

        $request->validate([
            'name' => 'required|string|max:200',
            'group' => 'required',
        ]);

        DocumentType::where('id', $id)
        ->update([
            'nama_jenis_dokumen' => $request->name,
            'document_group_id' => $request->group,
        ]);

        return redirect('document_type')->with('success','Data jenis dokumen berhasil diubah!');
    }

    public function mail()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','mailtype');

        $mails = MailType::all();
        return view('Mail.mail_type', compact('mails'));
    }

    public function mail_create()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','mailtype');

        return view('Mail.create_type');
    }

    public function mail_insert(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','mailtype');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        MailType::create([
            'nama_jenis_surat' => $request->name,
        ]);

        return redirect('mail_type')->with('success','Data jenis surat baru berhasil ditambah!');
    }

    public function mail_edit(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','mailtype');

        $mail = MailType::findOrFail($id);

        return view('Mail.edit_type', compact('mail'));
    }

    public function mail_update(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','mailtype');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        MailType::where('id', $id)
        ->update([
            'nama_jenis_surat' => $request->name,
        ]);

        return redirect('mail_type')->with('success','Data jenis surat berhasil diubah!');
    }

    public function section()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','section');

        $sections = Section::all();
        return view('Section.index', compact('sections'));
    }

    public function section_create()
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','section');

        return view('Section.create');
    }

    public function section_insert(Request $request)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','section');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Section::create([
            'nama_bagian' => $request->name,
        ]);

        return redirect('section')->with('success','Data bagian baru berhasil ditambah!');
    }

    public function section_edit(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','section');

        $section = Section::findOrFail($id);

        return view('Section.edit', compact('section'));
    }

    public function section_update(Request $request, $id)
    {
        if(Auth::user()->role == 'lainnya')
        {
            return redirect('/home');
        }

        session()->put('menu','jenis');
        session()->put('submenu','section');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Section::where('id', $id)
        ->update([
            'nama_bagian' => $request->name,
        ]);

        return redirect('section')->with('success','Data bagian berhasil diubah!');
    }
}
