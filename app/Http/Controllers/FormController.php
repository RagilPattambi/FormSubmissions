<?php
namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Google\Client;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $input = $request->all();
 
        $request->validate([
            'full_name' => 'required|max:50',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|min:10|max:11',
            'whatsapp_number' => 'required|min:10|max:11',
            'status' => 'required',
            'website_url' => 'required|max:255',
        ]);
 
        Form::create($input);

        $client = new Client();
        $client->setApplicationName('formsubmission');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

        $service = new \Google_Service_Sheets($client);

        $spreadsheetId = '1YFna9oQPW7ncdhnTlPR1LVpNtVFNO_6V62HvCasys7Y';
        $sheetName = 'Datasheet';

        $data = [
            $request->input('full_name'),
            $request->input('email'),
            $request->input('phone_number'),
            $request->input('whatsapp_number'),
            $request->input('status'),
            $request->input('website_url'),
        ];

        $range = $sheetName . '!A1:F1';
        $valueRange = new \Google_Service_Sheets_ValueRange();
        $valueRange->setValues(['values' => $data]);
        $service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, ['valueInputOption' => 'USER_ENTERED']);

        echo "success";

    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        //
    }
}
