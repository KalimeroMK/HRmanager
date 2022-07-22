<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;

/**
 * Class ClientController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    /**
     * @return Factory|View
     */
    public function addClient()
    {
        return view('hrms.clients.add-client');
    }
    
    /**
     * @param $code
     *
     * @return string
     */
    public function validateCode($code)
    {
        $client = Client::where('code', $code)->first();
        if ($client) {
            return json_encode(['status' => false]);
        }
        
        return json_encode(['status' => true]);
    }
    
    /**
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function saveClient(Request $request)
    {
        $client = new Client();
        $client->fill(array_except($request->all(), '_token'));
        $client->save();
        Session::flash('flash_message', 'Client saved successfully');
        
        return redirect()->back();
    }
    
    /**
     * @return Factory|View
     */
    public function listClients()
    {
        $clients = Client::paginate(15);
        
        return view('hrms.clients.list', compact('clients'));
    }
    
    /**
     * @param $clientId
     *
     * @return Factory|View
     */
    public function showEdit($clientId)
    {
        $client = Client::where('id', $clientId)->first();
        
        return view('hrms.clients.edit', compact('client'));
    }
    
    /**
     * @param  Request  $request
     * @param $clientId
     *
     * @return RedirectResponse
     */
    public function saveClientEdit(Request $request, $clientId)
    {
        try {
            $client = Client::where('id', $clientId)->first();
            $client->fill(array_except($request->all(), '_token'));
            $client->save();
            
            Session::flash('flash_message', 'Client successfully updated');
        } catch (Exception $e) {
            Session::flash('flash_message', $e->getMessage());
        }
        
        return redirect()->back();
    }
    
    public function doDelete($id)
    {
        $client = Client::where('id', $id);
        $client->delete();
        
        Session::flash('flash_message', 'Client successfully Deleted!');
        
        return redirect('list-client');
    }
}
