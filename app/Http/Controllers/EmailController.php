<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Email;
use Carbon\Carbon;

class EmailController extends Controller
{
    
    public function __construct(Email $email,Contact $contact)
    {
        $this->email = $email;
        $this->contact = $contact;
    }

    public function index(Request $request){
    
        $emails =$this->email->where('contact_id',$request->id)->orderBy('created_at','desc')->paginate(100000);
        $contact =  $this->contact->find($request->id);
        return view('email.index')->withEmails($emails)->withContact($contact);
    }

    public function store(Request $request){

       
        $array =[];
        foreach($request->email as $email){
            $array[] =[
                'contact_id'=>$request->contact_id,
                'address'=>$email,
                'created_at'=>Carbon::now(),
            ];
        }

        if($this->email->insert($array)){

            $emails =$this->email->where('contact_id',$request->contact_id)->orderBy('created_at','desc')->paginate(1000000);
            $contact =  $this->contact->find($request->id);
            return view('email.lists')->withEmails($emails)->withContact($contact);
           
        }
        return response()->json(['errors'=>true,'message'=>'Ops Something Went Wrong'],400);

       
    }
    public function destroy(Request $request){
     
        $request->validate([
            'id' => 'required|exists:emails,id',
        ]);
        $this->email->destroy($request->id);
        $message = 'Email Deleted Successfully.';
        return response()->json(['status' => 'ok', 'message' => $message], 200);
    }

    public function edit($id){
       
        $email = $this->email->find($id);
        return view('email.edit')->withEmail($email);
    }

    public function update(Request $request,$id){
        $email = $this->email->find($id);
        if(!empty($email)){
            $data = $request->except('_token');
            $email->update($data);
            $emails =$this->email->where('contact_id',$email->contact_id)->orderBy('created_at','desc')->paginate(1000000);
            $contact =  $this->contact->find($request->id);
            return view('email.lists')->withEmails($emails)->withContact($contact);
           
        }
        return response()->json(['errors'=>true,'message'=>'Ops Something Went Wrong'],400);

    }
}
