<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssignAsset;
use App\Models\Employee;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class AssetController extends Controller
{
    
    /**
     * @return Factory|View
     */
    public function addAsset()
    {
        return view('hrms.asset.add_asset');
    }
    
    /**
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function processAsset(Request $request)
    {
        $asset              = new Asset;
        $asset->name        = $request->name;
        $asset->description = $request->description;
        $asset->save();
        Session::flash('flash_message', 'Asset successfully added!');
        
        return redirect()->back();
    }
    
    /**
     * @return Factory|View
     */
    public function showAsset()
    {
        $assets = Asset::paginate(5);
        
        return view('hrms.asset.show_asset', compact('assets'));
    }
    
    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function showEdit($id)
    {
        $result = Asset::whereid($id)->first();
        
        return view('hrms.asset.add_asset', compact('result'));
    }
    
    /**
     * @param  Request  $request
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function doEdit(Request $request, $id)
    {
        $name        = $request->name;
        $description = $request->description;
        
        $edit = Asset::findOrFail($id);
        if ( ! empty($name)) {
            $edit->name = $name;
        }
        if ( ! empty($description)) {
            $edit->description = $description;
        }
        $edit->save();
        Session::flash('flash_message', 'Asset successfully updated!');
        
        return redirect('asset-listing');
    }
    
    /**
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function doDelete($id)
    {
        $asset = Asset::find($id);
        $asset->delete();
        Session::flash('flash_message', 'Asset successfully Deleted!');
        
        return redirect('asset-listing');
    }
    
    /**
     * @return Factory|View
     */
    public function doAssign()
    {
        $emps   = User::get();
        $assets = Asset::get();
        
        return view('hrms.asset.assign_asset', compact('emps', 'assets'));
    }
    
    /**
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function processAssign(Request $request)
    {
        $assignment                     = new AssignAsset();
        $assignment->user_id            = $request->emp_id;
        $assignment->asset_id           = $request->asset_id;
        $assignment->authority_id       = $request->authority_id;
        $assignment->date_of_assignment = date_format(date_create($request->doa), 'Y-m-d');
        $assignment->date_of_release    = date_format(date_create($request->dor), 'Y-m-d');
        $assignment->save();
        
        Session::flash('flash_message', 'Asset successfully assigned!');
        
        return redirect()->back();
    }
    
    /**
     * @return Factory|View
     */
    public function showAssignment()
    {
        $assets = AssignAsset::with(['employee', 'authority', 'asset'])->paginate(5);
        
        return view('hrms.asset.show_assignment', compact('assets'));
    }
    
    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function showEditAssign($id)
    {
        $assigns = AssignAsset::with(['employee', 'asset'])->where('id', $id)->first();
        
        $emps   = Employee::get();
        $assets = Asset::get();
        
        return view('hrms.asset.edit_asset_assignment', compact('assigns', 'emps', 'assets'));
    }
    
    /**
     * @param $id
     * @param  Request  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function doEditAssign($id, Request $request)
    {
        $assignment                     = AssignAsset::with(['employee', 'asset'])->where('id', $id)->first();
        $assignment->user_id            = $request->emp_id;
        $assignment->asset_id           = $request->asset_id;
        $assignment->authority_id       = $request->authority_id;
        $assignment->date_of_assignment = date_format(date_create($request->doa), 'Y-m-d');
        $assignment->date_of_release    = date_format(date_create($request->dor), 'Y-m-d');
        $assignment->save();
        
        Session::flash('flash_message', 'Asset Assignment successfully updated!');
        
        return redirect('assignment-listing');
    }
    
    /**
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function doDeleteAssign($id)
    {
        $assign = AssignAsset::find($id);
        $assign->delete();
        
        Session::flash('flash_message', 'Asset Assignment successfully Deleted!');
        
        return redirect('assignment-listing');
    }
    
}
