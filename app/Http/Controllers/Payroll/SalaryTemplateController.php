<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll\SalaryAllowance;
use App\Models\Payroll\SalaryDeduction;
use App\Models\Payroll\SalaryTemplate;
use Yajra\DataTables\DataTables;

class SalaryTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SalaryTemplate::all();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        return '<button type="button" class="btn btn-xs btn-outline-info"
                        data-toggle="modal" data-target="#appFormModal" onclick="model("'.$row->id.'","edit")"
                        data-id="' . $row->id . '" data-type="edit">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-xs btn-outline-danger" onclick="deleteContract(this)"
                        data-url="' . $row->id. '">
                        <i class="fa fa-trash"></i>
                    </button>';
                    })
        
                    ->editColumn('water_volume', function ($row) {
                        return $row->harvest_volume.' Litre';
                   })
                //     ->editColumn('harvest_volume', function ($row) {
                //         return $row->harvest_volume.' kg';
                //    })
                   ->rawColumns(['action'])
                    ->make(true);
        }
        $active = 1;
        return view('payroll/salary_template',compact('active'));
        //
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
        //
       
        $template_data['salary_grade'] = $request->salary_grade;
        $template_data['basic_salary'] = $request->basic_salary;
        $template_data['overtime_salary'] = $request->overtime_salary;
        $template_data['user_id'] = auth()->user()->id;

       ;
        
// inout data to salate template
           // $template_data = $this->payroll_model->array_from_post(array('salary_grade', 'basic_salary', 'overtime_salary'));
// ************* Save into tbl_salary_template *************
           if(!empty($id))
           $salary_template_id1 = SalaryTemplate::where('salary_template_id',$id)->update($template_data);
           else
           $salary_template_id1 = SalaryTemplate::create($template_data);
           $salary_template_id = $salary_template_id1->id;

           

            // inout data salary_allowance information
            // Input data defualt salary_allowance
            $house_rent_allowance = $request->house_rent_allowance;
            $medical_allowance = $request->medical_allowance;
            // check defualt salary_allowance empty or not
            if (!empty($house_rent_allowance)) {
                $asalary_allowance_data['allowance_label'][] = 'House Rent Allowance';
                $asalary_allowance_data['allowance_value'][] = $house_rent_allowance;
            }
            if (!empty($medical_allowance)) {
                $asalary_allowance_data['allowance_label'][] = 'Medical Allowance';
                $asalary_allowance_data['allowance_value'][] = $medical_allowance;
            }
// check salary_allowance data empty or not 
// if not empty then save into table
            if (!empty($asalary_allowance_data['allowance_label'])) {
                foreach ($asalary_allowance_data['allowance_label'] as $hkey => $h_salary_allowance_label) {
                    $alsalary_allowance_data['salary_template_id'] = $salary_template_id;
                    $alsalary_allowance_data['allowance_label'] = $h_salary_allowance_label;
                    $alsalary_allowance_data['allowance_value'] = $asalary_allowance_data['allowance_value'][$hkey];
                    $alsalary_allowance_data['user_id'] = auth()->user()->id;
// *********** save defualt value into tbl_salary_allowance    *******************
                $salary_allowance = SalaryAllowance::create($alsalary_allowance_data);
                }
            }
            // save add more value into tbl_salary_allowance
            $salary_allowance_label = $request->allowance_label;
            $salary_allowance_value = $request->allowance_value;
            // input id for update
            $salary_allowance_id = $request->salary_allowance_id;
            
            //$salary_allowance = get_any_field('tbl_salary_allowance', array('salary_template_id' => $salary_template_id), 'salary_allowance_id', true);
            $salary_allowance1 = SalaryAllowance::all()->where('salary_template_id',$salary_template_id)->last();
            
            
            // if (!empty($salary_allowance1)) {
            //     $salary_allowance = $salary_allowance1->salary_allowance_id;
            //     $salary_allowance = array_column($salary_allowance, 'salary_allowance_id');
            //     if (!empty($salary_allowance)) {
            //         $delete_salary_allowance_id = array_diff($salary_allowance, $salary_allowance_id);
            //         if (!empty($delete_salary_allowance_id)) {
            //             foreach ($delete_salary_allowance_id as $deleted_id) {
            //                 // $this->payroll_model->_table_name = "tbl_salary_allowance"; // table name
            //                 // $this->payroll_model->_primary_key = "salary_allowance_id"; // $id
            //                 // $this->payroll_model->delete($deleted_id);
            //                 $salaryAllowance = SalaryAllowance::find($deleted_id);
            //                 $salaryAllowance->delete();

            //             }
            //         }

            //     }
            // }
            if (!empty($salary_allowance_label)) {
                foreach ($salary_allowance_label as $key => $v_salary_allowance_label) {
                    if (!empty($salary_allowance_value[$key])) {
                        $salary_allowance_data['salary_template_id'] = $salary_template_id;
                        $salary_allowance_data['allowance_label'] = $v_salary_allowance_label;
                        $salary_allowance_data['allowance_value'] = $salary_allowance_value[$key];
// *********** save add more value into tbl_salary_allowance    *******************
                        
                        // $this->payroll_model->_table_name = "tbl_salary_allowance"; // table name
                        // $this->payroll_model->_primary_key = "salary_allowance_id"; // $id
                        if (!empty($salary_allowance_id[$key])) {
                            
                            $allowance_id = $salary_allowance_id[$key];
                            SalaryAllowance::where('salary_allowance_id',$allowance_id)->update($salary_allowance_data);
                            //$this->payroll_model->save($salary_allowance_data, $allowance_id);
                        } else {
                            SalaryAllowance::create($salary_allowance_data);
                            //$this->payroll_model->save($salary_allowance_data);
                        }
                    }
                }
            }
