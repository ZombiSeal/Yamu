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
    public function index(string $action = "", int $id = 0)
    {
        if (!empty($action) && $action === 'edit') {
            $table = BookTable::find($id);
            $table->date = DateTime::createFromFormat('Y-m-d', $table->date)->format('d.m.Y');
        }
        return view('booking', ['table' => $table ?? [], 'action' => $action]);
    }

    public function cancelReserve(Request $request)
    {
        $cancel = BookTable::where('id', $request->id)->update(['is_active' => 0]);
        return ($cancel) ? response()->json(["status" => "ok"]) : response()->json(["status" => "error"]);
    }

    private function checkField(array $data, $valid): array
    {
        $rules = $valid;
        $validator = Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray();
    }

    public function reserveTable(Request $request): \Illuminate\Http\JsonResponse
    {
        if($request->action === 'create') {
            return response()->json($this->createReserve($request));
        } else {
           return response()->json($this->editReserve($request));
        }
    }

    private function createReserve(Request $request) : array
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

        if (count($validatorData) == 0) {
            $date = DateTime::createFromFormat('d.m.Y', $request->date)->format('Y-m-d');
            $tableInfo = Table::where('number', $request->number)->first();

            $table = BookTable::create([
                'table_id' => $tableInfo->id,
                'user_id' => (Auth::id()) ?: null,
                'name' => $request->name,
                'phone' => $request->phone,
                'date' => $date,
                'time' => $request->time,
            ]);

            return ['status' => "ok", 'message' => 'Столик успешно забронирован', 'data' => $table->id];
        } else {
            return ['status' => "error", 'errors' => $validatorData];
        }
    }

    public function editReserve(Request $request): array
    {
        $validatorName = $this->checkField($request->all(), new NameRequest());
        $validatorPhone = $this->checkField($request->all(), new PhoneRequest());

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'time' => 'required',
        ], [
            'required' => 'Заполните поле',
        ]);

        $validatorOther = $validator->errors()->toArray();

        $validatorData = $validatorName + $validatorPhone + $validatorOther;

        if (count($validatorData) == 0) {
            $date = DateTime::createFromFormat('d.m.Y', $request->date)->format('Y-m-d');
            $tableInfo = Table::where('number', $request->number ?? $request->currentNumber)->first();

            $table = BookTable::where('id', $request->get('id'))
                ->update([
                    'table_id' => $tableInfo->id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'date' => $date,
                    'time' => $request->time,
                ]);

            return ['status' => "edit", 'message' => 'Бронь успешно изменена'];
        } else {
            return ['status' => "error", 'errors' => $validatorData];
        }
    }

    public function updateTables(Request $request)
    {
        $date = DateTime::createFromFormat('d.m.Y', $request->date)->format('Y-m-d');
        $bookTables = $this->getReserveTables($date);
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
