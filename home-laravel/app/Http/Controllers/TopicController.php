<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    public function createTopic(Request $request) {
        $incomingFields = $request->validate([
        	'title' => 'required',
        	'content' => 'required'
        ]);
        
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);
        $incomingFields['user_id'] = auth()->id();
        
        Topic::create($incomingFields);
        
        return redirect('/home');
    }
    
    public function showEditScreen(Topic $topic) {
    	if (auth()->user()->id !== $topic['user_id']) {
    		return redirect('/home');
    	}
    	
    	return view('edit-topic', ['topic' => $topic]);
    }
    
    public function actuallyUpdateTopic(Topic $topic, Request $request) {
    	if (auth()->user()->id !== $topic['user_id']) {
    		return redirect('/home');
    	}
    	
        $incomingFields = $request->validate([
        	'title' => 'required',
        	'content' => 'required'
        ]);
        
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);
    	
    	$topic->update($incomingFields);
    	return redirect('/home');
    }
    
    public function deleteTopic(Topic $topic, Request $request) {
    	if (auth()->user()->id === $topic['user_id']) {
    		$topic->delete();
    	}
    	
    	return redirect('/home');
    }
    
}