// inout data Deduction information
// Input data defualt salary_allowance
            $provident_fund = $request->provident_fund;
            $tax_deduction = $request->tax_deduction;
// check defualt Deduction empty or not
            if (!empty($provident_fund)) {
                $ddeduction_data['deduction_label'][] = 'Provident Fund';
                $ddeduction_data['deduction_value'][] = $provident_fund;
            }
            if (!empty($tax_deduction)) {
                $ddeduction_data['deduction_label'][] = 'Tax Deduction';
                $ddeduction_data['deduction_value'][] = $tax_deduction;
            }
            if (!empty($ddeduction_data['deduction_label'])) {
                foreach ($ddeduction_data['deduction_label'] as $dkey => $d_deduction_label) {
                    $adeduction_data['salary_template_id'] = $salary_template_id;
                    $adeduction_data['deduction_label'] = $d_deduction_label;
                    $adeduction_data['deduction_value'] = $ddeduction_data['deduction_value'][$dkey];
                    $adeduction_data['user_id'] = auth()->user()->id;

// *********** save defualt value into tbl_salary_allowance    *******************
                    //$this->payroll_model->_table_name = "tbl_salary_deduction"; // table name
                    //$this->payroll_model->_primary_key = "salary_deduction_id"; // $id
                    //$this->payroll_model->save($adeduction_data);
                    SalaryDeduction::create($adeduction_data);
                }
            }
// check Deduction data empty or not
// if not empty then save into table

// input salary deduction id for update
            $salary_deduction_id = $request->salary_deduction_id;
// save add more value into tbl_deduction
            $deduction_label = $request->deduction_label;
            $deduction_value = $request->deduction_value;

            //$salary_deduction = get_any_field('tbl_salary_deduction', array('salary_template_id' => $salary_template_id), 'salary_deduction_id', true);
            $salary_deduction1 = SalaryDeduction::all()->where('salary_template_id',$salary_template_id)->last();
            // if (!empty($salary_deduction)) {
            //     $salary_deduction = $salary_deduction1->salary_deduction_id;
            //     $salary_deduction = array_column($salary_deduction, 'salary_deduction_id');
            //     if (!empty($salary_deduction)) {

            //         $delete_salary_deduction_id = array_diff($salary_deduction, $salary_deduction_id);
            //         if (!empty($delete_salary_deduction_id)) {
            //             foreach ($delete_salary_deduction_id as $deleted_id) {
            //                 // $this->payroll_model->_table_name = "tbl_salary_deduction"; // table name
            //                 // $this->payroll_model->_primary_key = "salary_deduction_id"; // $id
            //                 // $this->payroll_model->delete($deleted_id);
            //                 $salaryDeduction = SalaryDeduction::find($deleted_id);
            //                 $salaryDeducyion->delete();
            //             }
            //         }

            //     }
            // }

            if (!empty($deduction_label)) {
                foreach ($deduction_label as $key => $v_deduction_label) {
                    if (!empty($deduction_value[$key])) {

                        $deduction_data['salary_template_id'] = $salary_template_id;
                        $deduction_data['deduction_label'] = $v_deduction_label;
                        $deduction_data['deduction_value'] = $deduction_value[$key];
// *********** save add more value into tbl_deductio    *******************
                        // $this->payroll_model->_table_name = "tbl_salary_deduction"; // table name
                        // $this->payroll_model->_primary_key = "salary_deduction_id"; // $id

                        if (!empty($salary_deduction_id[$key])) {
                            $deduction_id = $salary_deduction_id[$key];
                            SalaryDeduction::where('salary_deduction_id',$deduction_id)->update($deduction_data);
                            //$this->payroll_model->save($deduction_data, $deduction_id);
                        } else {
                            //$this->payroll_model->save($deduction_data);
                            SalaryDeduction::create($deduction_data);
                        }
                    }
                }
            }
            // if (!empty($id)) {
            //     $activity = 'activity_salary_template_update';
            //     $msg = lang('salary_template_update');
            // } else {
            //     $activity = 'activity_salary_template_added';
            //     $msg = lang('salary_template_added');
            // }
            // save into activities
     
            // Update into tbl_project
           

         
        return redirect(route('salary_template.index'));
        //redirect('admin/payroll/salary_template');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
