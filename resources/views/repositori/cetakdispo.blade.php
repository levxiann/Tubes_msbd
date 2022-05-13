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
                margin-top: 9cm;
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

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
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
            <span style="text-decoration : underline;">
                Kartu Disposisi
            </span>
            <br>
            <span style="display:flex; text-align: right">
                Tanggal : {{date('d F Y', strtotime($disposition->tanggal_disposisi))}} &nbsp;
            </span>
            <table>
                <tr>
                    <td> Bagian </td>
                    <td> : {{ $disposition->inmail->section->nama_bagian}}</td>
                </tr>
                <tr>
                    <td> Perihal </td>
                    <td> : {{ $disposition->inmail->perihal}}</td>
                </tr>
                <tr>
                    <td> No. Surat </td>
                    <td> : {{ $disposition->inmail_no}}</td>
                </tr>
                <tr>
                    <td> No. Disposisi </td>
                    <td> : {{ $disposition->no}}</td>
                </tr>
                <tr>
                    <td>Isi</td>
                    <td>: {{ $disposition->isi_disposisi}}</td>
                </tr>
            </table>
            <hr>
        </header>

        <footer>
            Aplikasi Repositori Dokumen Sekolah
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table class="dituju">
                <tr>
                    <td>Diteruskan Kepada : </td>
                    <td style="text-align: right;">Instruksi Informasi</td>
                </tr>
                <tr>
                    <td style="height: 150px;">
                        @foreach ($disposition->destinations as $dest)
                            <li>{{$dest->section->nama_bagian}}</li><br>
                        @endforeach
                    </td>
                    <td style="text-align: right;">{{$disposition->inmail->section->nama_bagian}}</td>
                </tr>
            </table>
        </main>
    </body>
</html>

