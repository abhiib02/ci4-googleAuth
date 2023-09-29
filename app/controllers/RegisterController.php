<?php

namespace App\Controllers;

use App\Models;
use App\Models\User;
use Config\Services;

class RegisterController extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        $session = Services::session();
        if ($session->has('logged_in') == true) {
            return redirect()->route('dashboard');
        } else {
            return
                view('header') .
                view('dashboard/signup') .
                view('footer');
        }
    }
    public function SignupValidation()
    {
        $session = Services::session();
        $UserModel = new User();
        $queryData = [
            "NAME" => $this->request->getPost('name'),
            "EMAIL" => $this->request->getPost('email'),

        ];
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');

        // check input valid or not
        $rules = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);
        if (!$rules) {
            echo '<script>alert("Some Input is Invalid");window.location.href="/login";</script>';
            die();
        }


        if ($cpassword != $password) {
            echo '<script>alert("Password is not matching");window.location.href="/signup";</script>';
            die();
        }



        // check user exist
        $userExist = $UserModel->isUserExist($queryData['EMAIL']);
        if ($userExist) {
            echo '<script>alert("User Already Exist");window.location.href="/login";</script>';
            die();
        }

        $queryData['PASSWORD'] = password_hash((string) $password, PASSWORD_DEFAULT);

        $UserModel->insertUser($queryData);

        return '<script>alert("SignUp Successfully");window.location.href="/login";</script>';
    }
    public function googleSignupValidation()
    {

        $UserModel = new User();

        $credential = $this->request->getPost('credential');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $credential . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);

        curl_close($ch);


        $data = json_decode($response);
        $InvalidTokenerror = $data->error ?? 0;
        //print_r($data->email);
        if ($InvalidTokenerror) {
            echo '<script>alert("' . $data->error . '");window.location.href="/login";</script>';
            die();
        }
        $email = $data->email;
        $password = $data->kid;
        $name = $data->name;


        $userExist = $UserModel->isUserExist($email);
        // check user exist
        if ($userExist) {
            echo '<script>alert("User Already Exist");window.location.href="/login";</script>';
            die();
        }

        $queryData['NAME'] = $name;
        $queryData['EMAIL'] = $email;
        $queryData['PASSWORD'] = password_hash((string) $password, PASSWORD_DEFAULT);

        $UserModel->insertUser($queryData);

        return '<script>alert("SignUp Successfully");window.location.href="/login";</script>';
    }

    public function logout()
    {
        $session = Services::session();
        if ($session->has('logged_in') == true) {
            $LoggedInData = ['name', 'email', 'logged_in'];
            $session->remove($LoggedInData);
            return redirect()->route('login');
        } else {
            return redirect()->route('login');
        }
    }
}
