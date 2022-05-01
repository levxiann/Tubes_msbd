<!Doctype html>
<html>
    <head>
    </head>
    <body>
        <center>
            <h1>LAPORAN SURAT DISPOSISI</h1>
        </center>
    <table class="table" border="1" width="100%" cellpadding="9">
               <thead>
                   <tr>
                       <th scope="col">No</th>
                       <th scope="col">No Berkas</th>
                       <th scope="col">No Surat Masuk</th>
                       <th scope="col">Tanggal Disposisi</th>
                       <th scope="col">Isi Disposisi</th>
                       <th scope="col">Status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $key => $data)
                   <tr>
                        <th scope="row">{{++$key}}</th>
                        <th>{{$data->no}}</th>
                        <th>{{$data->inmail_no}}</th>
                        <th>{{$data->tanggal_disposisi}}</th>
                        <th>{{$data->isi_disposisi}}</th>
                        <th>{{$data->status}}</th>
                   </tr>
                   @endforeach
               </tbody>
           </table>
        
    </body>
</html>