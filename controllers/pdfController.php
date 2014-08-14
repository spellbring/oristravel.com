<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class pdfController extends Controller
{
    private $_pdf;
    
    public function __construct() {
        parent::__construct();
        //$this->getLibrary('fpdf');
        //$this->_pdf= new FPDF;
    }
    
    public function index(){} //El index es obligatorio aun que no contenga codigo, Lo exije el Controlador principal
    
    public function pdf1()
    {
        $this->getLibrary('fpdf');
        $this->_pdf= new FPDF();
        
        $this->_pdf->AddPage();
        $this->_pdf->SetFont('Arial','B',16);
        //$this->_pdf->Cell(40,10, utf8_decode('¡Hola, Mundo!'));
        $this->_pdf->Cell(40,10,'¡Hola, Mundo!');
        $this->_pdf->Output();
    }
}