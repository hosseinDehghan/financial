<?php

namespace Hosein\Financial\Controllers;


use Hosein\Financial\cash;
use Hosein\Financial\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FinancialController extends Controller
{
    public function index(){
        $data["stocks"]=Stock::all();
        $data["cash"]=cash::all();
        return view("FinancialView::financial",$data);
    }
    public function getWithYear($year){
        $stock=Stock::where("year",$year)->get();
        echo json_encode($stock);
    }
    public function createStock(Request $request){
        $validator=Validator::make($request->all(),[
            'stock'=>'required',
        ]);
        if($validator->fails()){
            return redirect("financial")->withErrors($validator,"stock")
                ->withInput();
        }
        $stock=new Stock();
        $stock->stock=$request->all()["stock"];
        $stock->month=$request->all()["month"];
        $stock->year=$request->all()["year"];
        $stock->save();
        return redirect("financial")->with("messageStock","با موفقیت ثبت شد");
    }
    public function editStock($id){
        $stock=Stock::where("id",$id)->first();
        return redirect("financial")->with("stock",$stock);
    }
    public function updateStock(Request $request,$id){
        $stock=Stock::where("id",$id)->first();
        $stock->stock=$request->all()["stock"];
        $stock->month=$request->all()["month"];
        $stock->year=$request->all()["year"];
        $stock->save();
        return redirect("financial")->with("messageStock","با موفقیت ویرایش شد");
    }
    public function deleteStock($id){
        $stock=Stock::where("id",$id)->first();
        $cash=cash::where("stocks",$stock->id)->get();
        foreach ($cash as $item){
            $item->delete();
        }
        $stock->delete();
        return redirect("financial")->with("messageStock","با موفقیت حذف شد");
    }
    public function createCash(Request $request){
        $validator=Validator::make($request->all(),[
            'details'=>'required',
            'amount'=>'required',
        ]);
        if($validator->fails()){
            return redirect("financial")->withErrors($validator,"stock")
                ->withInput();
        }
        $cash=new cash();
        $cash->details=$request->all()["details"];
        $cash->amount=$request->all()["amount"];
        $cash->stocks=$request->all()["stock"];
        $cash->debtorOrCreditor=$request->all()["debtorOrCreditor"];
        $cash->receiveOrPay=$request->all()["receiveOrPay"];
        $cash->day=$request->all()["day"];
        $cash->save();
        return redirect("financial")->with("messageCash","با موفقیت ثبت شد");
    }
    public function editCash($id){
        $cash=cash::where("id",$id)->first();
        return redirect("financial")->with("cash",$cash);
    }
    public function updateCash(Request $request,$id){
        $cash=cash::where("id",$id)->first();
        $cash->details=$request->all()["details"];
        $cash->amount=$request->all()["amount"];
        $cash->stocks=$request->all()["stock"];
        $cash->debtorOrCreditor=$request->all()["debtorOrCreditor"];
        $cash->receiveOrPay=$request->all()["receiveOrPay"];
        $cash->day=$request->all()["day"];
        $cash->save();
        return redirect("financial")->with("messageCash","با موفقیت ویرایش شد");
    }
    public function deleteCash($id){
        $cash=cash::where("id",$id)->first();
        $cash->delete();
        return redirect("financial")->with("messageStock","با موفقیت حذف شد");
    }
}
