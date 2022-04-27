<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll\SalaryAllowance;
use App\Models\Payroll\SalaryDeduction;
use App\Models\Payroll\SalaryTemplate;
use App\Models\Payroll\EmployeePayroll;
use App\Models\UserDetails\BasicDetails;
use Yajra\DataTables\DataTables;

class ManageSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('payroll.manage_salary_details');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = EmployeePayroll::all();

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
                    ->editColumn('emp_id', function ($row) {
                        $result = BasicDetails::all()->where('user_id',$row->user_id)->first();
                        $emp_id = $result->emp_id;
                        return $emp_id;
                   })
                   ->editColumn('full_name', function ($row) {
                    $result = BasicDetails::all()->where('user_id',$row->user_id)->first();
                    $full_name = $result->full_name;
                    return $full_name;
                    })
                    ->editColumn('salary_type', function ($row) {
                        $grade = null;
                        $result = SalaryTemplate::where('salary_template_id',$row->salary_template_id)->first();
                        
                        $grade = $result->salary_grade;
                        if (!empty($grade)) {
                            $grade = $grade . '<small>(monthly)</small>';
                        } 
                        return $grade;
                        })
                        ->editColumn('basic_salary', function ($row) {
                            $basic_salary = null;
                            $result = SalaryTemplate::where('salary_template_id',$row->salary_template_id)->first();
                            
                            $basic_salary = $result->basic_salary;
                            if (!empty($basic_salary)) {
                                $grade = $basic_salary. ' Tsh';
                            } 
                            return $grade;
                            })
                        
                    ->editColumn('overtime_salary', function ($row) {
                        $result = SalaryTemplate::where('salary_template_id',$row->salary_template_id)->first();
                        $overtime_salary = $result->overtime_salary;
                        if (!empty($overtime_salary)) {
                            $overtime_salary = $overtime_salary. ' Tsh';
                        } else {
                            $overtime_salary = 0;
                        }
                        return $overtime_salary;
                   })
 
                   ->rawColumns(['action','salary_type','overtime_salary','basic_salary'])
                    ->make(true);
        }

        return view('payroll.employee_salary_list');
    }

    public function getDetails(Request $request,$departments_id = null){
        //$data['title'] = lang('manage_salary_details');
        // retrive all data from department table
        //$data['all_department_info'] = $this->db->get('tbl_departments')->result();

        $flag = $request->flag;
        if (!empty($flag) || !empty($departments_id)) { // check employee id is empty or not
            $data['flag'] = 1;
            if (!empty($departments_id)) {
                $data['departments_id'] = $departments_id;
            } else {
                $data['departments_id'] = $request->departments_id;
            }
            // get all designation info by Department id
            //$designation_info = $this->db->where('departments_id', $data['departments_id'])->get('tbl_designations')->result();

            if (!empty($data['departments_id'])) {
              
                    $data['employee_info'][] = BasicDetails::all()->where('departments_id',$data['departments_id']);
                    $employee_info = BasicDetails::all()->where('departments_id',$data['departments_id']);
                    foreach ($employee_info as $value) {
                        // get all salary Template info
                        $data['salary_grade_info'][] = EmployeePayroll::all()->where('user_id', $value->user_id);
                    }
                
            }
            // get all Hourly payment info
           // $data['hourly_grade'] = $this->db->get('tbl_hourly_rate')->result();
            // get all salary Template info
            $data['salary_grade'] = SalaryTemplate::all();
        }

       return view('payroll.manage_salary_details',compact('data'));
       
    }
    public function save_salary_details(Request $request)
    {
        // inout data to salate template
        $user_id = $request->user_id;

      
     

        $monthly_status = $request->monthly_status;
        $salary_template_id = $request->salary_template_id;
        $payroll_id = $request->payroll_id;
        foreach ($user_id as $key => $v_emp_id) {
            $data['user_id'] = $v_emp_id;
            $data['salary_template_id'] = NULL;
            

            if (!empty($monthly_status)) {
                foreach ($monthly_status as $v_monthly) {
                    if ($v_emp_id == $v_monthly) {
                        $data['salary_template_id'] = $salary_template_id[$key];
                       
                    }
                }
            }
            // save into tbl employee payroll
           
            if (!empty($payroll_id[$key])) {

                $id = $payroll_id[$key];
                EmployeePayroll::where('payroll_id',$id)->update($data);
                
            } else {
                $result = EmployeePayroll::create($data);
                $id = $result->id;
            }
        }
        $departments_id = $request->departments_id;
        //$dept_info = $this->db->where('departments_id', $departments_id)->get('tbl_departments')->row();
        // save into activities

   

     
        return redirect(route('manage_salary.create'));
    }

    public function employee_salary_list()
    {
        // $data['title'] = lang('employee_salary_details');
        // $data['subview'] = $this->load->view('admin/payroll/employee_salary_list', $data, TRUE);
        // $this->load->view('admin/_layout_main', $data);
         echo "hellow";
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
