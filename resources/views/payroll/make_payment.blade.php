@extends('layouts.master')


@section('content')
<?php
if(!empty($data)){
    $flag = $data['flag'];
    $employee_info = $data['employee_info'];
    $payment_month = $data['payment_month'];
    $payment_flag = $data['payment_flag'];
    

}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <!-- *********     Employee Search Panel ***************** -->
            <div class="card-header">
                <h4>Make Payment</h4>
            </div>

            <form id="form" role="form" enctype="multipart/form-data" action="{{route('make_payment.store')}}"
                method="post" class="form-horizontal form-groups-bordered">
                @csrf
                <div class="card-body">
                    <div class="form-group offset-3">
                        <label for="field-1" class="col-sm-3 control-label">Select Department <span class="required">
                                *</span></label>

                        <div class="col-sm-5">
                            <select required name="departments_id" class="form-control select_box">
                                <option value="">Select Department </option>
                                <?php if (!empty($all_department_info)): foreach ($all_department_info as $v_department_info) :
                                    if (!empty($v_department_info->deptname)) {
                                        $deptname = $v_department_info->deptname;
                                    } else {
                                        $deptname = "Undifined Department";
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
                    </div>
                    <div class="form-group offset-3">
                        <label class="col-sm-3 control-label">Select Month <span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input required type="month" value="<?php
                                if (!empty($payment_month)) {
                                    echo $payment_month;
                                }
                                ?>" class="form-control monthyear" name="payment_month" data-format="yyyy/mm/dd">

                                <div class="input-group-addon">
                                    <a href="#"><i class="fa fa-calendar"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group offset-3" id="border-none">
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-5">
                            <button id="submit" type="submit" name="flag" value="1" class="btn btn-primary btn-block">Go
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- ******************** Employee Search Panel Ends ******************** -->
        <?php if (!empty($flag)): ?>

        <div class="card">
            <div class="card-header">

                <span>
                    <strong>Payment Info for<?php
                                        if (!empty($payment_month)) {
                                            echo ' <span class="text-danger">' . date('F Y', strtotime($payment_month)) . '</span>';
                                        }
                                        ?></strong>
                </span>

            </div>
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped " id="datatable_action" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="col-sm-1">Emp Id</th>
                            <th><strong>Name</strong></th>
                            <th><strong>Salary Type</strong></th>
                            <th><strong>Basic Salary</strong></th>
                            <th><strong>Net Salary</strong></th>
                            <th><strong>Details</strong></th>
                            <th><strong>Status</strong></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $akey = 0;
                    if (!empty($employee_info)):foreach ($employee_info as $v_emp_info):
                        ?>
                        <?php if (!empty($v_emp_info)):
                        $akey += count($v_emp_info);
                        $key = $akey - 1;
                        foreach ($v_emp_info as $v_employee): ?>
                        <tr>
                            <td><?php echo $v_employee->emp_id; ?></td>
                            <td>
                                <?php if (!empty($salary_info) && $salary_info->user_id == $v_employee->user_id) { ?>
                                <a href="admin/payroll/salary_payment_details/<?php echo $salary_info->salary_payment_id ?>"
                                    title="View" data-toggle="modal"
                                    data-target="#myModal_lg"><?php echo $v_employee->fullname; ?></a>
                                <?php } else { ?>
                                <a href="admin/payroll/view_payment_details/<?php echo $v_employee->user_id . '/' . $payment_month ?>"
                                    title="View" data-toggle="modal"
                                    data-target="#myModal_lg"><?php echo $v_employee->full_name; ?></a>
                                <?php } ?>

                            </td>
                            <td><?php
                                    $set_salary = false;
                                    if (!empty($v_employee->salary_grade)) {
                                        echo $v_employee->salary_grade . ' <small>monthly</small>';
                                    } else if (!empty($v_employee->hourly_grade)) {
                                        echo $v_employee->hourly_grade . ' <small>(hourly)</small>';
                                    } else {
                                        echo '<span class="text-danger">did not set salary yet</span>';
                                        $set_salary = true;
                                    }
                                    ?></td>
                            <td><?php
                                    if (!empty($v_employee->basic_salary)) {
                                        echo $v_employee->basic_salary;
                                    } else if (!empty($v_employee->hourly_grade)) {
                                        echo $v_employee->hourly_rate . ' <small>(per_hour)</small>';
                                    } else {
                                        echo '-';
                                    }
                                    ?></td>
                            <td><?php
                                    if (!empty($total_hours)) {
                                        foreach ($total_hours as $index => $v_total_hours) {
                                            if ($index == $v_employee->user_id) {
                                                if (!empty($v_total_hours)) {
                                                    $total_hour = $v_total_hours['total_hours'];
                                                    $total_minutes = $v_total_hours['total_minutes'];
                                                    if ($total_hour > 0) {
                                                        $hours_ammount = $total_hour * $v_employee->hourly_rate;
                                                    } else {
                                                        $hours_ammount = 0;
                                                    }
                                                    if ($total_minutes > 0) {
                                                        $amount = round($v_employee->hourly_rate / 60, 2);
                                                        $minutes_ammount = $total_minutes * $amount;
                                                    } else {
                                                        $minutes_ammount = 0;
                                                    }
                                                    if (!empty($advance_salary[$index])) {
                                                        $advance_amount = $advance_salary[$index]['advance_amount'];
                                                    } else {
                                                        $advance_amount = 0;
                                                    }
                                                    if (!empty($award_info[$index])) {
                                                        $total_award = $award_info[$index]['award_amount'];
                                                    } else {
                                                        $total_award = 0;
                                                    }
                                                    $total_amount = $hours_ammount + $minutes_ammount + $total_award - $advance_amount;
                                                    echo round($total_amount,2);
                                                }
                                            }
                                        }
                                    }
                                    if (!empty($v_employee->basic_salary)) {
                                        if (!empty($allowance_info)) {
                                            foreach ($allowance_info as $al_index => $v_allowance) {
                                                if ($al_index == $v_employee->user_id) {
                                                    $total_allowance = $v_allowance;
                                                }
                                            }
                                        }
                                        if (!empty($deduction_info)) {
                                            foreach ($deduction_info as $dd_index => $v_deduction) {
                                                if ($dd_index == $v_employee->user_id) {
                                                    $total_deduction = $v_deduction;
                                                }
                                            }
                                        }
                                        if (!empty($advance_salary)) {
                                            foreach ($advance_salary as $add_index => $v_advance) {
                                                if ($add_index == $v_employee->user_id) {
                                                    $total_advance = $v_advance['advance_amount'];
                                                }
                                            }
                                        }
                                        if (!empty($award_info)) {
                                            foreach ($award_info as $aw_index => $v_award_info) {
                                                if ($aw_index == $v_employee->user_id) {
                                                    $total_award = $v_award_info['award_amount'];
                                                }
                                            }
                                        }

                                        if (!empty($overtime_info) && !empty($v_employee->overtime_salary)) {
                                            foreach ($overtime_info as $over_index => $v_overtime) {
                                                if ($over_index == $v_employee->user_id) {
                                                    $total_hour = $v_overtime['overtime_hours'];
                                                    $total_minutes = $v_overtime['overtime_minutes'];
                                                    if ($total_hour > 0) {
                                                        $hours_ammount = $total_hour * $v_employee->overtime_salary;
                                                    } else {
                                                        $hours_ammount = 0;
                                                    }
                                                    if ($total_minutes > 0) {
                                                        $amount = round($v_employee->overtime_salary / 60, 2);
                                                        $minutes_ammount = $total_minutes * $amount;
                                                    } else {
                                                        $minutes_ammount = 0;
                                                    }
                                                    $total_amount = $hours_ammount + $minutes_ammount;
                                                }
                                            }
                                        }

                                        if (empty($total_advance)) {
                                            $total_advance = 0;
                                        }
                                        if (empty($total_deduction)) {
                                            $total_deduction = 0;
                                        }
                                        if (empty($total_award)) {
                                            $total_award = 0;
                                        }
                                        if (empty($total_allowance)) {
                                            $total_allowance = 0;
                                        }
                                        if (empty($total_amount)) {
                                            $total_amount = 0;
                                        }
                                        if (empty($v_employee->basic_salary)) {
                                            $basic_salary = 0;
                                        } else {
                                            $basic_salary = $v_employee->basic_salary;
                                        }

                                        $basic_salary + $total_allowance + $total_amount + $total_award - $total_deduction - $total_advance;
                                        // check existing payment by employee id and payment month
                                        echo $basic_salary; //sehemu ya kuonyesha net salary
                                    }
                                    //$salary_info = $this->payroll_model->check_by(array('user_id' => $v_employee->user_id, 'payment_month' => $payment_month), 'tbl_salary_payment');
                                    ?></td>
                            <td><?php if (!empty($salary_info) && $salary_info->user_id == $v_employee->user_id) { ?>
                                <a href="admin/payroll/salary_payment_details/<?php echo $salary_info->salary_payment_id ?>"
                                    class="btn btn-info btn-xs" title="View" data-toggle="modal"
                                    data-target="#myModal_lg"><span class="fa fa-list-alt"></span></a>
                                <?php } else { ?>
                                <a href="admin/payroll/view_payment_details/<?php echo $v_employee->user_id . '/' . $payment_month ?>"
                                    class="btn btn-info btn-xs" title="View" data-toggle="modal"
                                    data-target="#myModal_lg"><span class="fa fa-list-alt"></span></a>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if (!empty($salary_info) && $salary_info->user_id == $v_employee->user_id) { ?>
                                <span class="label label-success">paid</span>
                                <?php
                                    } else {
                                        if (empty($set_salary)) {
                                            ?>
                                <span class="label label-danger">unpaid</span>
                                <?php }
                                    } ?>
                            </td>
                            <td>
                                <?php if (!empty($salary_info) && $salary_info->user_id == $v_employee->user_id) { ?>
                                <a class="text-success" target="_blank"
                                    href="admin/payroll/receive_generated/<?php echo $salary_info->salary_payment_id; ?>">generate
                                    payslip</a>
                                <?php } else {
                                        if (!empty($set_salary)) {
                                            ?>
                                <a class="text-warning text-bold" target="_blank"
                                    href="admin/payroll/manage_salary_details/<?php echo $v_employee->departments_id; ?>">set
                                    slary</a>
                                <?php } else {
                                            ?>
                                <a class="text-danger"
                                    href="{{route('make_payment2.store',['user_id'=>$v_employee->user_id,'departments_id'=>$v_employee->departments_id,'payment_month'=>$payment_month])}}">make
                                    payment</a>
                                <?php }
                                    } ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <?php endif; ?>
        <?php
        if (!empty($payment_flag)):
        if (!empty($advance_salary)) {
            $advance_amount = $advance_salary['advance_amount'];
        } else {
            $advance_amount = 0;
        }
        if (!empty($total_hours)) {
            $total_hour = $total_hours['total_hours'];
            $total_minutes = $total_hours['total_minutes'];
            if ($total_hour > 0) {
                $hours_ammount = $total_hour * $employee_info->hourly_rate;
            } else {
                $hours_ammount = 0;
            }
            if ($total_minutes > 0) {
                $amount = round($employee_info->hourly_rate / 60, 2);
                $minutes_ammount = $total_minutes * $amount;
            } else {
                $minutes_ammount = 0;
            }
            $total_hours_amount = $hours_ammount + $minutes_ammount;
        }
        if (!empty($employee_info->basic_salary)) {
            if (empty($deduction_info)) {
                $deduction_info = 0;
            } else {
                $deduction_info = $deduction_info;
            }
            if (empty($allowance_info)) {
                $allowance_info = 0;
            } else {
                $allowance_info = $allowance_info;
            }
            if (!empty($overtime_info)) {
                $total_hour = $overtime_info['overtime_hours'];
                $total_minutes = $overtime_info['overtime_minutes'];
                if ($total_hour > 0) {
                    $hours_ammount = $total_hour * $employee_info->overtime_salary;
                } else {
                    $hours_ammount = 0;
                }
                if ($total_minutes > 0) {
                    $amount = round($employee_info->overtime_salary / 60, 2);
                    $minutes_ammount = $total_minutes * $amount;
                } else {
                    $minutes_ammount = 0;
                }
                $total_amount = $hours_ammount + $minutes_ammount + $allowance_info;
            }
        }
        if (empty($total_advance)) {
            $total_advance = 0;
        }
        if (empty($deduction_info)) {
            $deduction_info = 0;
        }
        if (empty($total_award)) {
            $total_award = 0;
        }
        if (empty($total_allowance)) {
            $total_allowance = 0;
        }
        if (empty($total_amount)) {
            $total_amount = 0;
        }
        if (empty($v_employee->basic_salary)) {
            $basic_salary = 0;
        } else {
            $basic_salary = $v_employee->basic_salary;
        }
        ?>
 <?php
            //   if (!empty($check_salary_payment->salary_payment_id)) {
            //       echo $check_salary_payment->salary_payment_id;
            //   }
              ?>
        <form role="form" data-parsley-validate="" novalidate="" enctype="multipart/form-data" action="{{route('get_payment.store')}}" method="post" class="form-horizontal form-groups-bordered">
        @csrf   
        <div class="row">
                <div class="col-lg-3" data-spy="scroll" data-offset="0">
                    <div class="row">

                        <div class="card">
                            <!-- Default panel contents -->
                            <div class="card-header">

                                <strong>payment for<?php
                                    echo ' <span class="text-danger">' . date('F Y', strtotime($payment_month)) . '</span>';
                                    ?></strong>

                            </div>
                            <div class="card-body">
                                <div class="">
                                    <label class="control-label">gross salary </label>
                                    <input type="text" name="house_rent_allowance" disabled value="<?php

                                if (!empty($total_hours_amount)) {
                                    echo $gross = round($total_hours_amount, 2);
                                    $deduction_info = 0;
                                } else {
                                    echo $gross = $employee_info->basic_salary + $total_amount;
                                }
                                ?>" class="salary form-control">
                                </div>
                                <div class="">
                                    <label class="control-label">total deduction</label>
                                    <input type="text" name="" disabled value="<?php
                                echo $deduction = $deduction_info + $advance_amount;
                                ?>" class="salary form-control">
                                </div>
                                <div class="">
                                    <label class="control-label">net salary</label>
                                    <input type="text" id="net_salary" name="other_allowance" disabled value="<?php
                                echo $net_salary = $gross - $deduction;
                                ?>" class="salary form-control">
                                </div>
                                <?php
                            $total_award = 0;
                            if (!empty($award_info)): foreach ($award_info as $v_award_info) :
                                ?>
                                <?php if (!empty($v_award_info->award_amount)): ?>
                                <div class="">
                                    <label class="control-label">award
                                        <small>( <?php echo $v_award_info->award_name; ?> )</small>
                                    </label>
                                    <input type="text" name="other_allowance" disabled id="award"
                                        value="<?php echo $v_award_info->award_amount; ?>" class="award form-control">
                                    <input type="hidden" name="award_name[]" id="award"
                                        value="<?php echo $total_award += $v_award_info->award_amount; ?>"
                                        class="form-control">
                                </div>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                <input type="hidden" name="total_award" id="total_award" value="" class="form-control">
                                <div class="">
                                    <label class="control-label">fine deduction </label>
                                    <input type="text" data-parsley-type="number" name="fine_deduction"
                                        id="fine_deduction" value="<?php
                                       if (!empty($check_salary_payment->fine_deduction)) {
                                           echo $check_salary_payment->fine_deduction;
                                       }
                                       ?>" class="form-control">
                                </div>
                                <div class="">
                                    <label class="control-label"><strong>payment amount </strong></label>
                                    <input type="text" disabled="" value="<?php echo $net_salary + $total_award; ?>"
                                        class="payment_amount form-control">
                                </div>
                                <input type="hidden" name="payment_amount"
                                    value="<?php echo $net_salary + $total_award; ?>"
                                    class="payment_amount form-control">
                                <!-- Hidden Employee Id -->
                                <input type="hidden" id="user_id" name="user_id"
                                    value="<?php echo $employee_info->user_id; ?>" class="salary form-control">
                                <input type="hidden" name="payment_month" value="<?php
                            if (!empty($payment_month)) {
                                echo $payment_month;
                            }
                            ?>" class="salary form-control">
                                <div class="">
                                    <!-- Payment Type -->
                                    <label class="control-label">payment method <span class="required"> *</span></label>
                                    <select name="payment_type" class="form-control col-sm-5"
                                        onchange="get_payment_value(this.value)">
                                        <option value="">select payment methode</option>
                                        <?php
                                   // $all_payment_method = $this->db->get('tbl_payment_methods')->result();
                                    $all_payment_method = App\Models\Payroll\PaymentMethode::all();
                                    if (!empty($all_payment_method)) {
                                        foreach ($all_payment_method as $v_payment_method) {
                                            ?>
                                        <option<?php
                                            if (!empty($check_salary_payment->payment_type)) {
                                                echo $check_salary_payment->payment_type == $v_payment_method->payment_methods_id ? 'selected' : '';
                                            }
                                            ?> value="<?= $v_payment_method->payment_methods_id; ?>">
                                            <?= $v_payment_method->method_name; ?></option>
                                            <?php }
                                    } ?>
                                    </select>
                                </div><!-- Payment Type -->
                                <div class="">
                                    <label class="control-label">comments </label>
                                    <input type="text" name="comments" value="<?php
                                if (!empty($check_salary_payment->comments)) {
                                    echo $check_salary_payment->comments;
                                }
                                ?>" class=" form-control">
                                </div>
                                <div class="mb-lg">
                                    <label class="pull-left control-label">deduct from default account
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                            title="will be deduct into account"></i>
                                    </label>
                                    <div class="pull-right">
                                        <div class="checkbox c-checkbox">
                                            <label>
                                                <input type="checkbox" class="custom-checkbox" checked id="use_postmark"
                                                    name="deduct_from_account">
                                                <span class="fa fa-check"></span></label>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-lg" id="postmark_config"
                                    <?php echo (empty($check_salary_payment->account_id)) ? 'style="display:block"' : '' ?>>
                                    <label class="control-label">select Account</label>
                                    <div class="">
                                        <select name="account_id" style="width:100%;" class="form-control select_box">
                                            <?php
                                       // $account_info = $this->db->order_by('account_id', 'DESC')->get('tbl_accounts')->result();
                                        $account_info =App\Models\Payroll\Accounts::all();
                                        if (!empty($account_info)) {
                                            foreach ($account_info as $v_account) : ?>
                                            <option value="<?= $v_account->account_id ?>"
                                               >
                                                <?= $v_account->account_name ?></option>
                                            <?php endforeach;
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <a data-toggle="modal" data-target="#myModal" href="<admin/account/new_account"><i
                                            class="fa fa-plus"></i>add new</a>
                                </div>
                                <div class="form-group mt-lg">
                                    <div class="col-sm-5">
                                        <button type="submit" name="sbtn" value="1"
                                            class="btn btn-primary btn-block">update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--************ Fees payment End ***********-->
                <!--************ Payment History Start ***********-->
                <!---************** Employee Info show When Print ***********************--->
                <div id="payment_history" class="col-lg-9">
                    <div class="card">
                        <!-- Default panel contents -->

                        <div class="show_print  table table-striped"
                            style="width: 100%; border-bottom: 2px solid black;margin-bottom: 30px">
                            <div class="table-responsive">
                                <table style="width: 100%; vertical-align: middle;">
                                    <tr>
                                        <td style="width: 50px; border: 0px;">
                                            <img style="width: 50px;height: 50px;margin-bottom: 5px;" src="" alt=""
                                                class="img-circle" />
                                        </td>

                                        <td style="border: 0px;">
                                            <p style="margin-left: 10px; font: 14px lighter;">Company Name</p>
                                        </td>
                                    </tr>
                                </table>
                            </div><!-- show when print start-->
                        </div>
                        <div class="show_print"
                            style="padding: 5px 0; width: 100%;margin-top: 20px;margin-bottom: 20px;">
                            <div>
                                <table style="width: 100%; border-radius: 3px;">
                                    <tr>
                                        <td style="width: 150px;">
                                            <table style="border: 1px solid grey;">
                                                <tr>
                                                    <td style="background-color: lightgray; border-radius: 2px;">
                                                        <?php if (!empty($staff_details->avatar)): ?>
                                                        <img src="<?php $staff_details->avatar; ?>"
                                                            style="width: 132px; height: 138px; border-radius: 3px;">
                                                        <?php else: ?>
                                                        <img alt="Employee_Image">
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table
                                                style="width: 300px; margin-left: 10px; margin-bottom: 10px; font-size: 13px;">
                                                <tr>
                                                    <?php
                                            $staff_details  = $data['staff_details'];
                                        ?>
                                                    <td colspan="2">
                                                        <h2><?php echo "$staff_details->fullname "; ?></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 100px"><strong>emp Id:</strong> :</td>
                                                    <td>&nbsp; <?php echo "$staff_details->employment_id"; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 100px"><strong>Departments : </strong></td>
                                                    <td>&nbsp; <?php echo "$staff_details->deptname"; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 100px"><strong>Designation :</strong></td>
                                                    <td>&nbsp; <?php echo "$staff_details->designations"; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 100px"><strong>joining date:</strong></td>
                                                    <td><?= strftime("dd/mm/yy", strtotime($staff_details->joining_date)) ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--  **************** show when print End ********************* -->
                        <div class="col-sm-9 print_width">

                            <div class="panel panel-custom">
                                <!-- Default panel contents -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>payment history</strong>
                                        <div class="pull-right">
                                            <!-- set pdf,Excel start action -->
                                            <label class="hidden-print control-label pull-left hidden-xs">
                                                <button class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                    data-placement="top" title="print" type="button"
                                                    onclick="payment_history('payment_history')"><i
                                                        class="fa fa-print"></i>
                                                </button>
                                            </label>
                                        </div><!-- set pdf,Excel start action -->
                                    </div>
                                </div>

                                <!-- Table -->
                                <table class="table table-striped " id="DataTables" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>month</th>
                                            <th>date</th>
                                            <th>gross salary</th>
                                            <th>total deduction</th>
                                            <th>net salary</th>
                                            <th>fine deduction</th>
                                            <th>amount</th>
                                            <th>details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            list = base_url +
                                                "admin/payroll/payment_historyList/<?= $staff_details->user_id?>";
                                        });
                                        </script>
                                    </tbody>
                                </table>
                            </div>
                            <!--************ Payment History End***********-->
                        </div>
                    </div>


                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
@endsection



@section('scripts')


<script type="text/javascript">
function payment_history(payment_history) {
    var printContents = document.getElementById(payment_history).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    var award = 0;
    $(".award").each(function() {
        award += parseFloat(this.value);
    });
    $("#total_award").val(award);
});
$(document).on("change", function() {
    var fine = 0;
    fine = $("#fine_deduction").val();
    var total_award = $("#total_award").val();
    var net_salary = $("#net_salary").val();
    var sub_tatal = parseFloat(net_salary) + parseFloat(total_award);
    var total = sub_tatal - fine;
    $(".payment_amount").val(total);
});
</script>
@endsection