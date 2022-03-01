<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use PhpParser\Node\Expr\Print_;
use Session;


class PageCheckID_Controller extends BaseController
{

    private function SubSRT($data)
    {
        $b_date = explode("-", $data);
        return $b_date[2] . $b_date[1] . $b_date[0];
    }

    public function Check_IDCard(Request $request)
    {
        try {

            $data = $request->all();
            $return_data = new \stdClass();

            $Check_Bdate = DB::table('dbo.PROSPECT_CUSTOMER')
                ->select('PROSPECT_CUSTOMER.TAX_ID', 'PROSPECT_CUSTOMER.BIRTHDAY')
                ->leftJoin('QUOTATION', 'QUOTATION.TAX_ID', '=', 'PROSPECT_CUSTOMER.TAX_ID')
                ->where('PROSPECT_CUSTOMER.TAX_ID', $data['id_card'])
                ->where([
                    ['QUOTATION.STATUS_ID', '!=', '30'],
                    ['QUOTATION.STATUS_ID', '!=', '40'],
                    ['QUOTATION.STATUS_ID', '!=', '42'],
                    ['QUOTATION.STATUS_ID', '!=', '49'],
                    ['QUOTATION.STATUS_ID', '!=', '53'],
                    ['QUOTATION.STATUS_ID', '!=', '54'],
                ])
                ->orderBy('PROSPECT_CUSTOMER.PST_CUST_ID', 'DESC')
                ->get();


            $Check_Bdate_NoQUOTATION = DB::table('dbo.PERSON')
                ->select('PERSON.APP_ID', 'BIRTHDAY', 'TAX_ID', 'FIRST_NAME', 'LAST_NAME')
                ->leftJoin('APPLICATION', 'PERSON.APP_ID', '=', 'APPLICATION.APP_ID')
                ->where('TAX_ID', $data['id_card'])
                ->where([
                    ['STATUS_ID', '!=', '30'],
                    ['STATUS_ID', '!=', '40'],
                    ['STATUS_ID', '!=', '42'],
                    ['STATUS_ID', '!=', '49'],
                    ['STATUS_ID', '!=', '53'],
                    ['STATUS_ID', '!=', '54'],
                ])
                ->orderBy('PERSON.APP_ID', 'DESC')
                ->get();

            if (!$Check_Bdate->isEmpty()) {
                $DataBdate = $Check_Bdate[0]->BIRTHDAY;
                $str_BDATE = $this->SubSRT($DataBdate);
                // dd($str_BDATE);
                if ($str_BDATE == $data['b_date']) {
                    $CS = DB::table('dbo.QUOTATION')
                        ->select('TAX_ID', 'QUOTATION_ID', 'CUSTOMER_NAME')
                        ->where('TAX_ID', $data['id_card'])
                        ->where([
                            ['STATUS_ID', '!=', '30'],
                            ['STATUS_ID', '!=', '40'],
                            ['STATUS_ID', '!=', '42'],
                            ['STATUS_ID', '!=', '49'],
                            ['STATUS_ID', '!=', '53'],
                            ['STATUS_ID', '!=', '54'],
                        ])
                        ->orderBy('QUOTATION_ID', 'DESC')
                        ->get();
                    // dd($CS);
                    $num = count($CS);
                    if ($num != 0) {
                        $CK_APP = [];
                        for ($i = 0; $i < $num; $i++) {
                            $PD = DB::table('dbo.APPLICATION')
                                ->select('APPLICATION.APP_ID', 'APPLICATION.QUOTATION_ID', 'APPLICATION.CUSTOMER_NAME', 'APPLICATION.CHECKER_RESULT', 'APPLICATION.STATUS_ID', 'CONTRACT.STATUS_ID')
                                ->leftJoin('CONTRACT', 'APPLICATION.APP_ID', '=', 'CONTRACT.APP_ID')
                                ->where('QUOTATION_ID', $CS[$i]->QUOTATION_ID)
                                ->where([
                                    ['APPLICATION.STATUS_ID', '!=', '30'],
                                    ['APPLICATION.STATUS_ID', '!=', '40'],
                                    ['APPLICATION.STATUS_ID', '!=', '42'],
                                    ['APPLICATION.STATUS_ID', '!=', '49'],
                                    ['APPLICATION.STATUS_ID', '!=', '53'],
                                    ['APPLICATION.STATUS_ID', '!=', '54'],
                                ])
                                // ->orWhere([
                                //     ['APPLICATION.QUOTATION_ID',$CS[$i]->QUOTATION_ID],
                                //     ['APPLICATION.STATUS_ID', '!=', '30'],
                                //     ['APPLICATION.STATUS_ID', '!=', '40'],
                                //     ['APPLICATION.STATUS_ID', '!=', '42'],
                                //     ['APPLICATION.STATUS_ID', '!=', '49'],
                                //     ['APPLICATION.STATUS_ID', '!=', '53'],
                                //     ['APPLICATION.STATUS_ID', '!=', '54'],
                                //     ['CONTRACT.STATUS_ID', '!=', '30'],
                                //     ['CONTRACT.STATUS_ID', '!=', '40'],
                                //     ['CONTRACT.STATUS_ID', '!=', '42'],
                                //     ['CONTRACT.STATUS_ID', '!=', '49'],
                                //     ['CONTRACT.STATUS_ID', '!=', '53'],
                                //     ['CONTRACT.STATUS_ID', '!=', '54'],
                                // ])
                                ->get();
                            // dd($PD);
                            $num_Check_contract = 0;        
                            if (!$PD->isEmpty()) {
                                $Check_contract = DB::table('dbo.CONTRACT')
                                    ->select('APP_ID', 'STATUS_ID')
                                    ->where('APP_ID', $PD[0]->APP_ID)
                                    ->where([
                                        ['STATUS_ID', '=', '30'],
                                        ['STATUS_ID', '=', '40'],
                                        ['STATUS_ID', '=', '42'],
                                        ['STATUS_ID', '=', '49'],
                                        ['STATUS_ID', '=', '53'],
                                        ['STATUS_ID', '=', '54'],
                                    ])
                                    ->get();
                                $num_Check_contract = count($Check_contract);
                            }
                            // dd($num_Check_contract);
                            
                            if (!$PD->isEmpty()  && $PD[0]->CHECKER_RESULT != 'Reject') {
                                if($num_Check_contract == 0){
                                    array_push($CK_APP, ['APP_ID' => $PD[0]->APP_ID, 'CHECKER_RESULT' => $PD[0]->CHECKER_RESULT]);
                                }
                            }

                            // $return_data = $PD;
                        }
                        // dd($CK_APP);
                        // 
                        // print_r($CK_APP);
                        // dd($CK_APP);
                        $CK_Approve = [];
                        $CK_Rework = [];
                        $CK_empty = [];
                        $CK_Reject = [];
                        if (count($CK_APP) > 1) {
                            for ($i = 0; $i <  count($CK_APP); $i++) {
                                // dd($CK_APP[$i]['CHECKER_RESULT']);
                                if ($CK_APP[$i]['CHECKER_RESULT']  != 'Reject' && $CK_APP[$i]['CHECKER_RESULT']  == 'Approve') {
                                    array_push($CK_Approve, $CK_APP[$i]['APP_ID']);
                                } else if ($CK_APP[$i]['CHECKER_RESULT']  != 'Reject' && $CK_APP[$i]['CHECKER_RESULT']  == 'Rework') {
                                    array_push($CK_Rework, $CK_APP[$i]['APP_ID']);
                                } else if ($CK_APP[$i]['CHECKER_RESULT']  != 'Reject') {
                                    array_push($CK_empty, $CK_APP[$i]['APP_ID']);
                                } else {
                                    array_push($CK_Reject, $CK_APP[$i]['APP_ID']);
                                }
                            }

                            if (count($CK_Approve) > 0) {
                                for ($i = 0; $i < count($CK_Approve); $i++) {
                                    $PD_Approve = DB::table('dbo.APPLICATION')
                                        ->select('APPLICATION.APP_ID', 'APPLICATION.QUOTATION_ID', 'APPLICATION.CUSTOMER_NAME', 'CONTRACT.STATUS_ID')
                                        ->leftJoin('CONTRACT', 'APPLICATION.APP_ID', '=', 'CONTRACT.APP_ID')
                                        ->where('APPLICATION.APP_ID', $CK_Approve[$i])
                                        ->get();
                                    // var_dump($PD_Approve);
                                    if ($PD_Approve[0]->STATUS_ID != '30' && $PD_Approve[0]->STATUS_ID != '40' && $PD_Approve[0]->STATUS_ID != '53' && $PD_Approve[0]->STATUS_ID != '54') {
                                        // $return_data = $PD_Approve;
                                        // dd($PD_Approve[0]->APP_ID);
                                        $PD = DB::table('dbo.APPLICATION')
                                            ->select('APP_ID', 'QUOTATION_ID', 'CUSTOMER_NAME', 'CHECKER_RESULT')
                                            ->where('APP_ID', $PD_Approve[0]->APP_ID)
                                            ->get();
                                        $return_data = $PD;
                                    }
                                }
                            } else if (count($CK_Rework) > 0) {
                                $PD = DB::table('dbo.APPLICATION')
                                    ->select('APP_ID', 'QUOTATION_ID', 'CUSTOMER_NAME', 'CHECKER_RESULT')
                                    ->where('APP_ID', $CK_Rework[0])
                                    ->get();
                                $return_data = $PD;
                            } else if (count($CK_empty) > 0) {
                                $PD = DB::table('dbo.APPLICATION')
                                    ->select('APP_ID', 'QUOTATION_ID', 'CUSTOMER_NAME', 'CHECKER_RESULT')
                                    ->where('APP_ID', $CK_empty[0])
                                    ->get();
                                $return_data = $PD;
                            }
                        } else if (count($CK_APP) == 1) {
                            // dd($CK_APP[0]['APP_ID']);
                            $PD = DB::table('dbo.APPLICATION')
                                ->select('APP_ID', 'QUOTATION_ID', 'CUSTOMER_NAME', 'CHECKER_RESULT')
                                ->where('APP_ID', $CK_APP[0]['APP_ID'])
                                ->get();
                            $return_data = $PD;
                            // $return_data = $CK_APP[0];
                        }
                    }
                    // dd($return_data);
                    // dd('ff');
                    if ((count((array)$return_data)) != 0) {
                        return $return_data;
                    } else {
                        return $CS;
                    }
                } else {
                    return 'Invalid';
                }
            } else if (!$Check_Bdate_NoQUOTATION->isEmpty()) {
                $DataBdate = $Check_Bdate_NoQUOTATION[0]->BIRTHDAY;
                $str_BDATE = $this->SubSRT($DataBdate);
                // dd($str_BDATE.'=='. $data['b_date']);
                if ($str_BDATE == $data['b_date']) {
                    $return_data =  $Check_Bdate_NoQUOTATION;
                    return $return_data;
                } else {
                    return 'Invalid';
                }
            } else {
                return 'NoData';
            }
        } catch (Exception $e) {
            return response()->json(array('message' => $e->getMessage()));
        }
    }
}
