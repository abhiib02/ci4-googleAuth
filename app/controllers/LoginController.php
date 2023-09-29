<?php

namespace App\Controllers;


use App\Models\User;
use Config\Services;


class LoginController extends BaseController
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
                view('dashboard/login') .
                view('footer');
        }
    }

    public function loginValidation()
    {
        $session = Services::session();
        $UserModel = new User();
        $queryData = [
            "EMAIL" => $this->request->getPost('email'),
            "PASSWORD" => $this->request->getPost('password'),
        ];


        $email = $queryData['EMAIL'];
        $password = $queryData['PASSWORD'];
        $userExist = $UserModel->isUserExist($queryData['EMAIL']);



        $rules = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);
        if (!$rules) {
            echo '<script>alert("Some Input is Invalid");window.location.href="/login";</script>';
            die();
        }
        // check user exist

        if (!$userExist) {
            echo '<script>alert("User Does not Exist");window.location.href="/login";</script>';
            die();
        }
        $LoginStatus = $UserModel->can_login($email, $password);
        if (!($LoginStatus)) {
            echo '<script>alert("Incorrect Email or Password");window.location.href="/login";</script>';
            die();
        }
        $isAdmin = $UserModel->isAdmin($email);

        $LoggedInData = [
            'name' => $UserModel->getUserName($queryData['EMAIL']),
            'email' => $queryData['EMAIL'],
            'logged_in' => true,
            'isadmin' => $isAdmin,
        ];

        $session->set($LoggedInData);
        return redirect()->route('dashboard');
    }

    public function googleloginValidation()
    {

        $session = Services::session();
        $UserModel = new User();
        $queryData = [
            "CREDENTIAL" => $this->request->getPost('credential')
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $queryData['CREDENTIAL'] . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);

        curl_close($ch);


        $data = json_decode($response);
        
        $InvalidTokenerror = $data->error ?? 0;
        if ($InvalidTokenerror) {
            echo '<script>alert("' . $data->error . '");window.location.href="/login";</script>';
            die();
        }
        $email = $data->email;


        $userExist = $UserModel->isUserExist($email);

        // check user exist

        if (!$userExist) {
            echo '<script>alert("User Does not Exist");window.location.href="/login";</script>';
            die();
        }
        $isAdmin = $UserModel->isAdmin($email);
        $LoggedInData = [
            'name' => $UserModel->getUserName($email),
            'email' => $email,
            'logged_in' => true,
            'isadmin' => $isAdmin,
        ];

        $session->set($LoggedInData);
        return redirect()->route('dashboard');
    }


    public function logout()
    {
        $session = Services::session();
        if ($session->has('logged_in') == true) {
            $LoggedInData = ['name', 'email', 'logged_in', 'isadmin'];
            $session->remove($LoggedInData);
            return redirect()->route('login');
        } else {
            return redirect()->route('login');
        }
    }
}
