<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }       
        return view('siswa.index');
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
        DB::table('siswas')
            ->insert([
                'nis_siswa' => $request['nis_siswa'],
                'nama_siswa' => $request['nama_siswa'],
                'kelas_siswa' => $request['kelas_siswa'],
            ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Data Created',
        ]);
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

       $siswa = DB::select("select * from siswas where id_siswa = ('$id')");
        return response()->json($siswa);
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
        DB::table('siswas')
        ->where('id_siswa', $id)
        ->update([
            'nis_siswa' => $request['nis_siswa'],
            'nama_siswa' => $request['nama_siswa'],
            'kelas_siswa' => $request['kelas_siswa'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('siswas')
        ->where('id_siswa', $id)
        ->delete();
    }


    public function api()
    {
        $data = Siswa::all();
        return response()->json($data);
    }

    //export data 
    public function ExportExcel($data)
    {


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $sheet->setCellValue('A1', "DATA SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "ID"); // Set kolom A3 dengan tulisan "ID"
        $sheet->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "KELAS"); // Set kolom D3 dengan tulisan "KELAS"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        // Set height baris ke 1, 2 dan 3
        $sheet->getRowDimension('1')->setRowHeight(20);
        $sheet->getRowDimension('2')->setRowHeight(20);
        $sheet->getRowDimension('3')->setRowHeight(20);
        //Buat query untuk menampilkan semua data siswa
        $sql = DB::table('siswas')->orderBy('id_siswa', 'DESC')->get();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $row = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($sql as $data) { // Ambil semua data dari hasil eksekusi $sql
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $data->nis_siswa);
            $sheet->setCellValue('C' . $row, $data->nama_siswa);
            $sheet->setCellValue('D' . $row, $data->kelas_siswa);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $row)->applyFromArray($style_row);
            $sheet->getStyle('B' . $row)->applyFromArray($style_row);
            $sheet->getStyle('C' . $row)->applyFromArray($style_row);
            $sheet->getStyle('D' . $row)->applyFromArray($style_row);

            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom No
            $sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text left untuk kolom NIS
            $sheet->getRowDimension($row)->setRowHeight(20); // Set height tiap row
            $no++; // Tambah 1 setiap kali looping
            $row++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Siswa.xls"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
    }


    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    function exportSiswa()
    {
        $data = DB::table('siswas')->orderBy('id_siswa', 'DESC')->get();
        // return response()->json($data);
        $data_array[] = array("ID", "Nis", "Nama", "Kelas");
        foreach ($data as $data_item) {
            $data_array[] = array(
                'ID' => $data_item->id_siswa,
                'Nis' => $data_item->nis_siswa,
                'Nama' => $data_item->nama_siswa,
                'Kelas' => $data_item->kelas_siswa,
            );
        }
        $this->ExportExcel($data_array);
     }

}
