<?php
namespace App\DataTables;

use App\Models\Withdrawal;
use Yajra\DataTables\Services\DataTable;
use Request;

class PayoutsDataTable extends DataTable
{
    public function ajax()
    {
        $payout = $this->query();
        return datatables()
        ->of($payout)
        ->addColumn('p_method', function ($payout) {
            return $payout->p_method;
        })

        ->addColumn('user_id', function ($payout) {
            $userName = ucfirst($payout->f_name ? $payout->f_name : ' ').' '.ucfirst($payout->l_name ? $payout->l_name : '');
            return $userName;
        })

        ->addColumn('created_at', function ($payout) {
                return dateFormat($payout->date);
            })


        ->addColumn('subtotal', function ($payout) {
            if ($payout->status == 'Success') {
                $subtotal = $payout->amount;
            } else {
                $subtotal = $payout->subtotal;
            }
            return $subtotal;
        })
        ->addColumn('currency_id', function ($payout) {
            return $payout->code;
        })

        ->addColumn('action', function ($withDrawal) {
            if ($withDrawal->status == 'Pending') {
                return '<a href="' . url('admin/payouts/edit/' . $withDrawal->id) . '" class="btn btn-xs btn-primary" title="Edit payout"><i class="fa fa-edit"></i></a>&nbsp;';
            } else {
                return '<a href="' . url('admin/payouts/details/' . $withDrawal->id) . '" class="btn btn-xs btn-primary" title="Details"><i class="fa fa-tasks"></i></a>&nbsp;';

            }

        })

        ->rawColumns(['action'])
        ->make(true);
    }

    public function query()
    {
        $status   = isset(request()->status) ? request()->status : null;
        $from     = isset(request()->from) ? setDateForDb(request()->from) : null;
        $to       = isset(request()->to) ? setDateForDb(request()->to) : null;

        $user_id  = Request::segment(4);
        $query    =  Withdrawal::join('currency', function ($join) {
                        $join->on('withdrawals.currency_id', '=', 'currency.id');
                        })->join('payment_methods', function ($join) {
                            $join->on('withdrawals.payment_method_id', '=', 'payment_methods.id');
                                })->join('users',function($join){
                                    $join->on('withdrawals.user_id', '=', 'users.id');
                                        })->select(['withdrawals.id as id','users.first_name as f_name','withdrawals.account_number as a_number','users.email as email' ,'users.last_name as l_name', 'withdrawals.status as status','withdrawals.amount as amount', 'withdrawals.currency_id AS c_id', 'currency.symbol AS symbol', 'currency.code AS code', 'payment_methods.name AS p_method', 'withdrawals.created_at AS date', ]);
        // $query    = Withdrawal::select();
        if (isset($user_id)) {
            $query->where('withdrawals.user_id', '=', $user_id);
        }

        if (!empty($from)) {
         $query->whereDate('withdrawals.created_at', '>=', $from);
        }

        if (!empty($to)) {
            $query->whereDate('withdrawals.created_at', '<=', $to);
        }

        if (!empty($status)) {
            $query->where('withdrawals.status', '=', $status);
        }

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
        ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID', 'visible' => false])
        ->addColumn(['data' => 'user_id', 'name' => 'users.first_name','users.last_name' , 'title' => 'User Name'])
        ->addColumn(['data' => 'currency_id', 'name' => 'currency.code', 'title' => 'Currency'])
        ->addColumn(['data' => 'p_method', 'name' => 'payment_methods.name', 'title' => 'Payment Method'])
        ->addColumn(['data' => 'a_number', 'name' => 'withdrawals.account_number', 'title' => 'Account Number'])
        ->addColumn(['data' => 'email', 'name' => 'users.email', 'title' => 'Email'])
        ->addColumn(['data' => 'subtotal', 'name' => 'withdrawals.amount', 'title' => 'Amount'])
        ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status'])
        ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])

        ->parameters(dataTableOptions());
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'payoutsdatatables_' . time();

    }
}
