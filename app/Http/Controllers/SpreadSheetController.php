<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\HTMLToMarkdown\HtmlConverter;
use Revolution\Google\Sheets\Facades\Sheets;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class SpreadSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $data = Sheets::spreadsheet('1Rgp9TOp4APPEH2DjJiMPnYrQz4tVhWG6lbkXWZV_D4Q')
                            ->sheet('GO LIVE')
                            ->range('B2:F11')
                            ->get();

        $newData = array();

        foreach($data as $dt) {
            $newData[] = array(
                'data' => [
                    $dt[0],
                    $dt[1],
                    $dt[2],
                    $dt[3],
                    $dt[4],
                ]
            );
        }

        $text = "";

        foreach($newData as $key => $dt) {       
            $text .= implode(' |', $dt['data']) . "\n";            
        }

        $converter = new HtmlConverter();
        $msg = $converter->convert($text);

        $telegram = new Api('1238633474:AAGkd9pzF8haSxWa7P6RhaproYYs1rR7Kg4');

        $keyboard = Keyboard::make()
                            ->inline()
                            ->row(
                                Keyboard::inlineButton(['text' => 'Dashboard Sales Harian', 'url' => 'https://docs.google.com/spreadsheets/d/170wXyqkwCXZV8F5XiKNFEZFoCVFiieE6G67-dpeNNVY/export?format=xlsx']),
                                // Keyboard::inlineButton(['text' => 'Test 2', 'callback_data' => 'data_frm_btn2'])
                            );         

        $telegram->sendMessage([
            'chat_id' => '-1001184481729',
            'parse_mode' => 'markdown',
            'text' => $msg,
            // 'reply_markup' => $keyboard
        ]);

        return redirect()->back();
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
