<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function loadLinks(){
        return json_encode(Data::all());
    }

    public function saveLink(Request $request)
    {
        $add= new Data([
            'link' => $request->get('link')
        ]);
        $add->save();
    }

    public function deleteLink(Request $request)
    {
        $remove= Data::find($request->get('id'));
        $remove->delete();
    }

    public function sendData(Request $request)
    {
        $linki = Data::all();
        $odpowiedz = '';
        foreach($linki as $klucz => $link){
            try{
                $odpowedz .= simplexml_load_file($link);
            }catch(Exception $e){
            }
        }
        $dane = [
            'email' => $request->get('email'),
            'odpowiedz' => $odpowiedz
        ];
        try{
            Mail::to($request->get('email'))->send(new Email($dane));
        }catch(Exception $e){

        }
        return $odpowiedz;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
