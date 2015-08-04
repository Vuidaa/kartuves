<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Word;
use App\Models\Record;

///MAX WORD LENGHT ~12 chars
class GameController extends Controller
{

  public $alphabet = ['A','Ą','B','C','Č','D','E','Ę','Ė','F','G','H','I','Į','Y','J','K','L','M','N','O','P','R','S','Š','T','U','Ų','Ū','V','Z','Ž'];


  public function index()
  {
    return view('index')->with(['alphabet'=>$this->alphabet,'categories'=>Category::all()]);
  }

  public function game()
  {
    //game already running
    if(!empty(session('word')))
    {
      $data = session()->all();

      return view('game')->with([
                          'alphabet'  => $this->alphabet,
                          'blank'     => implode('', $data['blank']),
                          'category'  => $data['category'],
                          'mistakes'  => $data['mistakes'],
                          'points'    => $data['points']
                          ]); 

    }
    //start new game session
    else
    {
      $category = Category::findOrFail(session('cat_id'));

      $category->load('words');

      $word   = $category->words->random()->name;
      $word   = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
      $answer = implode('', $word);

      
      $blank  = array_fill(0, count($word), '_');
      $points = (session('points') == 0) ? 0 : session('points');

      session([
        'word'     => $word,
        'blank'    => $blank,
        'mistakes' => 0,
        'category' => $category->name,
        'points'   => $points,
        'answer'   => $answer
        ]);

      return view('game')->with([
                          'alphabet'  => $this->alphabet,
                          'blank'     => implode('', $blank),
                          'category'  => $category->name,
                          'mistakes'  => 0,
                          'points'    => $points
                          ]);
    }

  }

  public function records()
  {
    $records = Record::orderBy('score','DESC')->with('category')->limit(50)->get();

    return view('records')->with('records',$records);
  }

  public function start(Request $request)
  {
   
    session([
        'word'     => '',
        'blank'    => '',
        'mistakes' => 0,
        'category' => '',
        'points'   => '',
        'cat_id'   => '',
        'answer'   => ''
        ]);

    session(['cat_id'=>$request->input('category')]);

    return redirect('game');
  }

  public function ajaxCall(Request $request)
  {
    $data    = session()->all();
    $letter  = $request->input('letter');
    $mistake = 0;

    for ($i=0; $i < count($data['word']); $i++) 
    {
      if($data['word'][$i] == $letter)
      {
        $data['blank'][$i]  = $letter;
        $data['points']     = $data['points'] + 5;
        $data['word'][$i]   = '-';

        //game finished
        if(!in_array('_', $data['blank']))
        {

          $data['word'] = '';

          session($data);

          return response()->json([
                            'blank'    => implode('', $data['blank']),
                            'mistakes' => $data['mistakes'],
                            'points'   => $data['points'],
                            'state'    => 'finished'
                            ]);
        }

      }
      else
      {
          $mistake++;
      }
    }

    //wrong letter add mistake
    if(count($data['word']) == $mistake)
    {
      $data['mistakes'] = $data['mistakes'] + 1;
    }

    if($data['mistakes'] >= 5)
    {
      session([
        'word'     => '',
        'blank'    => '',
        'mistakes' =>  0,
        'category' => '',
        'points'   => '',
        'answer'   => ''
        ]);

      return response()->json(['blank'=>implode('', $data['blank']),'mistakes'=>$data['mistakes'],'points'=>$data['points'],'state'=>'gameover','answer'=>$data['answer'],'category'=>$data['cat_id']]);
    }

    session($data);

    return response()->json(['blank'=>implode('', $data['blank']),'mistakes'=>$data['mistakes'],'points'=>$data['points']]);
  }

  public function ajaxRecords(Request $request)
  {
    if( (strlen($request->input('person')) < 20) && ($request->input('points') > 10) ) 
    {

      $record        = new Record;
      $record->name  = $request->input('person');
      $record->score = $request->input('points');

      $category = Category::find($request->input('category'));

      $category->records()->save($record);

    }
  }

  public function finish(Request $request)
  {
    $request->session()->flush();

    return redirect('/');
  }
}
