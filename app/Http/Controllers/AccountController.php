<?php

namespace App\Http\Controllers;

use App\Http\Requests\Backend\Account\AccountStoreRequest;
use App\Http\Requests\Backend\Account\AccountUpdateRequest;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(Account $account)
    {
        $this->account  = $account;
        
    }

    public function index(){

        $accounts = $this->account->orderBy('created_at','desc')->paginate(20);
        return view('account.index')->withAccounts( $accounts);
    }
    public function create(){
        return view('account.create');
    }

    public function store(AccountStoreRequest $request){

        
        $data = $request->except('_token');

        if($this->account->create($data)){

            return redirect()->to('/account')->with('flash_success','Account Creeated Successfully');
        }
        return redirect()->to('/contact')->with('flash_error','Ops Something Is Wrong');
    }

    public function edit($id){
        $account = $this->account->find($id);
        if(!empty($account)){
            return view('account.edit')->withAccount($account);
        }
        return redirect()->to('/account')->with('flash_error','Ops Something Is Wrong');
    }
    public function update(AccountUpdateRequest  $request,$id){

        $account = $this->account->find($id);
        if(!empty( $account)){

            $data = $request->except('_token');
            $account->update($data);
            return redirect()->to('/account')->with('flash_success','Account Update Successfully');
        }
        return redirect()->to('/account')->with('flash_error','Ops Something Is Wrong');
    }

    public function destroy(Request $request){
        $request->validate([
            'id' => 'required|exists:accounts,id',
        ]);
        $this->account->destroy($request->id);
        $message = 'Account Deleted Successfully.';
        return response()->json(['status' => 'ok', 'message' => $message], 200);
    }
    public function changeStatus(Request $request)
    {
        $account = $this->account->find($request->get('id'));
        if ($account->status == 0) {
            $status = 1;
            $message = 'Account is published.';
        } else {
            $status = 0;
            $message = 'Account is unpublished.';
        }


        $account->update(['status'=>$status]);
       
        $updated = $this->account->find($request->get('id'));
        return response()->json(['status' => 'ok', 'message' => $message, 'response' => $updated], 200);
    }
}
