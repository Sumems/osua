<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function dashboard()
    {
        $resultMostTransaction = DB::select('SELECT userWithMostTransaction() AS most_transaction_user');
        $userWithMostTransaction = $resultMostTransaction[0]->most_transaction_user;

        $resultProductBestSelling = DB::select('CALL productBestSelling()');
        // Konversi hasil ke array (opsional)
        $topProducts = [];
        foreach ($resultProductBestSelling as $row) {
            $topProducts[] = (array) $row;
        }

        // Call stored procedure for sales per month
        $resultSalesPerMonth = DB::select('CALL salesPerMonth()');
        $salesData = [];
        foreach ($resultSalesPerMonth as $row) {
            $salesData[] = (array) $row;
        }

        return view('pages_admin.dashboard.index', ['topProducts' => $topProducts, 'salesData' => $salesData, 'userWithMostTransaction' => $userWithMostTransaction]);
    }

    public function transaction()
    {
        return view('pages_admin.transaction.index');
    }
}
