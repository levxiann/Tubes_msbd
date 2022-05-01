<!Doctype html>
<html>
    <head>
    </head>
    <body>
        <center>
            <h1>LAPORAN SURAT MASUK</h1>
        </center>
    <table class="table" border="1" width="100%" cellpadding="9">
               <thead>
                   <tr>
                       <th scope="col">No</th>
                       <th scope="col">No Berkas</th>
                       <th scope="col">Tanggal Masuk</th>
                       <th scope="col">Perihal</th>
                       <th scope="col">Disposisi</th>
                       <th scope="col">Pokok Masalah</th>
                       <th scope="col">Status</th>
                       <th scope="col">File Surat</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $key => $data)
                   <tr>
                        <th scope="row">{{++$key}}</th>
                        <th>{{$data->no}}</th>
                        <th>{{$data->tanggal_masuk}}</th>
                        <th>{{$data->perihal}}</th>
                        <th>{{$data->disposisi}}</th>
                        <th>{{$data->pokok_masalah}}</th>
                        <th>{{$data->status}}</th>
                        <th>{{$data->file_surat}}</th>
                   </tr>
                   @endforeach
               </tbody>
           </table>
        
    </body>
</html>