<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0.5cm 1cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
                text-align: center;
                line-height: 0.8cm;
            }

            .dituju {
                width: 100%;
            }

            #watermark
            {
                position:fixed;
                bottom:5px;
                right:5px;
                opacity:0.3;
                z-index:99;
                color:white;
            }
        </style>
    </head>
    <body>
        <div id="watermark">
            <img src="{{ public_path('images/nophoto.png') }}" alt="watermark">
        </div>
        <!-- Define header and footer blocks before your content -->
        <header>
            <span>
                Laporan Disposisi
            </span>
            <br>
            <span>
                Aplikasi Repositori Dokumen Sekolah
            </span>
            <hr>
        </header>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table class="dituju">
                <span style="display: flex; text-align : center;">
                    Laporan Disposisi Periode : {{date('d F Y', strtotime($tgl1))}} - {{date('d F Y', strtotime($tgl2))}}
                </span>
                <br>
                <table class="table" border="1" width="100%" cellpadding="9">
                    <thead>
                        <tr>
                            <th scope="col">No Surat</th>
                            <th scope="col">No Disposisi</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Tanggal Disposisi</th>
                            <th scope="col">Bagian</th>
                            <th scope="col">Perihal</th>
                            <th scope="col">Ditujukan</th>
                            <th scope="col">Isi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dt)
                        <tr>
                             <td>{{$dt->inmail_no}}</td>
                             <td>{{$dt->no}}</td>
                             <td>{{date('d F Y', strtotime($dt->inmail->tanggal_masuk))}}</td>
                             <td>{{date('d F Y', strtotime($dt->tanggal_disposisi))}}</td>
                             <td>{{$dt->inmail->section->nama_bagian}}</td>
                             <td>{{$dt->inmail->perihal}}</td>
                             <td>
                                @foreach ($dt->destinations as $dest)
                                    {{$dest->section->nama_bagian}}<br>
                                @endforeach
                             </td>
                             <td>{{$dt->isi_disposisi}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <span style="display: flex; text-align : right;">
                    <br>
                    Kepala Sekolah <br><br><br><br><br>
                    ...................................
                </span>
            </table>
        </main>
    </body>
</html>