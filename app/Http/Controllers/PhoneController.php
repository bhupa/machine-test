<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Phone;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class PhoneController extends Controller
{
    public function __construct(Phone $phone,Contact $contact)
    {
        $this->phone = $phone;
        $this->contact = $contact;
    }

    public function index($id){
    
        $phones =$this->phone->where('contact_id',$id)->orderBy('created_at','desc')->paginate(100000);
        $contact =  $this->contact->find($id);
        // dd()
        return view('phone.index')->withPhones($phones)->withContact($contact);
    }
    public function create($id){
        $contact =  $this->contact->find($id);
        return view('phone.create')->withContact($contact);
    }

    public function store(Request $request){
     
        $array =[];
        $contact = $this->contact->find($request->contact_id);
        if(!empty($contact)){
            foreach($request->number as $key=>$number){
                $array[] =[
                    'contact_id'=>$request->contact_id,
                    'number'=>$number,
                    'can_receive_text'=>isset($request->can_receive_text[$key]) ? 1 : 0,
                    'has_whatsapp'=>isset($request->has_whatsapp[$key]) ? 1 : 0,
                    'is_landline'=>isset($request->is_landline[$key]) ? 1 : 0,
                    'created_at'=>Carbon::now(),
                ];
            }
       
            if($this->phone->insert($array)){
                return redirect()->to('/phone'.'/'.$contact->id)->with('flash_success','Phone number created successfully');
             }
        }
        
        return redirect()->back();

    }

    public function destroy(Request $request){
     
        $request->validate([
            'id' => 'required|exists:phone_numbers,id',
        ]);
        $this->phone->destroy($request->id);
        $message = 'Phone Deleted Successfully.';
        return response()->json(['status' => 'ok', 'message' => $message], 200);
    }
    public function edit($id){
        $phone = $this->phone->find($id);
        if(!empty($phone)){
                    
            return view('phone.edit')->withPhone($phone);
        }
        return redirect()->back()->with('flash_error','Ops Something Is Wrong');
    }

    public function update(Request $request,$id){

                 $phone = $this->phone->find($id);
            
                  if(!empty($phone)){
                    $data['number']=$request->number;
                    $data['can_receive_text']=isset($request->can_receive_text) ? 1 : 0;
                    $data['has_whatsapp']=isset($request->has_whatsapp) ? 1 : 0;
                    $data['is_landline']=isset($request->is_landline) ? 1 : 0;
                    $phone->update($data);
                    return redirect()->to('/phone'.'/'.$phone->contact_id)->with('flash_success','Phone number updated successfully');
                  }  
                  return redirect()->back()->with('flash_error','Result not found');
    }
}
