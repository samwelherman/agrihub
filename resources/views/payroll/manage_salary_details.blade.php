@extends('layouts.master')


@section('content')
<?php
if(!empty( $data)){
$salary_grade_info = $data['salary_grade_info'];
$employee_info = $data['employee_info'];
$salary_grade = $data['salary_grade'];
}

?>
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">

                        <strong>Manage Salary</strong>

                    </div>
                    <form id="form" role="form" enctype="multipart/form-data"
                        action="{{url('payroll/manage_salary_details')}}" method="post"
                        class="form-horizontal form-groups-bordered">
                        @csrf
                        <div class="panel-body">
                            <div class="form-group ">
                                <label for="field-1" class="col-3 col-sm-3 col-lg-3 control-label">Select Departments
                                    <span class="required">
                                        *</span></label>

                                <div class="col-12 col-sm-5 col-lg-5">
                                    <select name="departments_id" class="form-control select_box" required>
                                        <option value="">Select Departments</option>
                                        <option value="1">HR</option>
                                        <?php if (!empty($all_department_info)): foreach ($all_department_info as $v_department_info) :
                                                        if (!empty($v_department_info->deptname)) {
                                                            $deptname = $v_department_info->deptname;
                                                        } else {
                                                            $deptname = "Undefined Department";
                                                        }
                                                        ?>
                                        <option value="<?php echo $v_department_info->departments_id; ?>" <?php
                                                            if (!empty($departments_id)) {
                                                                echo $v_department_info->departments_id == $departments_id ? 'selected' : '';
                                                            }
                                                            ?>><?php echo $deptname ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-2 col-sm-2 col-lg-2">
                                    <button type="submit" id="sbtn" value="1" name="flag" class="btn btn-primary">Go
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="panel-body">
                        <form id="form_validation" role="form" enctype="multipart/form-data"
                            action="{{url('payroll/save_salary_details')}}" method="post"
                            class="form-horizontal form-groups-bordered">
                            @csrf
                            <?php if (!empty($data['flag'])): ?>
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>


                                        <th>Monthly</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($employee_info)):foreach ($employee_info as $key => $v_emp_info): ?>
                                    <?php if (!empty($v_emp_info)):foreach ($v_emp_info as $v_employee): ?>
                                    <tr>
                                        <td><input type="hidden" name="user_id[]"
                                                value="<?php echo $v_employee->user_id ?>">
                                            <?php echo $v_employee->full_name; ?>
                                        </td>


                                        <td style="width: 25%">

                                            <!-- /****** Monthly Payment Details  *********/ -->
                                            <div class="pull-left">
                                                <div class="checkbox-inline c-checkbox">
                                                    <label class="needsclick">
                                                        <input name="monthly_status[]"
                                                            id="<?php echo $v_employee->user_id ?>" type="checkbox" <?php
                                                foreach ($salary_grade_info as $v_grade_salary_info) {
                                                    foreach ($v_grade_salary_info as $v_gsalary_info) {
                                                        if (!empty($v_gsalary_info)) {
                                                            if ($v_employee->user_id == $v_gsalary_info->user_id) {
                                                                echo $v_gsalary_info->salary_template_id ? 'checked ' : '';
                                                            }
                                                        }
                                                    }
                                                }
                                                ?> value="<?php echo $v_employee->user_id ?>" style="margin-left: 8px;"
                                                            class="child_absent">
                                                        <span class="fa fa-check"></span>
                                                    </label>
                                                </div>
                                                <div id="l_category" class="pull-right">
                                                    <select name="salary_template_id[]" class="form-control select_box">
                                                        <option value="">Select Monthly Grade</option>
                                                        <?php if (!empty($salary_grade)) : foreach ($salary_grade as $v_salary_info) : ?>
                                                        <option value="<?php echo $v_salary_info->salary_template_id ?>" <?php
                                                    foreach ($salary_grade_info as $v_grade_salary_info) {
                                                        foreach ($v_grade_salary_info as $v_gsalary_info) {
                                                            if (!empty($v_gsalary_info)) {
                                                                if ($v_employee->user_id == $v_gsalary_info->user_id) {
                                                                    echo $v_salary_info->salary_template_id == $v_gsalary_info->salary_template_id ? 'selected ' : '';
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>>
                                                            <?php echo $v_salary_info->salary_grade ?></option>;
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div><!-- /****** Monthly Payment Details  *********/ -->
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php endif; ?>
                                    <?php if (empty($employee_info[0])) { ?>
                                    <tr>
                                        <td>
                                            Nothing To Display
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php if (!empty($employee_info[0])) { ?>
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4 row mt-lg pull-right">
                                <button id="salery_btn" type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                            <?php } ?>


                            <!-- Hidden value when update  Start-->
                            <input type="hidden" name="departments_id" value="<?php echo $data['departments_id'] ?>" />
                            <?php
                                 if (!empty($salary_grade_info)) {
                                     foreach ($salary_grade_info as $v_grade_salary_info) {
                    foreach ($v_grade_salary_info as $v_gsalary_info) {
                     
                                             if (!empty($v_gsalary_info)) {
                            ?>
                            <input type="hidden" name="payroll_id[]"
                                value="<?php echo $v_gsalary_info->payroll_id ?>" />
                            <?php
                                                                  }
                                         }
                    }
                                 }
                                 ?>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="panel panel-custom">


    </div>
    @endsection

    @section('scripts')

    <script type="text/javascript">
    $(document).ready(function() {
        $(':checkbox').on('change', function() {
            var th = $(this),
                id = th.prop('id');
            if (th.is(':checked')) {
                $(':checkbox[id="' + id + '"]').not($(this)).prop('checked', false);
            }
        });
    });
    </script>
    @endsection