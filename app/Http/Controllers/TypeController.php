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
        $groups = DB::table('document_groups')->paginate(10);
        return view('Document.document_group', compact('groups'));
    }

    public function group_create()
    {
        return view('Document.create_document_group');
    }

    public function group_insert(Request $request)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        DocumentGroup::create([
            'nama_kelompok_dokumen' => $request->name,
        ]);

        return redirect('document_group')->with('success','Data kelompok dokumen baru berhasil ditambah!');
    }

    public function group_edit($id)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $group = DocumentGroup::findOrFail($id);

        return view('Document.editgroup', compact('group'));
    }

    public function group_update(Request $request, $id)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        DocumentGroup::where('id', $id)
        ->update([
            'nama_kelompok_dokumen' => $request->name,
        ]);

        return redirect('document_group')->with('success','Data kelompok dokumen berhasil diubah!');
    }

    public function type()
    {
        $types = DocumentType::with('document_group')->paginate(10);
        return view('Document.document_type', compact('types'));
    }

    public function type_create()
    {
        $groups = DocumentGroup::pluck('nama_kelompok_dokumen','id');
        return view('Document.create_document_type', compact('groups'));
    }

    public function type_insert(Request $request)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

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

    public function type_edit($id)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $type = DocumentType::findOrFail($id);
        $groups = DocumentGroup::pluck('nama_kelompok_dokumen','id');

        return view('Document.edittype', compact('type','groups'));
    }

    public function type_update(Request $request, $id)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

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
        $mails = DB::table('mail_types')->paginate(10);
        return view('Mail.mail_type', compact('mails'));
    }

    public function mail_create()
    {
        return view('Mail.create_type');
    }

    public function mail_insert(Request $request)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        MailType::create([
            'nama_jenis_surat' => $request->name,
        ]);

        return redirect('mail_type')->with('success','Data jenis surat baru berhasil ditambah!');
    }

    public function mail_edit($id)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $mail = MailType::findOrFail($id);

        return view('Mail.edit_type', compact('mail'));
    }

    public function mail_update(Request $request, $id)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        MailType::where('id', $id)
        ->update([
            'nama_jenis_surat' => $request->name,
        ]);

        return redirect('mail_type')->with('success','Data jenis surat berhasil diubah!');
    }

    public function section()
    {
        $sections = DB::table('sections')->paginate(10);
        return view('Section.index', compact('sections'));
    }

    public function section_create()
    {
        return view('Section.create');
    }

    public function section_insert(Request $request)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        Section::create([
            'nama_bagian' => $request->name,
        ]);

        return redirect('section')->with('success','Data bagian baru berhasil ditambah!');
    }

    public function section_edit($id)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $section = Section::findOrFail($id);

        return view('Section.edit', compact('section'));
    }

    public function section_update(Request $request, $id)
    {
        if(Auth::user()->section_id != 1 && Auth::user()->section_id != 2)
        {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        Section::where('id', $id)
        ->update([
            'nama_bagian' => $request->name,
        ]);

        return redirect('section')->with('success','Data bagian berhasil diubah!');
    }
}
