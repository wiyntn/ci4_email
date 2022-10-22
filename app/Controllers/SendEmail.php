<?php 
namespace App\Controllers;
use App\Models\FormModel;
use CodeIgniter\Controller;

class SendEmail extends Controller
{

    public function index() 
	{
        return view('form_email');
    }
    public function home()
    {
        return view('form_email');
    }
    public function sendemail()
    {
        $to = $this->request->getVar('mailTo');
        $to1 = "wytucsmb007@gmail.com";
        $name = $this->request->getVar('name');
        $message = $this->request->getVar('message');
        
       
        
        if ($this->sendemail1($to,$name,$message) && $this->sendemail1($to1,$name,$message)) {
           return json_encode(['status'=>'success']);
        }
        return json_encode(['status'=>'error']);
        
    }

    public function sendemail1($to,$name,$message) { 
        
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom('wytucsmb@gmail.com','goodjob');
        
        $email->setSubject($name);
        $email->setMessage($message);

        if ($email->send()) 
		{
            // session()->setFlashdata('pesan','success');
            return true;
        } 
		else 
		{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }

}