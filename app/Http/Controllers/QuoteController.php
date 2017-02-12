<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller {

    public function getIndex($author = null) {
        if (!is_null($author)) {
            $author_quote = Author::where('name', $author)->first();
            if ($author_quote) {
                $quotes = $author_quote->quotes()->paginate(6);
            }
        } else {
            $quotes = Quote::paginate(6);
        }
        return view('home', ['quotes' => $quotes]);
    }

    public function postQuote(Request $request) {
        $this->validate($request, [
            'author' => 'required|max:60',
            'quote' => 'required|max:420'
        ]);
        $authorText = $request['author'];
        $quoteText = $request['quote'];
        $author = Author::where('name', $authorText)->first();
        if (!$author) {
            $author = new Author();
            $author->name = $authorText;
            $author->save();
        }
        $quote = new Quote();
        $quote->text = $quoteText;
        $author->quotes()->save($quote);

        return redirect()->route('index')->with([
                    'success' => 'Quote saved!'
        ]);
    }

    public function deleteQuote($quote_id) {
        $quote = Quote::find($quote_id);
        $author_deleted = false;
        if (count($quote->author->quotes) == 1) {
            $quote->author->delete();
            $author_deleted = true;
        }
        $success = $author_deleted ? 'Author and Quote Deleted' : 'Quote Deleted';
        $quote->delete();
        return redirect()->route('index')->with(['success' => $success]);
    }

}
