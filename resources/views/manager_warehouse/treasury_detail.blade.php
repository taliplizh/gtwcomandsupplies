@extends('layouts.warehouse')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@section('content')

<style>
    .center {
    margin: auto;
    width: 100%;
    padding: 10px;
    }
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
    padding-left:10px;
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
                    }   
       
                    table, td, th {
            border: 1px solid black;
            }  
  
</style>

<script>
    function checklogin(){
    window.location.href = '{{route("index")}}'; 
    }
</script>
<?php
    if(Auth::check()){
        $status = Auth::user()->status;
        $id_user = Auth::user()->PERSON_ID;   
    }else{
        
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    } 
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);

  
    use App\Http\Controllers\ManagerwarehouseController;
?>
<?php
    function RemoveDateThai($strDate)
    {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    }
    function Removeformate($strDate)
    {
    $strYear = date("Y",strtotime($strDate));
    $strMonth= date("m",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    
    return $strDay."/".$strMonth."/".$strYear;
    }
    
    function Removeformatetime($strtime)
    {
    $H = substr($strtime,0,5);
    return $H;
    }  

    
?>          
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  style="text-align: left;">
             
               
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>คลังย่อย >> รายการรับเข้าพัสดุ :: {{$warehousetreasury->TREASURY_CODE}}  {{$warehousetreasury->TREASURY_NAME}}</B></h3>
                <div align="right">

<a href="{{ url('manager_warehouse/treasury') }}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ย้อนกลับ</a>
</div>
            </div>
            <div class="block-content ">

              
         
                       

                            <div class="block block-rounded block-bordered">
                               
                                <div class="block-content tab-content">  
                                    <div class="row">                                      
                                        <div class="col-md-2">
                                            
                                                <h5 style="font-family: 'Kanit', sans-serif;">รายการรับเข้าพัสดุ</h3>
                                        </div>
                                        <div class="col-md-7">
                                        </div>  
                                        <div class="col-md-3"> 
                                                        
                                            มูลค่าคงเหลือรวม {{ number_format(ManagerwarehouseController::sumvaluetreasury($idtreasury),5)}} บาท                   
                                        </div>
                                    </div>                  
                                                                    
                                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                        <thead style="background-color: #E6E6FA;">
                                            <tr height="40">
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" width="5%">ลำดับ</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >วันที่รับ</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >ประเภท</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >รายการ</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >ล็อต</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >รับเข้า</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >จ่ายออก</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >จำนวนคงเหลือ</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >หน่วย</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >ราคาต่อหน่วย</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >มูลค่า</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >Exp</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >หน่วยงาน</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >ผู้รับ</th>
                                            </tr >
                                        </thead>
                                        <tbody>
                                                        
                                        <?php $number=1; ?>
                                        @foreach ($storereceivesubs as $storereceivesub)

                                        <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font text-pedding" >{{DateThai($storereceivesub->created_at)}}</td>
                                        <td class="text-font text-pedding" >{{$storereceivesub->CYCLE_DISBURSE_NAME}}</td>
                                        <td class="text-font text-pedding" >{{$storereceivesub->TREASURY_RECEIVE_SUB_NAME}}</td>
                                        <td class="text-font text-pedding" >{{$storereceivesub->TREASURY_RECEIVE_SUB_LOT}}</td>
                                        <td class="text-font text-pedding" align="center">{{$storereceivesub->TREASURY_RECEIVE_SUB_AMOUNT}}</td>
                                        <td class="text-font text-pedding" align="center"></td>
                                        <td class="text-font text-pedding" align="center"></td>
                                        <td class="text-font text-pedding" >{{$storereceivesub->SUP_UNIT_NAME}}</td>
                                        <td class="text-font text-pedding" style="text-align: right;">{{number_format($storereceivesub->TREASURY_RECEIVE_SUB_PICE_UNIT,5)}}</td>
                                        <td class="text-font text-pedding" style="text-align: right;" >{{number_format($storereceivesub->TREASURY_RECEIVE_SUB_AMOUNT * $storereceivesub->TREASURY_RECEIVE_SUB_PICE_UNIT,5)}}</td>
                                        <td class="text-font text-pedding" >{{DateThai($storereceivesub->TREASURY_RECEIVE_SUB_EXP_DATE)}}</td>
                                        <td class="text-font text-pedding" >{{$storereceivesub->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                        <td class="text-font text-pedding" >{{$storereceivesub->WAREHOUSE_SAVE_HR_NAME}}</td>
                                        </tr>

                                        <?php $number++; ?>
                                        @endforeach  
                                    
                                    </tbody>
                                </table>
                                <br>
                            </div>

                           <hr>
                            
                            <div class="block-content tab-content">
                                <div class="tab-pane active" id="object2" role="tabpanel">

                                    <div class="row">                                      
                                        <div class="col-md-2">
                                         
                                                <h5 style="font-family: 'Kanit', sans-serif;">รายการเบิกจ่ายวัสดุ</h3>
                                        </div>
                                    <div class="col-md-7">
                                    </div>  
                                    <div class="col-md-3"> 
                                                    
                                        มูลค่าคงเหลือรวม {{ number_format(ManagerwarehouseController::sumvaluetreasury($idtreasury),5)}} บาท                   
                                    </div>
                                </div>  
                               
                                                
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                    <thead style="background-color: #FFF0F5;">
                                    
                                        <tr height="40">
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" width="5%">ลำดับ</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >วันที่จ่าย</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >รหัสจ่าย</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >ประเภท</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >รายการ</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >ล็อต</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >หน่วยงาน</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >จ่ายออก</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >หน่วย</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >ราคาต่อหน่วย</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >มูลค่า</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >Exp</th>
                                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" >ผู้รับ</th>
                                    
                                        </tr >
                                    </thead>
                                    <tbody>
                                
                                        <?php $number=1; ?>
                                        @foreach ($storeexportsubs as $storeexportsub)

                                        <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font text-pedding" >{{DateThai($storeexportsub->created_at)}}</td>
                                        <td class="text-font text-pedding" >{{$storeexportsub->TREASURY_EXPORT_SUB_TYPE}}</td>
                                        <td class="text-font text-pedding" >{{$storeexportsub->TREASURY_EXPORT_SUB_NAME}}</td>
                                        <td class="text-font text-pedding" >{{$storeexportsub->TREASURY_EXPORT_SUB_LOT}}</td>
                                        <td class="text-font text-pedding" >{{$storeexportsub->TREASURY_EXPORT_SUB_AMOUNT}}</td>
                                        <td class="text-font text-pedding" ></td>
                                        <td class="text-font text-pedding" ></td>
                                        <td class="text-font text-pedding" ></td>
                                        <td class="text-font text-pedding" style="text-align: right;">{{$storeexportsub->TREASURY_EXPORT_SUB_PICE_UNIT}}</td>
                                        <td class="text-font text-pedding" style="text-align: right;" >{{number_format($storeexportsub->TREASURY_EXPORT_SUB_AMOUNT * $storeexportsub->TREASURY_EXPORT_SUB_PICE_UNIT,5)}}</td>
                                        <td class="text-font text-pedding" >{{DateThai($storeexportsub->TREASURY_EXPORT_SUB_EXP_DATE)}}</td>
                                        <td class="text-font text-pedding" ></td>
                                
                                        </tr>

                                        <?php $number++; ?>
                                        @endforeach  
                            
                                    
                                

                                    </tbody>
                                </table>
                                <br>

                            </div>

                          


               
             

  
@endsection

@section('footer')
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });
    </script>
@endsection