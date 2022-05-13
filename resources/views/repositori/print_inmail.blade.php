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
                margin-bottom: 3cm;
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
            <img src="{{ public_path('images/tutwuri.png') }}" alt="watermark">
        </div>
        <!-- Define header and footer blocks before your content -->
        <header>
            <span>
                Laporan Surat Masuk
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
                    Laporan Surat Masuk Periode : {{date('d F Y', strtotime($tgl1))}} - {{date('d F Y', strtotime($tgl2))}}
                </span>
                <br>
                <table class="table" border="1" width="100%" cellpadding="9">
                    <thead>
                        <tr>
                            <th scope="col">No Surat</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Bagian</th>
                            <th scope="col">Perihal</th>
                            <th scope="col">Disposisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dt)
                        <tr>
                             <td>{{$dt->no}}</td>
                             <td>{{date('d F Y', strtotime($dt->tanggal_masuk))}}</td>
                             <td>{{$dt->section->nama_bagian}}</td>
                             <td>{{$dt->perihal}}</td>
                             <td>
                                @if ($dt->disposisi == 'Y')
                                    @foreach ($dt->disposition->destinations as $dest)
                                        {{$dest->section->nama_bagian}}<br>
                                    @endforeach
                                @else
                                    -
                                @endif 
                             </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </table>
        </main>
    </body>
</html>