<?php

namespace App\Http\Controllers;

use App\Http\Requests\DatetimeRequest;
use App\Http\Requests\NameRequest;
use App\Http\Requests\PhoneRequest;
use App\Models\BookTable;
use App\Models\Table;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookTableController extends Controller
{
    public function index()
    {
        $tables = Table::orderBy('number')->get();
        $currentDate = Carbon::now()->format('Y-m-d');
        $bookTables = $this->getReserveTables($currentDate);
        return view('booking', ['tables' => $tables, 'bookTables' => $bookTables]);
    }

    public function showUserTables()
    {
        $tables = BookTable::where('user_id', Auth::id())->orderBy('date','desc')->get();
        return view('account.reserve', ['tables' => $tables]);
    }

    public function cancelReserve(Request $request)
    {
        $cancel = BookTable::where('id', $request->id)->update(['is_active' => 0]);
        return ($cancel) ? response()->json(["status" => "ok"]) : response()->json(["status" => "error"]);
    }

    private function checkField(array $data, $valid):array
    {
        $rules = $valid;
        $validator = Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray();
    }
    public function reserveTable(Request $request)
    {

        $validatorName = $this->checkField($request->all(), new NameRequest());
        $validatorPhone = $this->checkField($request->all(), new PhoneRequest());

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'time' => 'required',
            'number' => 'required',
        ], [
            'required' => 'Заполните поле',
            'number.required' => 'Выберите столик'
        ]);

        $validatorOther = $validator->errors()->toArray();

        $validatorData = $validatorName + $validatorPhone + $validatorOther;

        if(count($validatorData) == 0) {
            $date = DateTime::createFromFormat('d.m.Y', $request->date);
            $table = Table::where('number', $request->number)->first();

            $table = BookTable::create([
                'table_id' => $table->id,
                'user_id' => (Auth::id()) ?: 0,
                'name' => $request->name,
                'phone' => $request->phone,
                'date' => $date->format('Y-m-d'),
                'time' => $request->time,
            ]);

            return response()->json(['status' => "ok", 'message' => 'Столик успешно забронирован', 'data' => $table->id]);
        } else {
            return response()->json(['status' => "error", 'errors' => $validatorData]);
        }
    }

    public function updateTables(Request $request)
    {
        $date = DateTime::createFromFormat('d.m.Y', $request->date);
        $bookTables = $this->getReserveTables($date->format('Y-m-d'));
        return response()->json($bookTables);
    }

    private function getReserveTables($date): array
    {
        $bookTables = BookTable::with('table')->where('date', $date)->where('is_active', 1)->get();

        if (!empty($bookTables)) {
            foreach ($bookTables as $bookTable) {
                $arBookTables[] = $bookTable->table->number;
            }
        }

        return $arBookTables ?? [];
    }

}
