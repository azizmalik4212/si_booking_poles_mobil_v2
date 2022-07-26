<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use Codedge\Fpdf\Fpdf\Fpdf;


class PdfController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Makassar");
    }

    public function pdfSuratCuti($idCuti){
        $this->fpdf = new Fpdf;
        $this->fpdf->AddPage("P", 'A4');
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Image("assets/img/logo_wsa.jpeg", 12, 7, 40);
        // $this->fpdf->Image("assets/img/logo_wsa.jpeg", 165, 7, 40);
        $title = 'Surat Cuti Pegawai WSA Toserba';
        $data = cuti::select("tb_cuti.*", "users.*")->join("users", "tb_cuti.id_user", "users.id")->where("tb_cuti.id",$idCuti)->first();

        if (!in_array($data->signature,['','0','-',null])) {
            $signatureBlob = explode(',',$data->signature,2)[1];
            $picSignature = 'data://text/plain;base64,'. $signatureBlob;
        }

        if (!in_array($data->signature_validation,['','0','-',null])) {
            $signatureValidation = explode(',',$data->signature_validation,2)[1];
            $picSignatureValidation = 'data://text/plain;base64,'. $signatureValidation;
        }

        $jenisKelamin=$data->jk=='L'?'Laki-laki':'Perempuan';
        $this->fpdf->SetTitle($title);
        // mencetak string
        $this->fpdf->SetFont('Arial', 'B', 14);
        $this->fpdf->SetY(6, 7);
        $this->fpdf->Cell(190, 10, "SURAT IZIN CUTI", 0, 1, 'C');
        $this->fpdf->Cell(190, 10, "WSA TOSERBA", 0, 1, 'C');
        $this->fpdf->Cell(190, 10, "KABUPATEN DENPASAR", 0, 1, 'C');
        $this->fpdf->SetFontSize(12);
        $this->fpdf->SetFont('Arial', '');

        $this->fpdf->SetLineWidth(0.6);
        $this->fpdf->Line(198, 40, 10, 40);
        $this->fpdf->SetLineWidth(0.3);

        $this->fpdf->SetFontSize(10);
        $this->fpdf->SetFont('Arial', '');
        $this->fpdf->Cell(130, 10, '', 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'Kepada Yth.', 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'Bapak/Ibu.', 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'Pimpinan WSA Toserba', 0, 1, 'L');
        $this->fpdf->Cell(130, 8, '', 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'Perihal : '.$data->perihal, 0, 1, 'L');
        $this->fpdf->Cell(130, 5, '', 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'Dengan Hormat', 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'Saya yang bertanda tangan dibawah ini', 0, 1, 'L');
        $this->fpdf->Cell(130, 2, '', 0, 1, 'L');
        $this->fpdf->SetFont('Arial', '');
        $this->fpdf->Cell(130, 8, 'Nama'.$this->spaceColon(15).$data->name, 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'Alamat'.$this->spaceColon(14).$data->alamat, 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'No. Telp'.$this->spaceColon(12).$data->telp, 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'Jenis kelamin' .$this->spaceColon(4).$jenisKelamin, 0, 1, 'L');
        $this->fpdf->Cell(130, 8, 'Golongan'.$this->spaceColon(10).$this->numberToRoman($data->golongan), 0, 1, 'L');
        $this->fpdf->Cell(130, 2, '', 0, 1, 'L');
        $this->fpdf->Cell(130, 8, $data->keterangan, 0, 1, 'L');

        $this->fpdf->Cell(10, 60, '', 0, 1);

        $this->fpdf->SetFont('Arial','',10);
        $this->fpdf->Cell(72,6,'Hormat saya',0,0,'L');
        $this->fpdf->Cell(25,6,'',0,0,'C');
        $this->fpdf->Cell(25,6,'',0,0,'R');
        $this->fpdf->Cell(25,6,'',0,0,'R');
        $this->fpdf->Cell(42,6,'Menyetujui',0,0,'R');
        $this->fpdf->Cell(20,6,'',0,0,'L');
        $this->fpdf->Cell(42,6,'',0,1,'R');

        $this->fpdf->Cell(130, 10, '', 0, 1, 'L');




        $this->fpdf->SetFont('Arial','',10);
        if (@$picSignature!=null )
            $this->fpdf->Cell(72,6,$this->fpdf->Image($picSignature, 2,225,50,0,'png'),0,0,'L');

        $this->fpdf->Cell(25,6,'',0,0,'C');
        $this->fpdf->Cell(25,6,'',0,0,'R');
        $this->fpdf->Cell(25,6,'',0,0,'R');

        if (@$picSignatureValidation!=null)
            $this->fpdf->Cell(42,6,$this->fpdf->Image($picSignatureValidation, 170,225,50,0,'png'),0,0,'R');

        $this->fpdf->Cell(20,6,'',0,0,'L');
        $this->fpdf->Cell(42,6,'',0,1,'R');


        $this->fpdf->Cell(130, 10, '', 0, 1, 'L');

        $this->fpdf->SetFont('Arial','',10);
        $this->fpdf->Cell(72,6,$data->nama_lengkap,0,0,'L');
        $this->fpdf->Cell(25,6,'',0,0,'C');
        $this->fpdf->Cell(25,6,'',0,0,'R');
        $this->fpdf->Cell(25,6,'',0,0,'R');
        $this->fpdf->Cell(42,6,'Pimpinan WSA Toserba',0,0,'R');
        $this->fpdf->Cell(20,6,'',0,0,'L');
        $this->fpdf->Cell(42,6,'',0,1,'R');

        //$this->fpdf->cell(190, 8, $data->id, 0, 1, 'R');
        $this->fpdf->Output();
        exit;


    }

    private function spaceColon($long){
        $space=" ";
        for ($i=0; $i < $long; $i++) {
            $space=$space." ";
        }
        return $space." : ";
    }

    public function numberToRoman($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    private function spaceOnly($long){
        $space=" ";
        for ($i=0; $i < $long; $i++) {
            $space=$space." ";
        }
        return $space;
    }

}
